<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $authors = ["Minh", "Huong", "Tuan", "Thao", "Linh"];
        for ($i = 1; $i <= 20; $i++) {
            $blog = new Blog;
            $blog->setTitle("Blog $i")
                ->setAuthor($authors[rand(0, 4)])
                ->setContent("Demo blog from Greenwich Vietnam")
                ->setDatetime(\DateTime::createFromFormat('Y-m-d H:i:s', '2022-11-19 16:33:45'));
            $manager->persist($blog);
        }

        $manager->flush();
    }
}
