<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class UserTypeController extends AbstractController
{
    
    /**
     * @Route("/register/submit", name="register_submit",  methods={"GET"})
     * @param $request
     */
    public function createUser(Request $request) : Response

    {   
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        //public function createUser(string $firstname, string $lastname, string $pseudo, string $password, string $mail, string $status,  ValidatorInterface $validator) : Response

        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
