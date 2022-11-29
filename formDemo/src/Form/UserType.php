<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //khi tạo form tự động bằng make:form
            //thì hệ thống sẽ tự add các mục input
            //tương ứng với các attribute trong Entity
            //nếu cần thay đổi hoặc bổ sung option/validation
            //thì cần add thêm code 
            ->add('username', TextType::class,
            [
                'label' => 'Tên đăng nhập',
                'required' => true,    // Entity: nullable == false
                //'required' => false    // Entity: nullable == true
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 20
                ]
            ])
            ->add('password', PasswordType::class)
            ->add('repeat', PasswordType::class)
            //nút submit mặc định không được tự động add vào form
            //nên cần add thủ công
            ->add('dangnhap', SubmitType::class, 
            [
                'label' => 'Đăng nhập'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
