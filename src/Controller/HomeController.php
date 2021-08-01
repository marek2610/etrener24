<?php

namespace App\Controller;

use App\Entity\Konspekt;
use App\Entity\Sezon;
use App\Entity\Team;
use App\Entity\Trenerzy;
use App\Entity\Treningi;
use App\Entity\Zawodnik;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $zawodnicy = $entityManager->getRepository(Zawodnik::class)->findBy(
            [
                'owner' => $this->getUser(),
            ],
            [
                'dataUtworzenia'    => 'ASC'
            ], 
            3
        );
        $trenerzy = $entityManager->getRepository(Trenerzy::class)->findBy(
            [
                'owner' => $this->getUser(),
            ],
            [
                'utworzony'    => 'ASC'
            ], 
            3
        );
        $druzyny = $entityManager->getRepository(Team::class)->findBy(
            [
                'owner' => $this->getUser(),
            ],
            [
                'utworzono'    => 'ASC'
            ], 
            3
        );
        $konspekty = $entityManager->getRepository(Konspekt::class)->findBy(
            [
                'owner' => $this->getUser(),
            ],
            [
                'utworzony'   => 'ASC'
            ], 
            3
        );
        $treningi = $entityManager->getRepository(Treningi::class)->findBy(
            [
                'owner' => $this->getUser(),
            ],
            [
                'utworzono'    => 'ASC'
            ], 
            3
        );
        $sezony = $entityManager->getRepository(Sezon::class)->findBy(
            [
                'owner' => $this->getUser(),
            ],
            [
                'utworzony'    => 'ASC'
            ], 
            3
        );
        

        return $this->render('home/index.html.twig', [
            'zawodnicy' => $zawodnicy,
            'trenerzy' => $trenerzy,
            'druzyny' => $druzyny,
            'konspekty' => $konspekty,
            'treningi' => $treningi,
            'sezony' => $sezony,
        ]);
    }
}
