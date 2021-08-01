<?php

namespace App\Controller;

use App\Entity\Urazy;
use App\Entity\User;
use App\Entity\Zawodnik;
use App\Form\UrazyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UrazyController extends AbstractController
{
    
    /**
     * @Route("/urazy/", name="urazy_index")
     */
    public function indexUrazy()
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $entityManager = $this->getDoctrine()->getManager();
        // $kontuzjowaniZawodnicy = $entityManager->getRepository(Zawodnik::class)->findBy([
        //      'status'    => Zawodnik::STATUS_INJURED
        // ]);
        
        $kontuzjowaniZawodnicy = $entityManager->getRepository(Zawodnik::class)->findBy([
            'owner'     => $this->getUser(),
        ]);

        #dump($kontuzjowaniZawodnicy);

        return $this->render('urazy/kontuzje_index.html.twig',[
            'kontuzjowaniZawodnicy'    => $kontuzjowaniZawodnicy 
        ]);
    }
    
    #nie działa
    /**
     * @Route("/urazy/dodaj/{id}", name="urazy_dodaj", methods={"POST"})
     */
    public function dodajUraz(Zawodnik $zawodnik, Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $entityManager = $this->getDoctrine()->getManager();
        // $kontuzjowaniZawodnicy = $entityManager->getRepository(Zawodnik::class)->findBy([
        //      'status'    => Zawodnik::STATUS_INJURED
        // ]);
        
        $user = $entityManager->getRepository(User::class)->findBy([
            'id'     => $this->getUser(),
        ]);


        $uraz = new Urazy();

        $uraz
            ->setZawodnik($zawodnik)
            ->setRozpoznanie('Rozpoznanie')
            ->setZalecenia('zalecenia')
            ->setRehabilitacja('rehabilitacja')
            ->setDataKontuzji(new \DateTime())
            ->setUwagi('uwagi')
            ->setDataUtworzenia(new \DateTime())
            ->setDataModyfikacji(new \DateTime())
        ;

        $zawodnik
            ->setStatus(Zawodnik::STATUS_INJURED);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($uraz);
        $entityManager->persist($zawodnik);
        $entityManager->flush();

        $this->addFlash('success', "Dodałeś kontuzję zawodnikowi {$zawodnik->getNazwisko()} {$zawodnik->getImie()}.");

        return $this->redirectToRoute("urazy_index");

    }
    
    
    /**
     * @Route("/urazy/details/{id}", name="urazy_details")
     */
    public function detailsAction(Zawodnik $zawodnik)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $kontuzjaFormularz = $this->createForm(
            UrazyType::class, 
            null, 
            ['action' => $this->generateUrl('urazy_kontuzja', ["id" => $zawodnik->getId()])])
        ;

        return $this->render('urazy/kontuzje_details.html.twig',[
            'zawodnik' => $zawodnik,
            'kontuzjaFormularz' => $kontuzjaFormularz->createView(),

        ]);
    }

    /**
     * @Route("/urazy/kontuzja/{id}", name="urazy_kontuzja", methods={"POST"})
     */
    public function kontuzjaAction(Request $request, Zawodnik $zawodnik)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $kontuzja = new Urazy();
        $kontuzjaForm = $this->createForm(UrazyType::class, $kontuzja);

        # obsługa requesta
        $kontuzjaForm->handleRequest($request);

        if ($kontuzjaForm->isSubmitted() && $kontuzjaForm->isValid()) {

            
            $kontuzja
            ->setZawodnik($zawodnik)
            ->setDataUtworzenia(new \DateTime())
            ->setDataModyfikacji(new \DateTime());
            
            $zawodnik
            ->setStatus(Zawodnik::STATUS_INJURED);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kontuzja);
            $entityManager->persist($zawodnik);
            $entityManager->flush();
            
            $this->addFlash('success', "Dodałeś kontuzję zawodnikowi {$zawodnik->getNazwisko()} {$zawodnik->getImie()}.");
            
        }
        else {

            $this->addFlash('error', "Nie udało się dodać kontuzji zawodnikowi {$zawodnik->getNazwisko()} {$zawodnik->getImie()}.");
            
        }
 
        return $this->redirectToRoute('urazy_details', ["id" => $zawodnik->getId()]);

    }

    /**
     * @Route("/urazy/zdrowy/{id}", name="urazy_zdrowy", requirements={"id":"\d+"}))
     */
    public function zdrowyAction(Request $request, Zawodnik $zawodnik)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $entityManager = $this->getDoctrine()->getManager();
                     
        $zawodnik
            ->setStatus(Zawodnik::STATUS_ACTIVE)
            ->setDataModyfikacji(new \DateTime());
            
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($zawodnik);
        $entityManager->flush();
            
        $this->addFlash('success', "Zawodnik {$zawodnik->getNazwisko()} {$zawodnik->getImie()} jest zdolny do dalszej gry.");
 
        return $this->redirectToRoute('zawodnik_chorzy');

    }
}
