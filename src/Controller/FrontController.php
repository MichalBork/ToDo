<?php

namespace App\Controller;

use App\Form\NewToDoListForm;
use App\Service\ToDoListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{

    public function __construct(
        private readonly ToDoListService $toDoListService,
    )
    {
    }


    #[Route('/', name: 'home')]
    public function index(): Response
    {



        return $this->render('to_do_list/to_do_list.html.twig');
    }

    #[Route('/add', name: 'add_list')]
    public function addNewListForm(Request $request): Response
    {
        $form = $this->createForm(NewToDoListForm::class, null, [
            'action' => $this->generateUrl('add_list'),
            'method' => 'POST'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->toDoListService->addToDoList($this->getUser()->getId(), $data['list_name']);
            return $this->redirectToRoute('add_list');
        }

        return $this->render('to_do_list/add_new_list_form.html.twig', ['form' => $form->createView()]);
    }



    #[Route('/list/{id}', name: 'show_list')]
    public function showList(int $id): Response
    {
        $list = $this->toDoListService->getToDoList($id);
        dd($list[0]->getList()->getItems());
        return $this->render('to_do_list/show_list.html.twig', ['list' => $list]);
    }

}