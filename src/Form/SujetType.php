<?php

namespace App\Form;

use App\Entity\Sujet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SujetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('type' , ChoiceType::class, [ 'choices' => ['Produit' => 'Produit' ,
                                                              'Personnage public' => 'Personnage public',
                                                              'Sujet général' => 'Sujet général'],
                                            'required'=> true,
                                            'label'=>'Choisir le sujet de votre sondage  : '])
            ->add('imageFile' , VichImageType::class , ['required'=>false ,'label'=>'Photo du sujet  : '])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sujet::class,
        ]);
    }
}
