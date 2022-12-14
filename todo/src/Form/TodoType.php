<?php

namespace App\Form;

use App\Entity\Todo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'required' => true
            ])
            ->add('category', ChoiceType::class,
            [
                'choices' => [
                    'Personal' => 'Personal',
                    'Family' => 'Family',
                    'Work' => 'Work',
                    'Study' => 'Study'
                ]
            ])
            ->add('description', TextType::class,
            [
                'attr' => [
                    'minlength' => 5,
                    'maxlength' => 50,
                    'placeholder' => 'Enter description here'
                ]
            ])
            ->add('priority', IntegerType::class,
            [
                'attr' => [
                    'min' => 1,
                    'max' => 5
                ]
            ])
            ->add('duedate', DateType::class,
            [
                'label' => 'Deadline',
                'widget' => 'single_text'
            ])
            //->add('OK', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}
