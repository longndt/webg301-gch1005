<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
//    chỉ cần khai báo "name" nếu sử dụng
//    "path" ở trong file view (twig)
   #[Route('/', name: 'home')]
   public function homepage() {
        // thư mục chứa view: templates
        // view format: html, html.twig
        return $this->render("home.html.twig");
   }

   #[Route('/greenwich', name: 'fgw')]
   public function fpt() {
        return $this->render("fpt/greenwich.html.twig");
   }
 
}
