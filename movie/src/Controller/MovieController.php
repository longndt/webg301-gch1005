<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

#[Route('/movie')]
class MovieController extends AbstractController
{
    private $repository, $manager;

    public function __construct(MovieRepository $movieRepository, ManagerRegistry $managerRegistry)
    {
        $this->repository = $movieRepository;
        $this->manager = $managerRegistry->getManager();
    }

    #[Route('/', name: 'movie_index')]
    public function index()
    {
        //$movies = $this->repository->findAll();
        $movies = $this->repository->sortNewestToOldest();
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

    #[Route('/add', name: 'add_movie')]
    public function add(Request $request) {
        $movie = new Movie;
        $form = $this->createForm(MovieType::class, $movie);
        $form->add('Add', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($movie);
            $this->manager->flush();
            $this->addFlash('Message','Add movie succeed !');
            return $this->redirectToRoute('movie_index');
        }
        return $this->renderForm('movie/add.html.twig',
        [
            'movieForm' => $form
        ]);
    }

    #[Route('/asc', name: 'sort_movie_name_ascending')]
    public function sortNameAscending() {
        $movies = $this->repository->sortNameAsc();
        return $this->render('movie/index.html.twig',
        [
            'movies' => $movies
        ]);
    }

    #[Route('/desc', name: 'sort_movie_name_descending')]
    public function sortNameDescending()
    {
        $movies = $this->repository->sortNameDesc();
        return $this->render(
            'movie/index.html.twig',
            [
                'movies' => $movies
            ]
        );
    }

    #[Route('/search', name: 'search_movie_title')]
    public function searchMovie (Request $request) {
        $title = $request->get('keyword');
        $movies = $this->repository->searchMovieByTitle($title);
        return $this->render(
            'movie/index.html.twig',
            [
                'movies' => $movies
            ]
        );
    }
}
