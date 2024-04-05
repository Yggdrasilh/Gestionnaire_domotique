<?php

namespace App\Controllers;


use App\Core\Validator;
use App\Entities\Utilisateur;
use App\Models\UtilisateurModel;

class UtilisateurController extends Controller
{

    public function listAll()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        echo  json_encode(["user" => (new UtilisateurModel())->findAll()]);
    }

    public function listOne()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $id = $_GET['id'] ?? '';


        echo  json_encode(["user" => (new UtilisateurModel())->findOne($id)]);
    }

    public function authentification()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $login = $_GET['login'] ?? '';
        $connexion = (new UtilisateurModel())->connexion($login);


        echo  json_encode(["user" => $connexion]);
    }

    function inscription()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $utilisateurModel = new UtilisateurModel();
        $messageError = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');

            // Convertir les données JSON en tableau PHP
            $data = json_decode($json, true);

            //tableau de qui référence toute les clés qui corresponde au champs de formulaire
            $keys = [
                'nom_utilisateur',
                'email_utilisateur',
                'mdp_utilisateur',
                'photo_utilisateur'
            ];


            //vérification que tout les champs de formulaire sont remplie et gestion des erreurs
            if (Validator::validPostSelect($data, $keys)) {

                $utilisateur = new Utilisateur;
                $utilisateur->setNom_utilisateur($this->protected_values($data['nom_utilisateur']));
                $utilisateur->setEmail_utilisateur($this->protected_values($data['email_utilisateur']));
                $utilisateur->setMdp_utilisateur($this->protected_values($data['mdp_utilisateur']));
                $utilisateur->setPhoto_utilisateur($this->protected_values($data['photo_utilisateur']));


                $utilisateurModel->create($utilisateur);
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
            $utilisateurModel = new UtilisateurModel();

            // vérifier que l'id est bien renseigner
            if ($id != '') {
                $utilisateurModel->delete($id);

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

        $utilisateurModel = new UtilisateurModel();
        $messageError = '';
        $id = $_GET['id'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');

            // Convertir les données JSON en tableau PHP
            $data = json_decode($json, true);

            //tableau de qui référence toute les clés qui corresponde au champs de formulaire
            $keys = [
                'nom_utilisateur',
                'email_utilisateur',
                'photo_utilisateur'
            ];


            //vérification que tout les champs de formulaire sont remplie et gestion des erreurs
            if (Validator::validPostSelect($data, $keys) && $id != '') {

                $utilisateur = new Utilisateur;
                $utilisateur->setNom_utilisateur($this->protected_values($data['nom_utilisateur']));
                $utilisateur->setEmail_utilisateur($this->protected_values($data['email_utilisateur']));
                $utilisateur->setPhoto_utilisateur($this->protected_values($data['photo_utilisateur']));

                $utilisateurModel->update($utilisateur, $id);
                echo  json_encode(['status' => true]);
            } else {
                $messageError =  "Tous les champs du formulaire ne sont pas correctement renseignés OU l'id n'est pas bien passer en paramètre !";
                echo  json_encode(['status' => false, 'message' => $messageError]);
            }
        }
    }

    function updateMdp()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PATCH");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $utilisateurModel = new UtilisateurModel();
        $messageError = '';
        $id = $_GET['id'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');

            // Convertir les données JSON en tableau PHP
            $data = json_decode($json, true);

            //tableau de qui référence toute les clés qui corresponde au champs de formulaire
            $keys = [
                'mdp_utilisateur'
            ];


            //vérification que tout les champs de formulaire sont remplie et gestion des erreurs
            if (Validator::validPostSelect($data, $keys) && $id != '') {

                $utilisateur = new Utilisateur;
                $utilisateur->setMdp_utilisateur($this->protected_values($data['mdp_utilisateur']));

                $utilisateurModel->updateMdp($utilisateur, $id);
                echo  json_encode(['status' => true]);
            } else {
                $messageError =  "Tous les champs ne sont pas correctement renseignés !";
                echo  json_encode(['status' => false, 'message' => $messageError]);
            }
        }
    }
}
