<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Product Name',
                'attr' => [
                    'minlength' => 5,
                    'maxlength' => 30
                ]
            ]) 
            ->add('quantity', IntegerType::class,
            [
                'attr' => [
                    'min' => 1,
                    'max' => 100
                ]
            ])
            ->add('price', MoneyType::class,
            [
                'currency' => 'USD'
            ])
            ->add('category', ChoiceType::class,
            [
                'choices' => [
                    'Mobile' => 'Điện thoại',
                    'Laptop' => 'Máy tính xách tay',
                    'Tablet' => 'Máy tính bảng'
                ],
                'expanded' => true,
                'multiple' => false
                /*
                     1A) Drop-down list (single) : default choice type
                    'expanded' => false,
                    'multiple' => false
                     1B) Drop-down list (multiple) : Hold CTRL to select many 
                    'expanded' => false,
                    'multiple' => true
                     2) Radio button 
                    'expanded' => true,
                    'multiple' => false
                    3) Check-box  
                    'expanded' => true,
                    'multiple' => true
                */
            ])
            ->add('date', DateType::class,
            [
                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
