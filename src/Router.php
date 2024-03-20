<?php

namespace App\Todolist;

use App\Todolist\Controller\HomeController;
use App\Todolist\Controller\TaskController;

class Router
{

    public function index()
    {

        $routes = [
            '/' => [
                'controller' => 'HomeController@index',
                'method' => 'GET'
            ],
            '/task' => [
                'controller' => 'TaskController@index',
                'method' => 'GET'
            ],
            '/task/new' => [
                'controller' => 'TaskController@new',
                'method' => 'POST'
            ],
            '/task/:id' => [
                'TaskController@show',
                'method' => 'GET'
            ],
        ];
        // 1)Récupérer l'URL demandée
        $url = $_SERVER['REQUEST_URI'];
        // var_dump($url);
        // 2)Trouver le controller et la méthode correspondante
        if ($url === "/formation_php/13_restart/public/") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new HomeController();
            $controller->index();
        }
        if ($url === "/formation_php/13_restart/public/task/new") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->new();
        }
        if ($url === "/formation_php/13_restart/public/task/") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $controller->search();
                die();
            }
            $controller->index();
        }
        $parts = explode("/", $url);
        // var_dump($parts);
        if (array_key_exists(5, $parts) && $parts[5] !== "" && $parts[5] !== "new" && $parts[4] === "task" && $parts[6] !== "update") {
            //var_dump('toto');
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->show((int)$parts[5]);
        }
        // Inclure le fichier du contrôleur avec "require_once"

        // Gérer les erreurs (par exemple, afficher une page 404)

        if (array_key_exists(6, $parts) && $parts[6] === "delete" && $parts[4] === "task") {
            // var_dump('toto');
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->delete((int)$parts[5]);
        }
        if (array_key_exists(6, $parts) && $parts[6] === "update" && $parts[4] === "task") {
            // var_dump('toto');
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->update((int)$parts[5]);
    }
    }
}