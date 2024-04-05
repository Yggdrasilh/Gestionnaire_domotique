<?php

namespace App\Controllers;


use App\Core\Validator;
use App\Entities\Foyer;
use App\Models\FoyerModel;

class FoyerController extends Controller
{

    // public function getAll()
    // {
    //     header("Access-Control-Allow-Origin: *");
    //     header("Content-Type: application/json; charset=UTF-8");
    //     header("Access-Control-Allow-Methods: GET");
    //     header("Access-Control-Max-Age: 3600");
    //     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    //     echo  json_encode(["foyer" => (new FoyerModel())->findAll()]);
    // }

    public function getOneAndModule()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $id_foyer = $_GET['id'] ?? '';


        echo  json_encode(["foyer" => (new FoyerModel())->findOne($id_foyer)]);
    }

    function create()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $id = $_GET['id_utilisateur'] ?? '';
        $foyerModel = new FoyerModel();
        $messageError = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');

            // Convertir les données JSON en tableau PHP
            $data = json_decode($json, true);

            //tableau de qui référence toute les clés qui corresponde au champs de formulaire
            $keys = [
                'nom_foyer',
                'photo_foyer',
            ];


            //vérification que tout les champs de formulaire sont remplie et gestion des erreurs
            if (Validator::validPostSelect($data, $keys) && $id != '') {

                $foyer = new Foyer;
                $foyer->setNom_foyer($this->protected_values($data['nom_foyer']));
                $foyer->setPhoto_foyer($this->protected_values($data['photo_foyer']));


                $foyerModel->create($foyer, $id);
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
            $foyerModel = new FoyerModel();

            // vérifier que l'id est bien renseigner
            if ($id != '') {
                $foyerModel->delete($id);

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
        header("Access-Control-Allow-Methods: PATCH");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $foyerModel = new FoyerModel();
        $messageError = '';

        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');

            // Convertir les données JSON en tableau PHP
            $data = json_decode($json, true);

            //tableau de qui référence toute les clés qui corresponde au champs de formulaire
            $keys = [
                'nom_foyer',
                'photo_foyer',
                'id'
            ];


            //vérification que tout les champs de formulaire sont remplie et gestion des erreurs
            if (Validator::validPostSelect($data, $keys)) {

                $foyer = new Foyer;
                $foyer->setNom_foyer($this->protected_values($data['nom_foyer']));
                $foyer->setPhoto_foyer($this->protected_values($data['photo_foyer']));
                $foyer->setId($this->protected_values($data['id']));

                $foyerModel->update($foyer);
                echo  json_encode(['status' => true]);
            } else {
                $messageError =  "Un problème est survenue !";
                echo  json_encode(['status' => false, 'message' => $messageError]);
            }
        }
    }
}
