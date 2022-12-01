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

    public function __construct(CategoryRepository $categoryRepository, 
    ManagerRegistry $managerRegistry)
    {
        $this->repository = $categoryRepository;
        $this->manager = $managerRegistry->getManager();
        //$this->request = $request;
    }

    #[Route('/', name: 'category_index')]
    public function index()
    {
        $categorys = $this->repository->findAll();
        return $this->render(
            'category/index.html.twig',
            [
                'categorys' => $categorys
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
        //check xem còn movie trong category hay không trước khi xóa
        if (count($category->getMovies()) == 0) {
            $this->manager->remove($category);
            $this->manager->flush();
        }
        return $this->redirectToRoute('category_index');
    }
}
