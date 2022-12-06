<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/category')]
class CategoryController extends AbstractController
{
    private $repository, $manager, $request;

    public function __construct(
        CategoryRepository $categoryRepository,
        ManagerRegistry $managerRegistry
    ) {
        $this->repository = $categoryRepository;
        $this->manager = $managerRegistry->getManager();
        //$this->request = $request;
    }

    #[Route('/', name: 'category_index')]
    public function index()
    {
        $categories = $this->repository->findAll();
        return $this->render(
            'category/index.html.twig',
            [
                'categories' => $categories
            ]
        );
    }

    #[Route('/detail/{id}', name: 'category_detail')]
    public function detail($id)
    {
        $category = $this->repository->find($id);
        return $this->render(
            'category/detail.html.twig',
            [
                'category' => $category
            ]
        );
    }

    #[Route('/delete/{id}', name: 'category_delete')]
    public function delete($id)
    {
        $category = $this->repository->find($id);
        $movies = $category->getMovies();
        //PA1: không cho xóa category nếu category đấy vẫn còn movie
        //PA2: xóa category và set category cho các movie liên quan thành null
        
        //PA3: xóa category và xóa toàn bộ các movie liên quan
        if (count($movies) > 0) {
            for ($i = 0; $i <= count($movies); $i++) {
                $this->manager->remove($movies[$i]);
                $this->manager->flush();
            }
        }
        $this->manager->remove($category);
        $this->manager->flush();
        $this->addFlash('Message', 'Delete category succeed !');
        //redirect về trang category index kể cả xóa thành công hay lỗi
        return $this->redirectToRoute('category_index');
    }
}
