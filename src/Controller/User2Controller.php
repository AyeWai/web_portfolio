<?php

namespace App\Controller;

use App\Entity\User2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class User2Controller extends AbstractController
{
    /**
     * @Route("/user2", name="user2")
     */
    public function index(): Response
    {
        return $this->render('user2/index.html.twig', [
            'controller_name' => 'User2Controller',
        ]);
    }
    /**
     * @Route("/user2/{username}/{password}", name="create_user2")
     */
    public function createUser2(string $username, string $password, ValidatorInterface $validator) : Response
    {   
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $user2 = new User2();
        $user2->setUsername($username);
        $user2->setPassword($password);
        


        $errors = $validator->validate($user2);
        if (count($errors) > 0) {
            //return new Response((string) $errors, 400);
            return $this->render('home/errors.html.twig', ['errors' => $errors,]);
        }
        elseif(count($errors) == 0){


            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($user2);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

        return new Response('Saved new product with id '.$user2->getId());
        }
    }


    
}
