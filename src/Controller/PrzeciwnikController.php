<?php

namespace App\Controller;

use App\Entity\Przeciwnik;
use App\Entity\Sezon;
use App\Form\PrzeciwnikType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class PrzeciwnikController
 * @package App\Controller
 * @Route("/przeciwnik", name="przeciwnik_")
 */
class PrzeciwnikController extends AbstractController
{
    /**
     * @Route("/dodaj", name="dodaj", methods={"POST"})
     */
    public function dodaj(Request $request, Sezon $sezon)
    {
        $this ->denyAccessUnlessGranted('ROLE_USER');

        $przeciwnik = new Przeciwnik();

        $przeciwnikForm = $this->createForm(PrzeciwnikType::class, $przeciwnik);

        $przeciwnikForm->handleRequest($request);

        if ($przeciwnikForm->isSubmitted() && $przeciwnikForm->isValid()){

            $przeciwnik
                ->setUtworzony(new \DateTime())
                ->setModyfikacja(new \DateTime())
            ;

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($przeciwnik);
            $entityManager->flush();

            $this->addFlash('success', "Pomyślnie dodano drużynę {$przeciwnik->getNazwa()}");

            return $this->redirectToRoute("sezon_index");

        }
    }
}
