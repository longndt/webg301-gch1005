<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use LDAP\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BlogController extends AbstractController
{
    //Cách 1: khai báo SerializerInterface sử dụng constructor
    private $serializer1;

    public function __construct(SerializerInterface $serializerInterface)
    {
        $this->serializer1 = $serializerInterface;
    }

    //SQL: SELECT * FROM Blog
    #[Route('/', methods: ['GET'], name: 'view_all_blog')]
    //Cách 2: khai báo SerializerInterface sử dụng parameter
    public function viewBlogList(SerializerInterface $serializer2, BlogRepository $blogRepository)
    {
        //Bước 1: lấy dữ liệu từ bảng Blog trong DB và lưu vào array
        $blogs = $blogRepository->findAll();
        //Bước 2: chuyển đổi dữ liệu sang API (JSON hoặc XML) sử dụng SerializerInterface
        $json = $this->serializer1->serialize($blogs, 'json');
        $xml = $serializer2->serialize($blogs, 'xml');
        //Bước 3: trả về API
        return new Response($json, 404,
            [
                'content-type' => 'application/json'
            ]
        );
        //200: HTTP_OK
    }

    //Note: có thể set cùng 1 route url cho nhiều function khác nhau
    //với điều kiện là method khác nhau
    #[Route('/', methods: ['POST'], name: 'add_new_blog')]
    public function createNewBlog()
    {
        
    }
}
