<?php

namespace App\Controller;

use App\Entity\Mecze;
use App\Entity\Przeciwnik;
use App\Entity\Sezon;
use App\Form\MeczeType;
use App\Form\PrzeciwnikType;
use App\Form\SezonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class SezonController
 * @package App\Controller
 * @Route("/sezon", name="sezon_")
 */
class SezonController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $sezon = $entityManager->getRepository(Sezon::class)->findBy([
            'owner' => $this->getUser()
        ]);

        return $this->render('sezon/index.html.twig', [
            'sezon' => $sezon,
        ]);

        #return $this->render('sezon/index.html.twig', compact('sezon'));
    }

    /**
     * @Route("/dodaj", name="dodaj")
     */
    public function dodaj(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $sezon = new Sezon();

        $form = $this->createForm(SezonType::class, $sezon);

        $form->handleRequest($request);

        if ($request->isMethod('post')){

            if ($form->isSubmitted() && $form->isValid()){

                $sezon
                    ->setUtworzony(new \DateTime())
                    ->setModyfikacja(new \DateTime())
                    ->setOwner($this->getUser())
                ;

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($sezon);
                $entityManager->flush();

                $this->addFlash('success', "Pomyślnie dodano sezon o nazwie {$sezon->getNazwa()} do bazy danych.");

                return $this->redirectToRoute('sezon_index');
            }

            $this->addFlash('error', "Nie udało się dodać sezonu.");
        }

        return $this->render("sezon/dodaj.html.twig", [
            'form'  => $form->createView(),
        ]);
    }

    /**
     * @Route("/edytuj/{id}", name="edytuj")
     */
    public function edytuj(Request $request, Sezon $sezon)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(SezonType::class, $sezon);

        if ($request->isMethod('post')){

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                
                $sezon = $form->getData();

                $sezon
                    ->setModyfikacja(new \DateTime())                
                ;

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($sezon);
                $entityManager->flush();

                $this->addFlash('success', "Zmodyfikowano sezon pod nazwą {$sezon->getNazwa()} / {$sezon->getOpis()}.");

                return $this->redirectToRoute('sezon_index');
            }
            
            $this->addFlash('error', "Nie udało się zmodyfikowac sezonu zapisanego pod nazwą {$sezon->getNazwa()} / {$sezon->getOpis()}.");
        }

        return $this->render('sezon/edytuj.html.twig', [
            'form'  => $form->createView()
        ]);
    }

    /**
     * @Route("usun/{id}", name="usun")
     */
    public function usun(Sezon $sezon)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($sezon);
        $entityManager->flush();

        $this->addFlash('success', "Pomyślnie usunięto sezon o nazwie {$sezon->getNazwa()} / {$sezon->getOpis()}.");

        return $this->redirectToRoute('sezon_index');

    }

    /**
     * @Route("/info/{id}", name="info")
     */
    public function info(Request $request, Sezon $sezon)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $przeciwnik = new Przeciwnik();

        $przeciwnikForm = $this->createForm(PrzeciwnikType::class, $przeciwnik);

        $przeciwnikForm->handleRequest($request);

        if ($przeciwnikForm->isSubmitted() && $przeciwnikForm->isValid()){

            $przeciwnik
                ->setSezon($sezon)
                ->setUtworzony(new \DateTime())
                ->setModyfikacja(new \DateTime())
            ;

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($przeciwnik);
            $entityManager->flush();

            $this->addFlash('success', "Pomyślnie dodano drużynę {$przeciwnik->getNazwa()}");

            return $this->redirectToRoute("sezon_info", ["id" => $sezon->getId()]);

        }

        $mecz = new Mecze();

        $meczForm = $this->createForm(MeczeType::class, $mecz);

        $meczForm->handleRequest($request);

        if ($meczForm->isSubmitted() && $meczForm->isValid()){

            $mecz
                ->setUtworzony(new \DateTime())
                ->setModyfikacja(new \DateTime())
            ;

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mecz);
            $entityManager->flush();

            $this->addFlash('success', "Pomyślnie dodano spotkanie z {$mecz->getPrzeciwnik()}");

            return $this->redirectToRoute("sezon_info", ["id" => $sezon->getId()]);

        }

        
        $entityManager = $this->getDoctrine()->getManager();
        $mecze = $entityManager->getRepository(Mecze::class)->findAll();

        return $this->render('sezon/info.html.twig', [
            'sezon' => $sezon,
            'mecze'  => $mecze,
            'przeciwnikForm' => $przeciwnikForm->createView(),
            'meczForm' => $meczForm->createView(),
        ]);
    }

}
