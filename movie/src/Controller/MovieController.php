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
    private $movieRepository, $manager, $request;

    public function __construct(MovieRepository $movieRepository, ManagerRegistry $managerRegistry, Request $request)
    {
        $this->movieRepository = $movieRepository;
        $this->manager = $managerRegistry->getManager();
        $this->request = $request; 
    }

    #[Route('/', name: 'movie_index')]
    public function index()
    {
        $movies = $this->movieRepository->findAll();
        return $this->render('movie/index.html.twig', 
        [
            'movies' => $movies
        ]);
    }

    #[Route('/detail/{id}', name: 'movie_detail' )]
    public function detail($id) {
        $movie = $this->movieRepository->find($id);
        return $this->render('movie/detail.html.twig',
        [
            'movie' => $movie
        ]);
    }

    #[Route('/delete/{id}', name: 'movie_delete')]
    public function delete($id) {
        $movie = $this->movieRepository->find($id);
        $this->manager->remove($movie);
        return $this->redirectToRoute('movie_index');
    }
}