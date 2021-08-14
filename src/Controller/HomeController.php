<?php

namespace App\Controller;

use Symfony\Component\Asset\Package;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/who/{userIdentity}", name="who", methods={"GET"})
     */
    public function who(string $userIdentity): Response
    {
        $messageDisplayed = 'Mon parcours';

        return $this->render('home/who.html.twig', [
            'controller_name' => 'WhoController',
            'identity' => $userIdentity,
            'msg_displayed' => $messageDisplayed,
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
     * @Route("/register", name="register", methods={"GET"})
     */
    public function register(): Response
    {
        return $this->render('home/register.html.twig');
    }
}
