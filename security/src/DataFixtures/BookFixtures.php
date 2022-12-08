<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Book;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $author_list = ['David', 'Michael', 'John'];
        $image_list = ['book1.jpg','book2.jpg', 'book3.jpg'];
        for ($i=1; $i<=10; $i++){
            $author_random = array_rand($author_list,1);
            $image_random = array_rand($image_list,1);
            $book = new Book();
            $book->setTitle("Book $i")
                 ->setDate(DateTime::createFromFormat('Y/m/d','2022/05/17'))
                 ->setAuthor($author_list[$author_random])
                 ->setImage($image_list[$image_random])
                 ->setPrice((float)(rand(100,999)));
            $manager->persist($book);
        }

        $manager->flush();
    }
}
