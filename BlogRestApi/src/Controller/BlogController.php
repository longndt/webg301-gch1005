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
    private $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    //SQL: SELECT * FROM Blog
    #[Route('/', methods: 'GET', name: 'view_all_blog')]
    //Cách 2: khai báo SerializerInterface sử dụng parameter
    public function viewBlogList(SerializerInterface $serializer)
    {
        //Bước 1: lấy dữ liệu từ bảng Blog trong DB và lưu vào array
        $blogs = $this->blogRepository->findAll();
        //Bước 2: chuyển đổi dữ liệu sang API (JSON hoặc XML) sử dụng SerializerInterface
        $json = $serializer->serialize($blogs, 'json');
        $xml = $serializer->serialize($blogs, 'xml');
        //Bước 3: trả về API
        return new Response($json, Response::HTTP_OK,
            [
                'content-type' => 'application/json',
               // 'IDE' => 'VS Code'
            ]
        );
    }



    
    //Note: có thể set cùng 1 route url cho nhiều function khác nhau
    //với điều kiện là method khác nhau
    #[Route('/', methods: ['POST'], name: 'add_new_blog')]
    public function createNewBlog()
    {
        
    }
}
