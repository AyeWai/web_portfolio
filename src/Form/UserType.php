<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname', TextType::class, [
            'label_attr' =>[
                'class' => 'form-label',
                'for' => 'FirstName,'
            ],
            'label' => 'Firstname2',
            'attr' => [
                'placeholder' => 'brrr',
            ]

        ])
        ->add('lastname', TextType::class)
        ->add('pseudo', TextType::class)
        ->add('password', PasswordType::class)
        ->add('mail', EmailType::class)
        ->add('status', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
