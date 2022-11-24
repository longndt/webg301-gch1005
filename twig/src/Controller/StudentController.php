<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class StudentController extends AbstractController
{
    private function seedStudent() {
        //tạo object Student 1
        $s1 = new Student;
        $s1->setId(1);
        $s1->setName("Nguyễn Nhật Hoàng");
        $s1->setGrade(8.8);
        $s1->setDate(DateTime::createFromFormat('d/m/Y', '09/12/1999'));
        $s1->setImage('s1.png');
        //tạo object Student 2
        $s2 = new Student;
        $s2->setId(2);
        $s2->setName("Nguyễn Thùy Dương");
        $s2->setGrade(8.5);
        $s2->setDate(DateTime::createFromFormat('d/m/Y', '05/05/1995'));
        $s2->setImage('s2.jpg');
        //tạo array để chứa các object ở trên
        $student_list = [$s1, $s2];
        //return array
        return $student_list;
    }

    #[Route('/student')]
    public function index()
    {
        $students = $this->seedStudent();
        return $this->render(
            'student/index.html.twig',
            [
                'students' => $students,
            ]
        );
    }
}
