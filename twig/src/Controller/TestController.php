<?php

namespace App\Controller;

use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function test1()
    {
        $order = DateTime::createFromFormat('d/m/Y H:i:s','24/11/2022 13:48:55');
        $image = 'macbook.jpg';
        $mobiles = array("iPhone", "Samsung", "Sony", "HTC");
        return $this->render(
            'test/test.html.twig',
            [
                'name' => "Macbook Pro M2",  //string
                'quantity' => 55,  //integer 
                'price' => 1299.99,  //float
                'best_seller' => true,  //boolean
                'order' => $order, //DateTime
                'image' => $image, //string
                'mobile_list' => $mobiles //array
            ]
        );
    }
}
