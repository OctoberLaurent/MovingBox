<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Boxes;
use App\Entity\Rooms;
use App\Entity\Content;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class BoxesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('number', NumberType::class)
            ->add('name', TextType::class)
            ->add('picture')
            ->add('origin', EntityType::class, [
                'class' => Rooms::class,
                'choice_label' => 'name'
            ])
            ->add('destination', EntityType::class, [
            'class' => Rooms::class,
            'choice_label' => 'name' 
            ])
            ->add('content', CollectionType::class, [
            'entry_type' => ContentType::class,
            'allow_delete' => true,
            'allow_add' => true,
            'prototype' => true,
            'attr' => [
                'class' => 'content',
            ]    
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Boxes::class,
        ]);
    }
}
