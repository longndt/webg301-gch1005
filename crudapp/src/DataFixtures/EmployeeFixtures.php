<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //tạo array để chứa list các dữ liệu mẫu cho các cột
        $mobile_list = array("0912345678","0988888888","0966666666","0905050505");
        $image_list = ["https://www.hubspot.com/hubfs/employee-retention-rate.jpg",
            "https://imageio.forbes.com/specials-images/imageserve/6109550f1aa8564670194ad4/Close-up-smiling-businesswoman-holding-computer-tablet--looking-to-side/960x0.jpg?format=jpg&width=960",
            "https://www.irishlifecorporatebusiness.ie/sites/default/files/slider/employee_2.jpg",
            "https://www.foundu.com.au/hubfs/How%20to%20Maintain%20Employee%20Records.jpg"];

        //sử dụng vòng lặp for để add dữ liệu với số lượng mong muốn
        for ($i=1; $i<=100; $i++) {
            //lấy 1 random index trong array đã tạo
            $mob = array_rand($mobile_list, 1);
            $img = array_rand($image_list, 1);

            //tạo object cho entity
            $employee = new Employee;

            //set giá trị cho các attribute của object
            $employee->setMobile($mobile_list[$mob]);
            $employee->setName("Employee $i");
            $employee->setExperiencedyear(rand(1,20));
            $employee->setImage($image_list[$img]);
            $employee->setSalary((float)(rand(1000,10000)));
            $employee->setMarried(true);
            $employee->setBirthday(\DateTime::createFromFormat('Y-m-d', '1998-05-29'));

            //add dữ liệu của object vào table trong DB
            $manager->persist($employee);
        }
        
        //confirm việc add dữ liệu
        $manager->flush();
    }
}
