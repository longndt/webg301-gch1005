<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //tạo object cho entity
        $employee = new Employee;

        //set giá trị cho các attribute của object
        $employee->setMobile("0912345678");
        $employee->setName("Tuan");
        $employee->setExperiencedyear(3);
        $employee->setImage("https://www.hubspot.com/hubfs/employee-retention-rate.jpg");
        $employee->setSalary(999.99);
        $employee->setMarried(true);
        $employee->setBirthday(\DateTime::createFromFormat('Y-m-d','1998-05-29'));

        //add dữ liệu của object vào table trong DB
        $manager->persist($employee);

        //confirm việc add dữ liệu
        $manager->flush();
    }
}
