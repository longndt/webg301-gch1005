<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormController extends AbstractController
{
    //render ra form để người dùng nhập liệu
    #[Route('/input', name: 'input')]
    public function input()
    {
        return $this->render('form/input.html.twig');
    }

    //lấy dữ liệu từ form người dùng đã nhập thông qua Request
    //xử lý dữ liệu (hiển thị + check thông tin login)
    //render ra view để người dùng thấy kết quả
    #[Route('/output', name: 'output')]
    public function output(Request $request)
    {
        //lấy thông tin người dùng và lưu vào biến
        $username = $request->get('username');
        $password = $request->get('password');
        //check thông tin đăng nhập
        //render ra view và trả về kết quả
        if ($username == "admin" && $password == "123456") {
            $result = "Login succeed !";
        } else {
            $result = "Login failed !";
        }
        return $this->render(
            'form/output.html.twig',
            [
                // 'username' => $username,
                // 'password' => $password
                'result' => $result
            ]
        );
    }

    #[Route('/input1', name: 'input1')]
    public function input1()
    {
        return $this->render('form/input1.html.twig');
    }

    #[Route('/output1', name: 'output1')]
    public function output1(Request $request)
    {
        return $this->render(
            'form/output1.html.twig',
            [
                'salutation' => $request->get('salutation'),
                'name' => $request->get('name'),
                'gender' => $request->get('gender'),
                'email' => $request->get('email'),
                'dob' => $request->get('dob'),
                'address' => $request->get('address'),
            ]
        );
    }
}
