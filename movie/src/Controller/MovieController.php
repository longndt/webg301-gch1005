<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie')]
class MovieController extends AbstractController
{
    private $repository, $manager;

    public function __construct(MovieRepository $movieRepository, ManagerRegistry $managerRegistry)
    {
        $this->repository = $movieRepository;
        $this->manager = $managerRegistry->getManager();
        //$this->request = $request; 
    }

    #[Route('/', name: 'movie_index')]
    public function index()
    {
        $movies = $this->repository->findAll();
        return $this->render('movie/index.html.twig', 
        [
            'movies' => $movies
        ]);
    }

    #[Route('/detail/{id}', name: 'movie_detail' )]
    public function detail($id) {
        $movie = $this->repository->find($id);
        return $this->render('movie/detail.html.twig',
        [
            'movie' => $movie
        ]);
    }

    #[Route('/delete/{id}', name: 'movie_delete')]
    public function delete($id) {
        $movie = $this->repository->find($id);
        $this->manager->remove($movie);
        $this->manager->flush();
        return $this->redirectToRoute('movie_index');
    }
}
