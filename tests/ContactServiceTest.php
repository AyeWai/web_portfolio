<?php

namespace App\Tests;

use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PHPUnit\Framework\TestCase;
use App\Service\ContactService;

class ContactServiceTest extends TestCase implements AbstractController{ 

    public function testPersistContact(Request $request,ValidatorInterface $validator){
        $entityManager = AbstractController::getDoctrine()->getManager(); 
        //$entityManager = $this->getDoctrine()->getManager();


        $this->assertArrayHasKey('firstName', ['bar' => 'baz']);


        $firstname = $request->request->get("firstName");
        $lastname = $request->request->get("lastName");
        $mail = $request->request->get("email");
        $status = $request->request->get("status");

        $contact = new Contact();
        $contactService = new ContactService();
        $result = $contactService->persistContact($request, $validator);
        $contact->setFirstname('John');
        $contact->setLastname('Dupont');
        $contact->setMail('test@gmail.com');
        $contact->setStatus('Recruteur');

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
        }
    }

}