<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    #[Route('/addproduct', name: 'add_product')]
    public function addProduct(Request $request) {
        $product = new Product;
        $form = $this->createForm(ProductType::class, $product);
        //$form->add('Add', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('product/view.html.twig',
            [
                'product' => $product
            ]);
        }
        return $this->renderForm ('product/add.html.twig',
        [
            'productForm' => $form
        ]);

    }

    #[Route('/editproduct', name: 'edit_product')]
    public function editProduct(Request $request)
    {
        // codes go here
        $form = $this->createForm(ProductType::class);
        $form->add('Edit', SubmitType::class);
        // codes go here
    }
}
