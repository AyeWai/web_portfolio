<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Service\ContactService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactController extends AbstractController
{

    /**
     * @Route("/contact/{firstname}/{lastname}/{mail}/{status}", name="create_contact")
     */

    public function createContact(string $firstname, string $lastname, string $mail, string $status, ValidatorInterface $validator) : Response
    {   
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();


        $contact = new Contact();
        $contact->setFirstname($firstname);
        $contact->setLastname($lastname);
        $contact->setMail($mail);
        $contact->setStatus($status);
        


        $errors = $validator->validate($contact);
        if (count($errors) > 0) {
            //return new Response((string) $errors, 400);
            return $this->render('home/errors.html.twig', ['errors' => $errors,]);
        }
        elseif(count($errors) == 0){


            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($contact);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

        //return new Response('Saved new product with id '.$contact->getId());
        return $this->render('home/errors.html.twig', ['errors' => $errors,]);
        }
    }

    /**
     * @Route("/contact-resgistered", name="create_contact2")
     */

     public function createcontact2(Request $request, ValidatorInterface $validator, ContactService $contactService, MailerInterface $mailer) : Response
     {
        $contactService->persistContact($request, $validator);
        $contactService->sendEmail($mailer, $request);
        
        return $this->render('contact/new.html.twig');
        //return new Response('Saved new contact contact with id '.$contact->getId());
        
     }

    public function contact(Request $request): Response
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
    }


    
}
