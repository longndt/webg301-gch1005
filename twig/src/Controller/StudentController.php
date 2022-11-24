<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class StudentController extends AbstractController
{
    #[Route('/student')]
    public function index()
    {
        //tạo object Student
        $s1 = new Student;
        $s1->setName("Nguyễn Nhật Hoàng");
        $s1->setGrade(8.8);
        $s1->setDate(DateTime::createFromFormat('d/m/Y', '09/12/1999'));
        $s1->setImage('s1.png');
        return $this->render(
            'student/index.html.twig',
            [
                'student' => $s1
            ]
        );
    }
}
