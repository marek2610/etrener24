<?php

namespace App\Controller;

use App\Entity\Zawodnik;
use App\Form\UrazyType;
use App\Form\ZawodnikKompletType;
use App\Form\ZawodnikType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ZawodnikController extends AbstractController
{
    /**
     * @Route("/zawodnik", name="zawodnik_index")
     */
    public function indexZawodnik()
    {
        #dostęp do strony może mieć tylko użytkownik z rolą ROLE_USER
        $this->denyAccessUnlessGranted("ROLE_USER");
        
        $entityManager = $this->getDoctrine()->getManager();
        # wyszukiwanie wszystkich 
        #$zawodnicy = $entityManager->getRepository(Zawodnik::class)->findAll();
        #lub
        #wyszukiwanie tylko zdrowych
        $zawodnicy = $entityManager->getRepository(Zawodnik::class)->findBy([
           'owner'     => $this->getUser(),
        ]);
        
        #pokazuje zawodnik w formie terminala na stronie
        dump($zawodnicy);

        return $this->render('zawodnik/index.html.twig', [
            'zawodnicy' => $zawodnicy
        ]);
    }

    /**
     * @Route("/zawodnik/chorzy", name="zawodnik_chorzy")
     */
    public function chorzyZawodnik()
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $entityManager = $this->getDoctrine()->getManager();
        
        # wyszukiwanie wszystkich 
        #$zawodnicy = $entityManager->getRepository(Zawodnik::class)->findAll();
        
        #wyszukiwanie tylko zdrowych
        $zawodnicyChorzy = $entityManager->getRepository(Zawodnik::class)->findBy([
            'owner'     => $this->getUser(),
            'status'    => Zawodnik::STATUS_INJURED
        ]);
        
        #dump($zawodnicy);

        return $this->render('zawodnik/zawodnik_chorzy_index.html.twig', [
            'zawodnicyChorzy' => $zawodnicyChorzy
        ]);
    }

    /**
     * @Route("/zawodnik/zdrowi", name="zawodnik_zdrowi")
     */
    public function zdrowiZawodnik()
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $entityManager = $this->getDoctrine()->getManager();
        
        # wyszukiwanie wszystkich 
        #$zawodnicy = $entityManager->getRepository(Zawodnik::class)->findAll();
        
        #wyszukiwanie tylko zdrowych
        $zawodnicyZdrowi = $entityManager->getRepository(Zawodnik::class)->findby([
            'owner'     => $this->getUser(),
            'status'    => Zawodnik::STATUS_ACTIVE
        ]);
        
        #dump($zawodnicy);

        return $this->render('zawodnik/zawodnik_zdrowi_index.html.twig', [
            'zawodnicyZdrowi' => $zawodnicyZdrowi
        ]);
    }

    /**
     * @Route("/zawodnik/details/{id}", name="zawodnik_details")
     */
    // public function detailsAction($id)
    public function detailsAction(Zawodnik $zawodnik)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        // $entityManager = $this->getDoctrine()->getManager();
        // $zawodnik = $entityManager->getRepository(Zawodnik::class)->findOneBy([
        //     'id'    => $id
        // ]);

        if (!$zawodnik) {
            throw $this->createNotFoundException('Zawodnik nie istnieje.');
        }

        $usunForm = $this->createFormBuilder()
            ->setAction($this->generateUrl('zawodnik_usun', ['id' => $zawodnik->getId()]))
            ->setMethod(Request::METHOD_DELETE)
            ->add('submit', SubmitType::class, ['label' => 'Usun'])
            ->getForm()
        ;

        $unactiveForm = $this->createFormBuilder()
            ->setAction($this->generateUrl('zawodnik_unactive', ['id' => $zawodnik->getId()]))
            ->setMethod(Request::METHOD_POST)
            ->add('submit', SubmitType::class, ['label' => 'Unactive'])
            ->getForm()
        ;

        $kontuzjaForm = $this->createFormBuilder()
            ->setAction($this->generateUrl('urazy_dodaj', ['id' => $zawodnik->getId()]))
            ->setMethod(Request::METHOD_POST)
            ->add('submit', SubmitType::class, [
                'label' => 'Nowa kontuzja'
            ])
            ->getForm()
        ;

        $kontuzjaFormularz = $this->createForm(
            UrazyType::class, 
            null, 
            ['action' => $this->generateUrl('urazy_kontuzja', ["id" => $zawodnik->getId()])])
        ;

        # if status kontuzja button do przekirowania na kontuzje.

        #dump($zawodnik);
            
        return $this->render("zawodnik/details.html.twig", [
            'zawodnik'          => $zawodnik,
            'usunForm'          => $usunForm->createView(),
            'unactiveForm'      => $unactiveForm->createView(),
            'kontuzjaForm'      => $kontuzjaForm->createView(),
            'kontuzjaFormularz' => $kontuzjaFormularz->createView(),
        ]);
    }

    /**
     * @Route("/zawodnik/dodaj", name="zawodnik_dodaj")
     */
    public function dodajZawodnik(Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $zawodnik = new Zawodnik();

        $form = $this->createForm(ZawodnikType::class, $zawodnik);

        $form->handleRequest($request);

        if ($request->isMethod('post')){

            if ($form->isSubmitted() && $form->isValid()){

                #$zawodnik = $form->getData();
                
                $zawodnik
                ->setDataUtworzenia(new \DateTime())
                ->setDataModyfikacji(new \DateTime())
                ->setStatus(Zawodnik::STATUS_ACTIVE)
                ->setOwner($this->getUser() );
                ;
                
                # nie musi być tej linijki dzięki tablicy configureOptions w ZawodnikType
                # a konkretnie dzięki tablicy - 'data_class'    => Zawodnik::class
                # $zawodnik = $form->getData();
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($zawodnik);
                $entityManager->flush();
                
                $this->addFlash('success', "{$zawodnik->getNazwisko()} {$zawodnik->getImie()} został pomyślnie dodany.");
                
                return $this->redirectToRoute('zawodnik_index');

            };

            $this->addFlash('error', "Nie udało się dodać zawodnika.");
        }

        return $this->render("zawodnik/dodaj.html.twig", [
            "form"  => $form->createView()
        ]);
    }
    /**
     * @Route("/zawodnik/edytuj/{id}", name="zawodnik_edytuj")
     */
    public function edytujZawodnik(Request $request, Zawodnik $zawodnik)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        #sprawdza czy zalogowany user jest właścicielem zawodnika jeżeli nie jest, wyrzucany jest błąd
        #if ($this->getUser() !== $zawodnik->getOwner()) {
        #    throw new AccessDeniedException();
        #}

        $form = $this->createForm(ZawodnikKompletType::class, $zawodnik);
        
        if ($request->isMethod('post')) {
            
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                
                $zawodnik = $form->getData();
                
                $zawodnik
                ->setDataModyfikacji(new \DateTime());
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($zawodnik);
                $entityManager->flush();
                
                $this->addFlash('success', "{$zawodnik->getNazwisko()} {$zawodnik->getImie()} został pomyślnie zmodyfikowany.");
                
                return $this->redirectToRoute('zawodnik_details', [
                    'id'    => $zawodnik->getId(),
                ]);
                    
            }

            $this->addFlash('error', "{$zawodnik->getNazwisko()} {$zawodnik->getImie()} nie został zmodyfikowany.");

        }

        return $this->render('zawodnik/edytuj_new.html.twig',[
            'form'  => $form->createView()
        ]);
    }

    /**
     * @Route("/zawodnik/usun/{id}", name="zawodnik_usun", methods={"DELETE"})
     */
    public function usunZawodnik(Zawodnik $zawodnik)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $zawodnik
            ->setDataModyfikacji(new \DateTime)
            ->setStatus(Zawodnik::STATUS_DELETE)
        ;

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($zawodnik);
        $entityManager->flush();

        $this->addFlash('success', "{$zawodnik->getNazwisko()} {$zawodnik->getImie()} został usunięty.");

        return $this->redirectToRoute('zawodnik_index');
    }


    /**
     * @Route("/zawodnik/unactive/{id}", name="zawodnik_unactive", methods={"POST"})
     */
    public function unactiveZawodnik(Zawodnik $zawodnik)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        
        $zawodnik
            ->setDataModyfikacji(new \DateTime)
            ->setStatus(Zawodnik::STATUS_UNACTIVE)
        ;

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($zawodnik);
        $entityManager->flush();

        $this->addFlash('success', "{$zawodnik->getNazwisko()} {$zawodnik->getImie()} posiada status unactive.");

        return $this->redirectToRoute('zawodnik_index');
    }


    /**
     * @Route("/zawodnik/test", name="zawodnik_test")
     */
    public function testZawodnik()
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        
        return $this->render('zawodnik/test.html.twig');
    }

}
