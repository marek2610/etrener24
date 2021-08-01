<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/registration", name="security_registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user
                ->setPassword($hash)
                ->setCreatedAt(new \DateTime())
                ->setDataAktualizacji(new \DateTime())
                ->setRoles(['ROLE_USER']);
                ;

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', "Zostałeś pomyślnie zarejestrowany do aplikacji. Może się teraz zalogować.");

            return $this->redirectToRoute('security_login');
            
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
            ]);
    }
        
    /**
    * @Route("/login", name="security_login")
    */
    public function login(Request $request, AuthenticationUtils $utils)
    {
        #jeżeli user jest zalogowany zostanie przeniesiony na stronę główną
        if($this->getUser()) {
            // $this->redirectToRoute('dokumenty/index.html.twig');
            $this->redirectToRoute('home');
        }
        
        $error = $utils->getLastAuthenticationError();

        $lastUsername = $utils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error'     => $error,
            'last_username' => $lastUsername,
        ]);
    }

    /**
    * @Route("/logout", name="security_logout")
    */
    public function logout()
    {
       
    }

    /**
    * @Route("/forgot", name="security_forgot")
    */
    public function forgot()
    {
        return $this->render('security/forgot.html.twig');
    }
}
