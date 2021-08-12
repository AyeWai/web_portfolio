<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactService extends AbstractController{

    public function persistContact(Request $request, ValidatorInterface $validator){
        $entityManager = $this->getDoctrine()->getManager();

        $firstname = $request->request->get("firstName");
        $lastname = $request->request->get("lastName");
        $mail = $request->request->get("email");
        $status = $request->request->get("status");

        $user = new User();
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setMail($mail);
        $user->setStatus($status);

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
        }
    }

    public function sendEmail(MailerInterface $mailer, Request $request ): void
    {   
        $firstname = $request->request->get("firstName");
        $lastname = $request->request->get("lastName");
        $mail = $request->request->get("email");
        $status = $request->request->get("status");

        $email = (new TemplatedEmail())
            ->from('cs.simon@live.fr')
            ->to($mail)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Confirmation de prise de contact sur chris-dev.fr')
            ->text('Sending emails is fun again!')
            ->htmlTemplate('mails/reply.html.twig')

            ->context([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'status' => $status,
            ]);

        $mailer->send($email);

        // ...
    }
}