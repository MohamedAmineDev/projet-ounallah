<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('age')
            ->add('password')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('tel')
            ->add('matriculeFiscale')
            ->add('registreDesCommerces')
            ->add('adresse')
            ->add('image')
            ->add('genre')
            ->add('cin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
