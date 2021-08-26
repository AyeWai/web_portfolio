<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationService extends AbstractController{

    public function persistUser(Request $request, ValidatorInterface $validator, UserPasswordEncoder $passwordEncoder) : Response{
        $entityManager = $this->getDoctrine()->getManager();

        $mail = $request->request->get("email");
        $password = $request->request->get("password");
        $agreeterms = $request->request->get("agreeTerms");

        $user = new User();
        $user->setEmail($mail);
        $user->setPassword(
            $passwordEncoder->encodePassword(
                $user,
                $password
            )
        );
        //$user->setIsVerified($agreeterms);

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

        return $user;
    }

    
}