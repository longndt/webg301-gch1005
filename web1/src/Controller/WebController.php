<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebController extends AbstractController
{
    #[Route('/hanoi')]
    public function hanoi()
    {
        return $this->render("vietnam/hanoi.html");
    }

    #[Route('/hcm')]
    public function hcm()
    {
        return $this->render("vietnam/hcm.html");
    }
}