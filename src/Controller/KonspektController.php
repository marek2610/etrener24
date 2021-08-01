<?php

namespace App\Controller;

use App\Entity\Konspekt;
use App\Form\KonspektType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class KonspektController
 * @package App\Controller
 * @Route("/konspekt", name="konspekt_")
 */
class KonspektController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $konspekty = $entityManager->getRepository(Konspekt::class)->findBy([
            'owner' =>  $this->getUser()
        ]);

        return $this->render('konspekt/index.html.twig', [
            'konspekty' => $konspekty,
        ]);
    }

    /**
     * @Route("/dodaj", name="dodaj")
     * @Route("/edytuj/{id}", name="edytuj")
     */
    public function dodaj(Konspekt $konspekt = null, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$konspekt) {

            $konspekt = new Konspekt();
        }

        $form = $this->createForm(KonspektType::class, $konspekt);

        $form->handleRequest($request);

        if ($request->isMethod('post')){

            if ($form->isSubmitted() && $form->isValid()){

                if (!$konspekt->getId()) {
                    $konspekt
                    ->setUtworzony(new \DateTime())
                ;   
                }

                $konspekt
                    ->setModyfikacja(new \DateTime())
                    ->setOwner($this->getUser())
                ;    

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($konspekt);
                $entityManager->flush();

                $this->addFlash('success', "Wprowadzenie / edycja konspektu pod nazwą {$konspekt->getNazwa()} zakończone powodzeniem.");

                return $this->redirectToRoute('konspekt_index');

            }

            $this->addFlash('error', 'Nie udało dodać się konspektu do bazy danych.');

        }

        return $this->render('konspekt/dodaj.html.twig', [
            'form'  => $form->createView(),
            'editMode'  => $konspekt->getId() !== null,
        ]);
    }

    /**
     * @Route("/usun/{id}", name="usun")
     */
    public function usun(Konspekt $konspekt)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($konspekt);
        $entityManager->flush();

        $this->addFlash('success', "Pomyślnie usunięto konspekt {$konspekt->getNazwa()}.");

        return $this->redirectToRoute('konspekt_index');
    }
}
