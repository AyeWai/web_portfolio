<?php

namespace App\Controller;

use Symfony\Component\Asset\Package;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {   
        $logout = '';

        if (!$this->getUser()) {
            $logout = 'hidden';
       }

        return $this->render('home/index.html.twig', [
            'logout' => $logout,
        ]);
    }

    /**
     * @Route("/profil/{userIdentity}", name="profil", methods={"GET"})
     */
    public function profil(string $userIdentity): Response
    {
        $messageDisplayed = 'Mon parcours';
        $logout = '';

        if (!$this->getUser()) {
            $logout = 'hidden';
       }

        return $this->render('home/profil.html.twig', [
            'identity' => $userIdentity,
            'msg_displayed' => $messageDisplayed,
            'logout' => $logout,
        ]);

    }

    /**
     * @Route("/scaffold", name="scaffold", methods={"GET"})
     */
    public function scaffold(): Response
    {
        return $this->render('home/scaffold.html.twig', [
            'controller_name' => 'ScaffoldController',
        ]);
    }

    /**
     * @Route("/contact", name="contact", methods={"GET"})
     */
    public function contactregister(): Response
    {
        $logout = '';

        if (!$this->getUser()) {
            $logout = 'hidden';
       }

        return $this->render('home/contact.html.twig', [
            'logout' => $logout,
        ]);
    }


}
