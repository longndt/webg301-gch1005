<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request)
    {
        //tạo object dựa trên Entity (Model)
        $user = new User;
        //tạo form và lưu giá trị nhập từ form vào $user
        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
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
}
