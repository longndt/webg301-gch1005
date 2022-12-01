<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/actor')]
class ActorController extends AbstractController
{
    private $repository, $manager, $request;

    public function __construct(ActorRepository $actorRepository, 
    ManagerRegistry $managerRegistry)
    {
        $this->repository = $actorRepository;
        $this->manager = $managerRegistry->getManager();
        //$this->request = $request;
    }

    #[Route('/', name: 'actor_index')]
    public function index()
    {
        $actors = $this->repository->findAll();
        return $this->render(
            'actor/index.html.twig',
            [
                'actors' => $actors
            ]
        );
    }

    #[Route('/detail/{id}', name: 'actor_detail')]
    public function detail($id)
    {
        $actor = $this->repository->find($id);
        return $this->render(
            'actor/detail.html.twig',
            [
                'actor' => $actor
            ]
        );
    }

    #[Route('/delete/{id}', name: 'actor_delete')]
    public function delete($id)
    {
        $actor = $this->repository->find($id);
        $this->manager->remove($actor);
        $this->manager->flush();
        return $this->redirectToRoute('actor_index');
    }
}
