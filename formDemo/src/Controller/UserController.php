<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    //Cách 1: sử dụng createFormBuilder() : tạo form trong controller
    #[Route('/login', name: 'login')]
    public function login(Request $request)
    {
        //tạo object dựa trên Entity (Model)
        $user = new User;
        //tạo form và lưu giá trị nhập từ form vào $user
        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            //->add('repeat', RepeatedType::class)
            ->add('Login', SubmitType::class)
            ->getForm();
        //handle request cho form
        $form->handleRequest($request);
        //xử lý dữ liệu và redirect
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render(
                'user/loginCheck.html.twig',
                [
                    'user' => $user
                ]
            );
        }
        //render ra form
        return $this->render(
            'user/loginForm.html.twig',
            [
                'loginForm' => $form->createView()
            ]
        );
    }

    //Cách 2: sử dụng createForm() : tạo form ở file riêng và gọi đến trong Controller => recommended
    #[Route("/dangnhap", name: "dang_nhap")]
    public function dangNhap(Request $request)
    {
        //tạo object theo Entity để lưu dữ liệu từ form
        $user = new User;
        //tạo form từ class form type và lưu dữ liệu vào object
        $form = $this->createForm(UserType::class, $user);
        //nếu không add nút submit vào file form thì có thể
        //add trực tiếp trong controller
        //$form->add('dangnhap', SubmitType::class);
        //handle request từ form
        $form->handleRequest($request);
        //sau khi người dùng đã submit form thì render ra view check kết quả
        if ($form->isSubmitted() && $form->isValid()) {
            //return $this->redirectToRoute('check');
            //render ra view check login
            return $this->render(
                'user/loginCheck.html.twig',
                [
                    'user' => $user
                ]
            );
        }

        //render ra login form (mặc định)
        return $this->renderForm(
            'user/loginForm.html.twig',
            [
                'loginForm' => $form
            ]
        );
    }

    #[Route('/check', name: 'check')]
    public function check() {
        return $this->render('check.html.twig');
    }
}
