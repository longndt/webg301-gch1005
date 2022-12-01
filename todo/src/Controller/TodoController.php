<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/', name: 'todo_index')]
    public function viewTodoList(TodoRepository $todoRepository)
    {
        $todos = $todoRepository->findAll();
        return $this->render(
            'todo/index.html.twig',
            [
                'todos' => $todos
            ]
        );
    }

    #[Route('/detail/{id}', name: 'todo_detail')]
    public function viewTodoDetail($id, TodoRepository $todoRepository)
    {
        $todo = $todoRepository->find($id);
        if ($todo == null) {
            //gửi flash message về view
            $this->addFlash('Error', 'Todo not found !');
            return $this->redirectToRoute('todo_index');
        }
        return $this->render(
            'todo/detail.html.twig',
            [
                'todo' => $todo
            ]
        );
    }

    #[Route('/delete/{id}', name: 'todo_delete')]
    public function deleteTodo($id, TodoRepository $todoRepository, ManagerRegistry $managerRegistry)
    {
        $todo = $todoRepository->find($id);
        if ($todo == null) {
            //gửi flash message về view
            $this->addFlash('Error', 'Todo not found !');
            //return $this->redirectToRoute('todo_index');
        } else {
            //gọi object manager để xóa dữ liệu khỏi DB
            $manager = $managerRegistry->getManager();
            $manager->remove($todo);
            $manager->flush();
            $this->addFlash('Success', 'Delete todo succeed !');
        }
        return $this->redirectToRoute('todo_index');
    }

    #[Route('/add', name: 'todo_add')]
    public function addTodo(Request $request, ManagerRegistry $managerRegistry)
    {
        $todo = new Todo;
        $form = $this->createForm(TodoType::class, $todo);
        //$form->add('Add', SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $managerRegistry->getManager();
            $manager->persist($todo);
            $manager->flush();
            $this->addFlash('Success', 'Add new todo succeed !');
            return $this->redirectToRoute('todo_index');
        }

        return $this->renderForm(
            'todo/add.html.twig',
            [
                'TodoForm' => $form
            ]
        );
    }

    #[Route('/edit/{id}', name: 'todo_edit')]
    public function editTodo($id, Request $request, TodoRepository $todoRepository, ManagerRegistry $managerRegistry)
    {
        $todo = $todoRepository->find($id);
        if ($todo == null) {
            $this->addFlash('Error', 'Todo not found !');
            return $this->redirectToRoute('todo_index');
        }
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $managerRegistry->getManager();
            $manager->persist($todo);
            $manager->flush();
            $this->addFlash('Success', 'Edit todo succeed !');
            return $this->redirectToRoute('todo_index');
        }

        return $this->renderForm(
            'todo/edit.html.twig',
            [
                'TodoForm' => $form
            ]
        );
    }
}
