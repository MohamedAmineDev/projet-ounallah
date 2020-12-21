<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EnqueteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            ->add('password',PasswordType::class)
            ->add('dateNaissance',DateType::class,[
                'widget' => 'single_text',
                 'format' => 'yyyy-MM-dd'
            ], ['label'=>'Date de création :  '])
            ->add('tel')
            ->add('matriculeFiscale')
            ->add('registreDesCommerces',FileType::class, array('data_class' => null))
            ->add('adresse')
            ->add('image',FileType::class, array('data_class' => null))
            ->add('cin')
            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
