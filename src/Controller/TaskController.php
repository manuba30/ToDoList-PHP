<?php

namespace App\Todolist\Controller;

use App\Todolist\service\DataBase;
use App\Todolist\Repository\TaskRepository;


class TaskController extends AbstractController
{
    public function index()
    {
        $taskRepository = new TaskRepository();
        $tasks = $taskRepository->index();
        if(isset($_POST['search'])){
            $tasks = $taskRepository ->search($_POST[ 'search' ]);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $index=0;
            $condition = "";
            foreach( $_POST as $key => $value) {
                if($index === 0){
                    $condition .= "status='$_POST[$key]'";
                    $index++;
                    continue;
                }
                $condition .= " OR status='$_POST[$key]'";
                $index++;
            }

            $tasks = $taskRepository->filter($condition);
            // header("Location:/formation_php/13_restart/public/task/");
        }
        $this->render('Tasks.twig', [
            'title' => "tasks to do",
            'tasks' => $tasks,
        ]);
    }
    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // var_dump('toto3');
            $taskRepository = new TaskRepository();
            $tasks = $taskRepository->add();
            header("Location:/formation_php/13_restart/public/task/");
        }


        $this->render("taskNewPage.twig", []);
    }
    public function show(int $id)
    {
        $taskRepository = new TaskRepository();
        $task = $taskRepository->find($id);
        $this->render('TaskDetailPage.twig',  [
            'title' => "details of the tasks ",
            'task' => $task,
        ]);
    }
    public function delete(int $id)
    {
        $taskRepository = new TaskRepository();
        $task = $taskRepository->remove($id);
        header("Location:/formation_php/13_restart/public/task/");
    }
    public function update(int $id)
    {
        $taskRepository = new TaskRepository();
        $task = $taskRepository->find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // var_dump('toto3');
            $status = $_POST['status'];
            $title = $_POST['title'];
            $responsable = $_POST['responsable'];

            $taskRepository->update($id, $title, $status, $responsable);
            header("Location:/formation_php/13_restart/public/task/");
        }
        $this->render('taskUpdatePage.twig', [
            'task' => $task,
            'optionList' => ["En attente", "terminée", "En cours"],
        ]);
    }
    public function search() {
        $taskRepository = new TaskRepository();
        $tasks = $taskRepository->search($_POST['searchBar']);
        $this->render('Tasks.twig', [
            'title' => "tasks to do",
            'tasks' => $tasks,
        ]);
        // var_dump($tasks);
    }
}
