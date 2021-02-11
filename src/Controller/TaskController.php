<?php

declare(strict_types=1);

namespace App\Controller;

use LogicException;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(): void
    {
        $tasks = require __DIR__ . '/../../data.php';

        $this->renderView(
            'task/list.html.twig',
            [
                'tasks' => $tasks
            ]
        );
    }

    /**
     * @Route("/show/{id}", name="show", requirements={"id": "\d+"})
     * @param array $routeParams
     */
    public function show(array $routeParams): void
    {
        $tasks = require __DIR__ . '/../../data.php';

        $id = $routeParams['id'];

        if (!$id || !array_key_exists($id, $tasks)) {
            throw new LogicException("La tâche demandée n'existe pas !");
        }

        $this->renderView(
            'task/show.html.twig',
            [
                'task' => $tasks[$id]
            ]
        );
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump("Bravo, le formulaire est soumis (TODO : traiter les données)", $_POST);
            return;
        }
        $this->renderView('task/create.html.twig');
    }
}
