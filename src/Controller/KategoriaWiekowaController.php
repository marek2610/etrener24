<?php

namespace App\Controller;

use App\Entity\KategoriaWiekowa;
use App\Form\KategoriaWiekowaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class KategoriaWiekowaController extends AbstractController
{
    /**
     * @Route("/kategoria_wiekowa", name="kategoria_wiekowa_index")
     */
    public function indexKategoriaWiekowa()
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $entityManager = $this->getDoctrine()->getManager();
        $kategoriaWiekowa = $entityManager->getRepository(KategoriaWiekowa::class)->findAll();

        return $this->render('kategoria_wiekowa/index.html.twig', [
            'kategoriaWiekowa'  => $kategoriaWiekowa,
        ]);
    }

    /**
     * @Route("/kategoria_wiekowa/{id}", name="kategoria_wiekowa_details")
     */
    public function detailsKategoriaWiekowa($id)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        return $this->render('kategoria_wiekowa/details.html.twig');
    }

    /**
     * @Route("/kategoriawiekowa/dodaj", name="kategoria_wiekowa_dodaj")
     */
    public function dodajKategoriaWiekowa(Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        
        $kategoria_wiekowa = new KategoriaWiekowa();

        $form = $this->createForm(KategoriaWiekowaType::class, $kategoria_wiekowa);

        $form->handleRequest($request);
        
        if ($request->isMethod('post')){
            #odwołujemy się do stworzonego formularza
            #to co przyszło z formularza zostaje wstawione do formularza
            
            if ($form->isSubmitted() && $form->isValid()) {
                
                #dane zostana poprawnie wstawione do kategorii wiekowej
                #jeżeli jest w Form/  *Type wstawiona data_class poniższa linijka nie jest wymagana
                #$kategoria_wiekowa = $form->getData();
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($kategoria_wiekowa);
                $entityManager->flush();
                
                $this->addFlash(
                        'success', 
                        "Kategoria wiekowa {$kategoria_wiekowa->getNazwaPzpn()} / {$kategoria_wiekowa->getGrupaWiekowa()} / {$kategoria_wiekowa->getNazwaUefa()} została pomyślnie dodana"
                );

                return $this->redirectToRoute('kategoria_wiekowa_index');

            }

            $this->addFlash('error', "Błąd");

        }

        return $this->render('kategoria_wiekowa/dodaj.html.twig', [
            'form'  => $form->createView(),
        ]);
    }
}
