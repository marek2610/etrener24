<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserInfoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/info/", name="user_info")
     * 
     * @param $id
     */
    public function info(Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $entintyManager = $this->getDoctrine()->getManager();
        $user = $entintyManager->getRepository(User::class)->findBy([
            'id'     => $this->getUser(),
        ]);

        dump($user);

        return $this->render("user/info.html.twig", [
            'user'  => $user,
        ]);
    }

    /**
     * @Route("/user/edit", name="user_edit")
     * 
     * @param Request $request
     * @param User $user 
     * @param $id 
     * 
     * @return Response
     */
    public function edit(Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy([
            'id'    => $this->getUser(),
        ]);

        $form = $this->createForm(UserInfoType::class, $user);

        if ($request->isMethod('post')){

            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()){

                $user
                    ->setDataAktualizacji(new \DateTime())
                ;

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Pomyślnie zmodyfikowano użytkownika.');

                return $this->redirectToRoute('user_info', [
                    'id'    =>$user->getId(),
                ]);
            }

            $this->addFlash('error', 'Problem.');

        }

        return $this->render('user/edit.html.twig',[
            'form'  => $form->createView()
        ]);

    }
}