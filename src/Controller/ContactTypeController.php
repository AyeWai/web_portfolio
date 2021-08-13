<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ContactTypeController extends AbstractController
{
    
    /**
     * @Route("/register/submit", name="register_submit",  methods={"GET"})
     * @param $request
     */
    public function createFormContact(Request $request) : Response

    {   
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        //public function createcontact(string $firstname, string $lastname,  string $password, string $mail, string $status,  ValidatorInterface $validator) : Response

        $entityManager = $this->getDoctrine()->getManager();

        $contact = new Contact();

        $form = $this->createForm(contactType::class, $contact);

        return $this->render('contact_type/contact.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
