<?php
namespace App\Todolist\Repository;

use App\Todolist\service\DataBase;

class TaskRepository
{
    public function index()
    {
        require_once "../src/service/config.php";
        $pdo = new DataBase();
        $tasks = $pdo->selectAll(
        "SELECT * FROM task");

        return $tasks;
    }
    public function add()
    {
        require_once "../src/service/config.php";
        $pdo = new Database();
        $pdo->query(
            "INSERT INTO `task` (`title`, `status`) VALUES (?,?)",
            [$_POST["title"], $_POST["status"]]
        );
    }
    public function find(int $id)
    {
        require_once "../src/service/config.php";
        //echo "task details";
        $pdo = new DataBase();
        //var_dump($pdo);
        $task = $pdo->select(
            "SELECT * FROM task WHERE id =" . $id
        );
        return $task;
    }
    public function remove(int $id){
        require_once "../src/service/config.php";
        //echo "task details";
        $pdo = new DataBase();
        $task = $pdo->query(
            "DELETE FROM task WHERE id =" . $id
        );
        return $task;
    }
    public function  update(int $id, string $title, string $status, string $responsable)
    {
        require_once "../src/service/config.php";
        $pdo = new DataBase();
        $task = $pdo->query("UPDATE task SET title= '$title', status= '$status', responsable= '$responsable' WHERE id=$id");
        return $task;
    }
    public function filter(string $condition)
    {
        require_once "../src/service/config.php";
        $pdo = new DataBase();
        $tasks = $pdo->selectAll("SELECT * FROM task WHERE $condition");

        return $tasks;
    }
    public function search($value){
        // var_dump($value);
        require_once "../src/service/config.php";
        $pdo = new DataBase();
        $tasks = $pdo->selectAll("SELECT * FROM task WHERE title LIKE '%" .$value . "%' ORDER BY id ");
        return $tasks;
    }
}