<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'User2Controller',
        ]);
    }
    /**
     * @Route("/user/{firstname)}/{lastname}/{mail}/{status}", name="create_user")
     */
    public function createUser(string $firstname, string $lastname, string $mail, string $status, ValidatorInterface $validator) : Response
    {   
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setLastname($mail);
        $user->setLastname($status);
        


        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            //return new Response((string) $errors, 400);
            return $this->render('home/errors.html.twig', ['errors' => $errors,]);
        }
        elseif(count($errors) == 0){


            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($user);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

        return new Response('Saved new product with id '.$user->getId());
        }
    }

    /*public function contact(Request $request): Response
    {
        //$defaultData = ['message' => 'Type your message here'];
        //$form = $this->createFormBuilder($defaultData)
        $form = $this->createFormBuilder()
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('pseudo', TextType::class)
            ->add('password', PasswordType::class)
            ->add('email', EmailType::class)
            ->add('statut', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
        }

        // ... render the form
    }*/


    
}
