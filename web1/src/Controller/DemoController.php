<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route('/', name: 'app_demo')]
    public function index(): Response
    {
        return $this->render('demo/index.html', [
            'controller_name' => 'DemoController',
        ]);
    }

    //route: set đường dẫn cho URL 
    //nếu để route là "/" => homepage
    //giá trị của route là duy nhất
    #[Route('/greenwich')]
    public function fpt()
    {
        //render ra view tại thư mục templates
        return $this->render("greenwich.html");
    }
}