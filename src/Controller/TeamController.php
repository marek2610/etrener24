<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * @Route("/team", name="team_index")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $teams = $entityManager->getRepository(Team::class)->findBy([
            'owner' => $this->getUser(),
        ]);

        return $this->render('team/index.html.twig', [
            'teams' =>  $teams,
        ]);
    }

     /**
     * @Route("/team/dodaj", name="team_dodaj")
     * @Route("/team/edytuj/{id}", name="team_edytuj")
     */
    public function dodaj(Team $team = null, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$team) {
            $team = new Team();
        }

        $form = $this->createForm(TeamType::class, $team);

        $form->handleRequest($request);

        if($request->isMethod('post')){
            
            if ($form->isSubmitted() && $form->isValid()){

                if (!$team->getId()) {
                    $team
                    ->setUtworzono(new \DateTime())
                    ; 
                }

                $team
                    ->setModyfikacja(new \DateTime())
                    ->setOwner($this->getUser())
                ;

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($team);
                $entityManager->flush();

                $this->addFlash('success', "Wprowadzanie / edycja drużyny {$team->getNazwa()} zakończone powodzeniem.");

                return $this->redirectToRoute('team_index');
            }

            $this->addFlash('error', "Nie udało się dodać/zmodyfikować danych drużyny.");
        }

        return $this->render('team/dodaj.html.twig', [
            'form'  =>$form->createView(),
            'editMode'  => $team->getId() !== null,

        ]);
    }

    /**
     * @Route("/team/usun/{id}", name="team_usun")
     */
    public function usun(Team $team)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($team);
        $entityManager->flush();

        $this->addFlash('success', "Pomyślnie usunięto drużynę {$team->getNazwa()}.");

        return $this->redirectToRoute('team_index');
    }
}
