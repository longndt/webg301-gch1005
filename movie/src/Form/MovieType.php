<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Movie;
use App\Entity\Category;
use App\Entity\Director;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Movie Title',
                'required' => true,
                'attr' => [
                    'minlength' => 5,
                    'maxlength' => 50,
                    'placeholder' => 'Nhập vào tên của bộ phim'
                ]
            ]
            )
            ->add('image')
            ->add('date', DateType::class,
            [
                'widget' => 'single_text',
                'label' => 'Published Date'
            ])
            ->add('revenue', MoneyType::class,
            [
                'currency' => 'EUR'
            ])
            //cấu hình các thuộc tính liên kết trong form
            ->add('category', EntityType::class,
            [
                //lấy dữ liệu của cột name trong bảng Category 
                //và đổ vào form
                'class' => Category::class,
                'choice_label' => 'name',
                'expanded' => true
            ])

            ->add('director', EntityType::class,
            [
                'class' => Director::class,
                'choice_label' => 'name'

            ])
            ->add('actors', EntityType::class,
            [
                'class' => Actor::class,
                'choice_label' => 'name',
                //Note: bắt buộc phải set thuộc tính 
                //multiple thành true nếu phải chọn
                //nhiều (relationship: many)
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
