<?php

namespace App\Controllers;


use App\Core\Validator;
use App\Entities\Avoir;
use App\Models\AvoirModel;

class AvoirController extends Controller
{

    public function getAll()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        echo  json_encode(["avoir" => (new AvoirModel())->findAll()]);
    }

    public function listFoyerOfUser()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $id = $_GET['id'] ?? '';


        echo  json_encode(["avoir" => (new AvoirModel())->findAllByUser($id)]);
    }

    public function listUserByFoyer()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $id = $_GET['id'] ?? '';


        echo  json_encode(["avoir" => (new AvoirModel())->findAllByFoyer($id)]);
    }



    function create()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $avoirModel = new AvoirModel();
        $messageError = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');

            // Convertir les données JSON en tableau PHP
            $data = json_decode($json, true);

            //tableau de qui référence toute les clés qui corresponde au champs de formulaire
            $keys = [
                'id_foyer',
                'id_utilisateur',
            ];


            //vérification que tout les champs de formulaire sont remplie et gestion des erreurs
            if (Validator::validPostSelect($data, $keys)) {

                $avoir = new Avoir;
                $avoir->setId_foyer($this->protected_values($data['id_foyer']));
                $avoir->setId_utilisateur($this->protected_values($data['id_utilisateur']));


                $avoirModel->create($avoir);
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
            $id_user = $_GET['id_user'] ?? '';
            $id_foyer = $_GET['id_foyer'] ?? '';
            $avoirModel = new AvoirModel();

            // vérifier que l'id est bien renseigner
            if ($id_user != '' && $id_foyer != '') {
                $avoirModel->delete($id_user, $id_foyer);

                echo  json_encode(['status' => true]);
            } else {
                echo  json_encode(['status' => false, 'message' => "Vérifier que le paramètre est bien passer"]);
            }
        }
    }


    function updateRole()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PATCH");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $avoirModel = new AvoirModel();
        $messageError = '';

        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');

            // Convertir les données JSON en tableau PHP
            $data = json_decode($json, true);

            //tableau de qui référence toute les clés qui corresponde au champs de formulaire
            $keys = [
                'role_utilisateur',
                'id_utilisateur',
                'id_foyer'
            ];


            //vérification que tout les champs de formulaire sont remplie et gestion des erreurs
            if (Validator::validPostSelect($data, $keys)) {

                $avoir = new Avoir;
                $avoir->setRole_utilisateur($this->protected_values($data['role_utilisateur']));
                $avoir->setId_utilisateur($this->protected_values($data['id_utilisateur']));
                $avoir->setId_foyer($this->protected_values($data['id_foyer']));

                $avoirModel->update($avoir);
                echo  json_encode(['status' => true]);
            } else {
                $messageError =  "Un problème est survenue !";
                echo  json_encode(['status' => false, 'message' => $messageError]);
            }
        }
    }
}
