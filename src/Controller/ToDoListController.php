<?php

namespace App\Controller;

use App\Entity\ToDoList;
use App\Service\ToDoItemService;
use App\Service\ToDoListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{

    public function __construct(
        private readonly ToDoListService $toDoListService,
    )
    {
    }




    #[Route('/delete/{id}', name: 'delete_list')]
    public function deleteList(int $id): Response
    {
        $this->toDoListService->deleteToDoList($id);
        return $this->redirectToRoute('add_list');
    }


    #[Route('/add_user/{id}', name: 'add_user')]
    public function addUser(Request $request, int $id): Response
    {
        $this->toDoListService->addNewUserToAccessList($request->get('user_id'), $id);
        return $this->redirectToRoute('add_list');
    }

}