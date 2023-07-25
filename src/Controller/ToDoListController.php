<?php

namespace App\Controller;

use App\Service\ToDoItemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{

    public function __construct(
        private readonly ToDoItemService $toDoItemService
    ) {
    }


    #[Route('/end-task/{id}/{status}', name: 'end_task')]
    public function endTask(int $id, string $status): Response
    {
        $status = $status === 'true';
        $this->toDoItemService->endTask($id, $status);
        return $this->json(['success' => true]);
    }


    #[Route('/add-task', name: 'add_task')]
    public function addTask(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $this->toDoItemService->addTask($data['list_id'], $data['task_name']);
        return $this->json(['success' => true]);
    }

}