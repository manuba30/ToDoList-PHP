<?php 
//mesmo nome que nos damos no composer.json
namespace App\Todolist\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController{

    public function index(){
        $tasks = [
            "faire des courses","finir le projet","faire du sport"
        ];
        // echo "page d'accueil";
        //var_dump(dirname(__DIR__));
        //determine le dossie qui va contenir les fichiers twig
        $loader = new FilesystemLoader("../templates");
        //initialiser twig
        $twig = new Environment($loader);
        //rendre une vue
        echo $twig->render('homepage.twig',  [
            'title'=>"Accueil",
            'tasks'=>$tasks,
        ]);
    }
    
}
