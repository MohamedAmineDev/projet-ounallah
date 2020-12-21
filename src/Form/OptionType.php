<?php

namespace App\Form;

use App\Entity\Option;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('contenue', TextType::class,[
            'label'=>'Entrez Les Options',
            'attr'=>
                ['placeholder'=>'entrez votre option',
                    'style'=>'border:0;
  border-bottom:1px solid #555;  
  background:transparent;
  width:50%;
  padding:8px 0 5px 0;
  font-size:16px;
  color:black;'
                ]])


            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Option::class,
        ]);
    }
}
