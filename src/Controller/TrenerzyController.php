<?php

namespace App\Controller;

use App\Entity\Trenerzy;
use App\Entity\User;
use App\Form\TrenerzyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrenerzyController extends AbstractController
{
    /**
     * @Route("/trenerzy", name="trenerzy_index")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $trenerzy = $entityManager->getRepository(Trenerzy::class)->findBy([
            'owner' => $this->getUser(),
        ]);

        #dd($trenerzy);

        return $this->render('trenerzy/index.html.twig', [
            'trenerzy'  => $trenerzy
        ]);
    }

    /**
     * @Route("/trenerzy/dodaj", name="trenerzy_dodaj")
     * @Route("/trenerzy/edytuj/{id}", name="trenerzy_edytuj")
     */
    public function dodaj(Trenerzy $trener = null, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$trener) {
            $trener = new Trenerzy();
        }

        $form = $this->createForm(TrenerzyType::class, $trener);

        if ($request->isMethod('post')) {
            
            #obsługa $request
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){

                if (!$trener->getId()) {
                    $trener
                    ->setUtworzony(new \DateTime())
                ;

                }
                
                $trener
                    ->setModyfikacja(new \DateTime())
                    ->setOwner($this->getUser())

                ;

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($trener);
                $entityManager->flush();

                $this->addFlash('success', "Wprowadzanie / edycja danych trenera {$trener->getTrener()} zakończone powodzeniem.");

                return $this->redirectToRoute('trenerzy_index');

            };

            $this->addFlash('error', "Nie udało się dodać/zmodyfikować danych trenera.");

        }

        return $this->render('trenerzy/dodaj.html.twig', [
            "trenerzyFormularz" => $form->createView(),
            "editMode"          => $trener->getId() !== null,
        ]);

    }

    /**
     * @Route("trenerzy/zwolniony/{id}", name="trenerzy_zwolniony")
     */
    public function zwolniony(Trenerzy $trener)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $entityManager = $this->getDoctrine()->getManager();

        $trener
            ->setModyfikacja(new \DateTime())
            ->setZwolniony(new \DateTime())
        ;

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($trener);
        $entityManager->flush();

        $this->addFlash('success', "Wprowadzono datę zwolnienia dla trenera {$trener->getTrener()}.");

        return $this->redirectToRoute('trenerzy_index');


    }

    /**
     * @Route("trenerzy/usun/{id}", name="trenerzy_usun")
     */
    public function usun(Trenerzy $trener)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($trener);
        $entityManager->flush();

        $this->addFlash('success', "Pomyślnie usunięto trenera {$trener->getTrener()}.");

        return $this->redirectToRoute('trenerzy_index');

    }
}
