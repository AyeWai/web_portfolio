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
            'label' => 'Prénom',
            'attr' => [
                'placeholder' => 'brrr',
            ]

        ])
        ->add('lastname', TextType::class,[
            'label_attr' =>[
                'class' => 'form-label',
                'for' => 'LasttName',
            ],
            'label' => 'Nom'])
        /*->add('pseudo', TextType::class,[
            'label_attr' =>[
                'class' => 'form-label',
                'for' => 'Pseudo',
            ],
            'label' => 'Pseudo'])
        ->add('password', PasswordType::class,[
            'label_attr' =>[
                'class' => 'form-label',
                'for' => 'Password',
            ],
            'label' => 'Password'])*/
        ->add('mail', EmailType::class,[
            'label_attr' =>[
                'class' => 'form-label',
                'for' => 'Mail',
            ],
            'label' => 'Mail'])
        ->add('status', TextType::class,[
            'label_attr' =>[
                'class' => 'form-label',
                'for' => 'Status',
                'class'=>'checkbbox-line',
                'type'=>'checkbox'
            ],
            'label' => 'Status',
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
