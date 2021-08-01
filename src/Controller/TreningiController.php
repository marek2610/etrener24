<?php

namespace App\Controller;

use App\Entity\Treningi;
use App\Form\TreningiType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TreningiController
 * @package App\Controller
 * @Route("/treningi", name="treningi_")
 */
class TreningiController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');


        $entityManager = $this->getDoctrine()->getManager();
        $treningi = $entityManager->getRepository(Treningi::class)->findBy([
            'owner' => $this->getUser(),
        ]);
        #dd($treningi);

        return $this->render('treningi/index.html.twig', [
            'treningi'  => $treningi,
        ]);
    }

    /**
     * @Route("/dodaj", name="dodaj")
     * @Route("/edytuj/{id}", name="edytuj")
     */
    public function dodaj(Treningi $trening = null, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$trening) {
            $trening = new Treningi();
        }

        $form = $this->createForm(TreningiType::class, $trening);

        $form->handleRequest($request);

        if ($request->isMethod('post')){

            if ($form->isSubmitted() && $form->isValid()){

                if (!$trening->getId()) {
                    $trening
                    ->setUtworzono(new \DateTime())
                ;
                }

                $trening
                    ->setModyfikacja(new \DateTime())
                    ->setOwner($this->getUser())
                ;

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($trening);
                $entityManager->flush();

                $this->addFlash('success', "Wprowadzenie / edycja danych na temat treningu dnia {$trening->getData()->format('Y-m-d')} dla {$trening->getDruzyna()} zakończone powodzeniem.");

                return $this->redirectToRoute('treningi_index');

            }
            $this->addFlash('error', 'Nie udało się dodać nowego treningu.');
        }

        return $this->render('treningi/dodaj.html.twig', [
            'form'      => $form->createView(),
            'editMode'  => $trening->getId() !== null,
        ]);
    }

    /**
     * @Route("/usun/{id}", name="usun")
     */
    public function usun(Treningi $trening)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($trening);
        $entityManager->flush();

        $this->addFlash('success', "Pomyślnie usunięto trening {$trening->getDruzyna()} dnia {$trening->getData()->format('Y-m-d')}.");

        return $this->redirectToRoute('treningi_index');

    }
}
