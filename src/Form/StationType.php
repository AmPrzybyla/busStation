<?php

namespace App\Form;


use App\Entity\File;
use App\Entity\Station;
use App\Entity\Title;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', EntityType::class,[
            'class'=>Title::class,
            'choice_label'=>'name',
            'multiple'=>true,
            'expanded'=>true

        ])
            ->add('text', TextareaType::class)
        ->add('attachFile', FileType::class,[
            'label'=>'Wybierz plik',
            'multiple'=>true,



        ])
            ->add('Wyslij', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Station::class
        ]);

    }

}