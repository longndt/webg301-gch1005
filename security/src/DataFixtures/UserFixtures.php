<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;

    //khai báo thư viện để mã hóa password
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->hasher = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        //tạo tài khoản test cho role "ADMIN"
        $user1 = new User;
        $user1->setUsername("admin")
              ->setRoles(["ROLE_ADMIN"])
              ->setPassword($this->hasher->hashPassword($user1,"123456"));
        $manager->persist($user1);

        //tạo tài khoản test cho role "USER"
        $user2 = new User;
        $user2->setUsername("user")
              ->setRoles(["ROLE_USER"])
              ->setPassword($this->hasher->hashPassword($user2, "123456"));
        $manager->persist($user2);

        $manager->flush();
    }
}
