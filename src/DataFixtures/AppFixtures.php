<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // create 20 Users! Bam!
        

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail('user'.$i.'@gmail.com');
            $user->setRoles(['Contributor']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'the_new_password'
               ));
            $manager->persist($user);
        }

        
         $manager->persist($user);

        $manager->flush();
    }
}
