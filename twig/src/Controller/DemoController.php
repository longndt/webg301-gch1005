<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route('/demo', name: 'app_demo')]
    public function index(): Response
    {
        return $this->render('demo/index.html.twig');
    }

    #[Route('/', name: 'homepage')]
    public function demo()
    {
        $school = "University of Greenwich (Vietnam)";
        $subject = "Web Project";
        $semester = "Fall 2022";
        $quantity = 40;
        return $this->render(
            'demo/demo.html.twig',
            [
                'school' => $school,
                'subject' => $subject,
                'hocky' => $semester,
                'framework' => 'Symfony',
                'quantity' => $quantity,
                'point' => 8.5,
                'grade' => 'M',
                'pass' => true
            ]
        );
    }

    #[Route('/greenwich')]
    public function greenwich() {
        $students = array('Nam', 'Minh', 'Huong', 'Tuan', 'Cuong','Hung','Loan');
        return $this->render('demo/students.html.twig',
        [
            'students' => $students
        ]);
    }
}
