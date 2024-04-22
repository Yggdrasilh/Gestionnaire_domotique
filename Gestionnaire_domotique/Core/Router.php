<?php

namespace App\Core;


class Router
{

    public function routes()
    {
        session_start();
        $controller = (isset($_GET['controller']) ? ucfirst(array_shift($_GET)) : 'Module');
        $action = (isset($_GET['action']) ? array_shift($_GET) : 'index');


        if (isset($_SESSION['nom_utilisateur'])) {

            $controller = '\\App\\Controllers\\' . $controller . 'Controller';

            $controller = new $controller();
        } elseif ($action != 'login' && $action != 'inscription') {
            $controller = 'User';
            $action = 'login';
            $controller = '\\App\\Controllers\\' . $controller . 'Controller';

            $controller = new $controller();
        } else {
            $controller = '\\App\\Controllers\\' . $controller . 'Controller';

            $controller = new $controller();
        }



        if (method_exists($controller, $action)) {
            // Si $_GET contient des index, on exécute la méthode en passant comme argument les paramètres de $_GET ou alors
            // on exécute la méthode sans argument.
            // on vérifie également que l'accès de la page est bien autoriser à cette utilisateur

            // if ($_SESSION['acces'] ?? false) {

            //     $controller->$action();
            // } elseif ($controller . $action == 'UserControllerinscription') {

            //     $controller->$action();
            // } else {
            //     $controller = 'User' . 'Controller';
            //     $action = 'index';

            //     $controller = new $controller();
            //     $controller->$action();
            // }

            (isset($_GET)) ? call_user_func_array([$controller, $action], $_GET) : $controller->$action();
        } else {
            // On envoie le code réponse 404
            http_response_code(404);
            echo "La page recherchée n'existe pas";
        }
    }
}
