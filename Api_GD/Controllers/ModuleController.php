<?php

namespace App\Controllers;


use App\Core\Validator;
use App\Entities\Module;
use App\Models\ModuleModel;

class ModuleController extends Controller
{

    public function listAllByFoyer()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $id = $_GET['id_foyer'] ?? '';


        echo  json_encode(["module" => (new ModuleModel())->findAllByFoyer($id)]);
    }

    public function getHighestPosition()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $id = $_GET['id_foyer'] ?? '';


        echo  json_encode(["module" => (new ModuleModel())->findHighestPosition($id)]);
    }

    public function listOne()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $id = $_GET['id'] ?? '';


        echo  json_encode(["module" => (new ModuleModel())->findOne($id)]);
    }



    function create()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $moduleModel = new ModuleModel();
        $messageError = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');

            // Convertir les données JSON en tableau PHP
            $data = json_decode($json, true);

            //tableau de qui référence toute les clés qui corresponde au champs de formulaire
            $keys = [
                'nom_module',
                'type_module',
                'photo_module',
                'position_module',
                'url_open_module',
                'url_var_module',
                'url_close_module',
                'timer_module',
                'id_foyer'
            ];


            //vérification que tout les champs de formulaire sont remplie et gestion des erreurs
            if (Validator::validPostSelect($data, $keys)) {

                $module = new Module;
                $module->setNom_module($this->protected_values($data['nom_module']));
                $module->setType_module($this->protected_values($data['type_module']));
                $module->setPhoto_module($this->protected_values($data['photo_module']));
                $module->setPosition_module($this->protected_values($data['position_module']));
                $module->setUrl_open_module($this->protected_values($data['url_open_module']));
                $module->setUrl_var_module($this->protected_values($data['url_var_module']));
                $module->setUrl_close_module($this->protected_values($data['url_close_module']));
                $module->setTimer_module($this->protected_values($data['timer_module']));
                $module->setId_foyer($this->protected_values($data['id_foyer']));


                $moduleModel->create($module);
                echo  json_encode(['status' => true]);
            } else {
                $messageError =  "Tous les champs du formulaire ne sont pas correctement renseignés !";
                echo  json_encode(['status' => false, 'message' => $messageError]);
            }
        }
    }

    function delete()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $id = $_GET['id'] ?? '';
            $moduleModel = new ModuleModel();

            // vérifier que l'id est bien renseigner
            if ($id != '') {
                $moduleModel->delete($id);

                echo  json_encode(['status' => true]);
            } else {
                echo  json_encode(['status' => false, 'message' => "Vérifier que le paramètre est bien passer"]);
            }
        }
    }

    function update()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PUT");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $moduleModel = new ModuleModel();
        $messageError = '';
        $id = $_GET['id'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');

            // Convertir les données JSON en tableau PHP
            $data = json_decode($json, true);

            //tableau de qui référence toute les clés qui corresponde au champs de formulaire
            $keys = [
                'nom_module',
                'type_module',
                'photo_module',
                'position_module',
                'url_open_module',
                'url_var_module',
                'url_close_module',
                'timer_module',
                'id_foyer'
            ];


            //vérification que tout les champs de formulaire sont remplie et gestion des erreurs
            if (Validator::validPostSelect($data, $keys)) {

                $module = new Module;
                $module->setNom_module($this->protected_values($data['nom_module']));
                $module->setType_module($this->protected_values($data['type_module']));
                $module->setPhoto_module($this->protected_values($data['photo_module']));
                $module->setPosition_module($this->protected_values($data['position_module']));
                $module->setUrl_open_module($this->protected_values($data['url_open_module']));
                $module->setUrl_var_module($this->protected_values($data['url_var_module']));
                $module->setUrl_close_module($this->protected_values($data['url_close_module']));
                $module->setTimer_module($this->protected_values($data['timer_module']));
                $module->setId_foyer($this->protected_values($data['id_foyer']));


                $moduleModel->update($module, $id);
                echo  json_encode(['status' => true]);
            } else {
                $messageError =  "Tous les champs du formulaire ne sont pas correctement renseignés OU l'id n'est pas bien passer en paramètre !";
                echo  json_encode(['status' => false, 'message' => $messageError]);
            }
        }
    }

    function updatePosition()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PATCH");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $moduleModel = new ModuleModel();
        $messageError = '';

        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');

            // Convertir les données JSON en tableau PHP
            $data = json_decode($json, true);

            //tableau de qui référence toute les clés qui corresponde au champs de formulaire
            $keys = [
                'id_module',
                'position_module'
            ];


            //vérification que tout les champs de formulaire sont remplie et gestion des erreurs
            if (Validator::validPostSelect($data, $keys)) {

                $module = new Module;
                $module->setId($this->protected_values($data['id_module']));
                $module->setPosition_module($this->protected_values($data['position_module']));

                $moduleModel->updatePosition($module);
                echo  json_encode(['status' => true]);
            } else {
                $messageError =  "Tous les champs ne sont pas correctement renseignés !";
                echo  json_encode(['status' => false, 'message' => $messageError]);
            }
        }
    }
}
