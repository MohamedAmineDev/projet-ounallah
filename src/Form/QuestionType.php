<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('texte',TextType::class,['label'=>'Entrez le titre du sondage',
                'attr'=>
                    ['placeholder'=>'Entrez votre question',
                        'style'=>'border:0;
  border-bottom:1px solid #555;  
  background:transparent;
  width:50%;
  padding:8px 0 5px 0;
  font-size:16px;
  color:black;'
                    ]])
        ;
        $builder->add('options', CollectionType::class, [

            'entry_type' => OptionType::class,
            'entry_options' => ['label' => false],
            'by_reference'=>false,
            'allow_add' => true,
                'allow_delete'=>true,

        ]

        )
        ->add('enregistrer',SubmitType::class,[
            'attr'=>['class'=>'btn btn-success']
        ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
