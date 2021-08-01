<?php

namespace App\Controller;

use App\Entity\Krew;
use App\Form\KrewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class KrewController extends AbstractController
{
    /**
     * @Route("/krew/index", name="krew_index")
     */
    public function indexKrew()
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $entityManager = $this->getDoctrine()->getManager();
        $grupaKrwi = $entityManager->getRepository(Krew::class)->findAll();

        return $this->render('krew/krew_index.html.twig', [
            'grupaKrwi' => $grupaKrwi
        ]);
    }
    
    
    
    /**
     * @Route("/krew/dodaj", name="krew_dodaj")
     */
    public function dodajKrew(Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        
        $krew= new Krew();

        $form = $this->createForm(KrewType::class, $krew);

        $form->handleRequest($request);

        if ($request->isMethod('post')){
            
            if ($form->isSubmitted() && $form->isValid()){
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($krew);
                $entityManager->flush();
                
                $this->addFlash('success', "Grupa krwi została pomyślnie dodana.");
                
                return $this->redirectToRoute('krew_index');
                
            }
            
            $this->addFlash('error', 'Nie udało się dodać kolenej grupy krwi');
        
        }

        return $this->render("krew/krew_dodaj.html.twig", [
            "form"  => $form->createView()
        ]);
    }
}
