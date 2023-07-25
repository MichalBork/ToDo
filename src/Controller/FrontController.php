<?php

namespace App\Controller;

use App\Form\ListItemType;
use App\Form\NewToDoListForm;
use App\Service\ToDoItemService;
use App\Service\ToDoListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{

    public function __construct(
        private readonly ToDoListService $toDoListService,
        private readonly ToDoItemService $toDoItemService
    ) {
    }


    private function getResourceForNavBar(): array
    {
        $lists = $this->toDoListService->getToDoList($this->getUser()->getId());

        $resource = [];
        foreach ($lists as $list) {
            $resource[] = [
                'name' => $list->getList()->getName(),
                'id' => $list->getList()->getId()
            ];
        }

        return $resource;
    }


    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->redirectToRoute('add_list');
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

        return $this->render(
            'to_do_list/add_new_list_form.html.twig',
            [
                'form' => $form->createView(),
                'lists' => $this->getResourceForNavBar()
            ]
        );
    }


    #[Route('/list/{id}', name: 'show_list')]
    public function showList(int $id, Request $request): Response
    {
        $form = $this->createForm(ListItemType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $this->toDoItemService->addTask($id, $data['task']);
        }


        list($list, $items) = $this->getListForUser($id);


        return $this->render(
            'to_do_list/to_do_list.html.twig',
            [
                'list' => $list,
                'items' => $items,
                'lists' => $this->getResourceForNavBar(),
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param int $id
     * @return array
     */
    private function getListForUser(int $id): array
    {
        $list = $this->toDoListService->getListById($id);

        $items = [];

        foreach ($list as $item) {
            $items = $item->getItems()->toArray();
        }
        return array($list, $items);
    }

}