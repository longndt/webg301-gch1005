<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Runtime\Symfony\Component\HttpFoundation\RequestRuntime;

class BlogController extends AbstractController
{
    //Cách 1: khai báo SerializerInterface sử dụng constructor
    private $blogRepository;
    private $registry;

    public function __construct(BlogRepository $blogRepository, ManagerRegistry $managerRegistry)
    {
        $this->blogRepository = $blogRepository;
        $this->registry = $managerRegistry;
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
        return new Response(
            $json,
            Response::HTTP_OK,
            [
                'content-type' => 'application/json',
                'Access-Control-Allow-Origin' => '*' //enable CORS
                // 'IDE' => 'VS Code'
            ]
        );
    }

    //SQL: SELECT * FROM Blog WHERE id = '$id'
    #[Route('/{id}', methods: 'GET', name: 'view_blog_by_id')]
    public function viewBlogById($id, SerializerInterface $serializer)
    {
        //$blog = $this->blogRepository->find($id);
        $blog = $this->registry->getManager()->getRepository(Blog::class)->find($id);
        //check xem id có tồn tại trong DB không => $blog có null hay không
        if ($blog == null) {
            $error = "<center><h1 style='color:red;'><i>Blog not found !</i></h1></center>";
            return new Response(
                $error,
                Response::HTTP_NOT_FOUND,
                [
                    'content-type' => 'text/html'
                ]
            );
        }
        //nếu có dữ liệu thì convert thành json và trả về response tương ứng
        $json = $serializer->serialize($blog, 'json');
        return new Response(
            $json,
            Response::HTTP_OK, //200
            [
                'content-type' => 'application/json'
            ]
        );
    }

    //SQL: DELETE FROM Blog WHERE id = '$id'
    #[Route('/{id}', methods: 'DELETE', name: 'delete_blog')]
    public function deleteBlog($id)
    {
        $blog = $this->blogRepository->find($id);
        if ($blog == null) {
            $error = "<center><h1 style='color:red;'><i>Blog is not exited !</i></h1></center>";
            return new Response(
                $error,
                Response::HTTP_BAD_REQUEST,  //400
                [
                    'content-type' => 'text/html'
                ]
            );
        }
        //khai báo entity manager để thực hiện thao tác xóa dữ liệu trong DB
        $manager = $this->registry->getManager();
        $manager->remove($blog);
        $manager->flush();
        $success = "<center><h1 style='color:blue;'><i>Blog has been deleted !</i></h1></center>";
        return new Response(
            $success,
            Response::HTTP_ACCEPTED, 
            //202 . Note: nếu sử dụng code 204 (HTTP_NO_CONTENT) thì sẽ không hiển thị được message
            [
                'content-type' => 'text/html'
            ]
        );
    }

    //Note: có thể set cùng 1 route url cho nhiều function khác nhau
    //với điều kiện là method khác nhau (chỉ áp dụng cho API)
    #[Route('/', methods: ['POST'], name: 'add_new_blog')]
    public function addNewBlog(Request $request)
    {
        //khởi tạo empty object cho Blog 
        $blog = new Blog;
        //lấy dữ liệu từ request của client
        $json = $request->getContent();
        //decode dữ liệu của json (key + value)
        $data = json_decode($json, true);
        //set giá trị cho từng thuộc tính của object
        $blog->setAuthor($data['author']);
        $blog->setContent($data['content']);
        $blog->setTitle($data['title']);
        $blog->setDatetime(\DateTime::createFromFormat('Y-m-d H:i:s', $data['datetime']));

        $manager = $this->registry->getManager();
        $manager->persist($blog);
        $manager->flush();
        $success = "<center><h1 style='color:blue;'><i>Blog has been created !</i></h1></center>";
        return new Response(
            $json,
            Response::HTTP_CREATED, //code: 201
            [
                'content-type' => 'application/json'
            ]
        );
    }

    #[Route('/{id}', methods: ['PUT'], name: 'update_blog')]
    public function updateBlog($id, Request $request) {
        //khởi tạo object cho Blog theo id trên URL
        $blog = $this->blogRepository->find($id);
        if ($blog == null) {
            $error = "<center><h1 style='color:red;'><i>Blog is not exited !</i></h1></center>";
            return new Response(
                $error,
                Response::HTTP_BAD_REQUEST,  //400
                [
                    'content-type' => 'text/html'
                ]
            );
        }
        //lấy dữ liệu từ request của client
        $json = $request->getContent();
        //decode dữ liệu của json (key + value)
        $data = json_decode($json, true);
        //set giá trị cho từng thuộc tính của object
        $blog->setAuthor($data['author']);
        $blog->setContent($data['content']);
        $blog->setTitle($data['title']);
        $blog->setDatetime(\DateTime::createFromFormat('Y-m-d H:i:s', $data['datetime']));

        $manager = $this->registry->getManager();
        $manager->persist($blog);
        $manager->flush();
        $success = "<center><h1 style='color:blue;'><i>Blog has been updated !</i></h1></center>";
        return new Response(
            $success,
            Response::HTTP_ACCEPTED, //code: 202
            [
                'content-type' => 'text/html'
            ]
        );
    }
}
