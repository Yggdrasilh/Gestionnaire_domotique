<?php

namespace App\Controllers;

use App\Core\Validator;
use App\Controllers\Controller;

class FoyerController extends Controller
{
    public function index()
    {
        // Appeler l'API pour récupérer mes foyers
        $apiUrl = $this->baseUrlApi . 'avoir/findMyFoyer/' . $_SESSION['id_utilisateur'];
        $apiData = file_get_contents($apiUrl);
        $myFoyerData = json_decode($apiData, true);

        if (empty($myFoyerData['avoir'])) {
            $myFoyerData = false;
        }

        $this->render('foyer/index', ['myFoyerData' => $myFoyerData]);
    }

    public function selectFoyer($id)
    {
        // Appeler l'API pour récupérer mes foyers
        $apiUrl = $this->baseUrlApi . 'foyer/findLink/' . $_SESSION['id_utilisateur'] . '/' . $id;
        $apiData = file_get_contents($apiUrl);
        $foyerData = json_decode($apiData, true);


        if (!empty($foyerData['foyer'])) {
            $_SESSION['id_foyer'] = $foyerData['foyer']['id'];
            $_SESSION['nom_foyer'] = $foyerData['foyer']['nom_foyer'];
            $_SESSION['photo_foyer'] = $foyerData['foyer']['photo_foyer'];
            $_SESSION['role_foyer'] = $foyerData['foyer']['role_utilisateur'];

            echo json_encode(array('reponse'  => true));
        } else {
            echo json_encode(array('reponse'  => false));
        }
    }


    public function creation()
    {
        $messageError = '';

        $keys = [
            'nom_foyer',
            'photo_foyer'
        ];
        // Je verifie que les champs sont remplis
        if (isset($_POST) && !empty($_POST)) {
            if (Validator::validPostSelect($_POST, $keys)) {

                // Je stocke les données et Je protege mes données.
                $foyerNom = $this->protected_values($_POST['nom_foyer']);
                if (isset($_FILES['photo_foyer']) && ($_FILES['photo_foyer']['error'] == 0)) {
                    move_uploaded_file($_FILES['photo_foyer']['tmp_name'], 'image/' . $_FILES['image']['name']);
                    $foyerPhoto = $this->protected_values('image/' . $_FILES['image']['name']);
                } else {
                    $foyerPhoto = $this->protected_values($_POST['photo_foyer'] ?? 'image/maison.webp');
                }


                // Je reprends le modele de ma BDD
                $userData = [
                    'nom_foyer' => $foyerNom,
                    'photo_foyer' => $foyerPhoto
                ];


                // Convertir les données en JSON
                $jsonData = json_encode($userData);

                // URL de votre API
                $apiUrl = $this->baseUrlApi . 'foyer/create/' . $_SESSION['id_utilisateur'];

                // Configuration de la requête HTTP
                $options = [
                    'http' => [
                        'header'  => 'Content-Type: application/json',
                        'method'  => 'POST',
                        'content' => $jsonData
                    ]
                ];


                $context  = stream_context_create($options);
                $result = file_get_contents($apiUrl, false, $context);
                // var_dump($result);
                // die;
                // Vérifier le résultat de la requête
                if ($result != '{"status":true}') {
                    // Gestion des erreurs
                    $messageError =  "<script>
                    window.onload = function() {
                      alert('Une erreur s'est produite lors de l'envoie des données. 
                      Veuillez recommencer !');
                    };
                  </script>";
                } else {

                    header('location:' . $this->baseUrlSite . 'index.php?controller=Foyer&action=index');
                }
            } else {
                $messageError =  "<script>
            window.onload = function() {
              alert('Veuillez renseigner tous les champs du formulaire !');
            };
          </script>";
            }
        }
        $this->render('foyer/creation', ['messageError' => $messageError]);
    }

    public function update()
    {

        $keys = [
            'nom_foyer',
            'photo_foyer',
            'id_foyer'
        ];

        // Je verifie que les champs sont remplis
        if (isset($_POST) && !empty($_POST)) {
            if (Validator::validPostSelect($_POST, $keys)) {

                // Je stocke les données et Je protege mes données.
                $foyerId = $this->protected_values($_POST['id_foyer']);
                $foyerNom = $this->protected_values($_POST['nom_foyer']);
                if (isset($_FILES['photo_foyer']) && ($_FILES['photo_foyer']['error'] == 0)) {
                    move_uploaded_file($_FILES['photo_foyer']['tmp_name'], 'image/' . $_FILES['image']['name']);
                    $foyerPhoto = $this->protected_values('image/' . $_FILES['image']['name']);
                } else {
                    $foyerPhoto = $this->protected_values($_POST['photo_foyer'] ?? 'image/maison.webp');
                }


                // Je reprends le modele de ma BDD
                $userData = [
                    'nom_foyer' => $foyerNom,
                    'photo_foyer' => $foyerPhoto,
                    'id' => $foyerId
                ];


                // Convertir les données en JSON
                $jsonData = json_encode($userData);

                // URL de votre API
                $apiUrl = $this->baseUrlApi . 'foyer/update';

                // Configuration de la requête HTTP
                $options = [
                    'http' => [
                        'header'  => 'Content-Type: application/json',
                        'method'  => 'PATCH',
                        'content' => $jsonData
                    ]
                ];


                $context  = stream_context_create($options);
                $result = file_get_contents($apiUrl, false, $context);

                // Vérifier le résultat de la requête
                if ($result != '{"status":true}') {
                    // Gestion des erreurs
                    echo  "<script>
                    window.onload = function() {
                      alert('Une erreur s'est produite lors de l'envoie des données. 
                      Veuillez actualiser la page et recommencer !');
                    };
                  </script>";
                } else {

                    header('location:' . $this->baseUrlSite . 'index.php?controller=Foyer&action=index');
                }
            } else {
                echo "<script>
            window.onload = function() {
              alert('Veuillez renseigner tous les champs du formulaire !');
            };
          </script>";
            }
        }
    }


    public function delete($id)
    {

        // URL de votre API
        $apiUrl = $this->baseUrlApi . 'foyer/delete/' . $id;

        // Configuration de la requête HTTP
        $options = [
            'http' => [
                'header'  => 'Content-Type: application/json',
                'method'  => 'DELETE',
            ]
        ];


        $context  = stream_context_create($options);
        $result = file_get_contents($apiUrl, false, $context);
        // var_dump($result);
        // die;
        // Vérifier le résultat de la requête
        if ($result != '{"status":true}') {
            // Gestion des erreurs
            echo json_encode(array('reponse'  => true));
        } else {
            echo json_encode(array('reponse'  => false));
        }
    }

    // ****************************************** User of link to the foyer ******************************************

    public function userOfFoyer()
    {
        // Appeler l'API pour récupérer mes foyers
        $apiUrl = $this->baseUrlApi . 'avoir/findUserOfFoyer/' . $_SESSION['id_foyer'];
        $apiData = file_get_contents($apiUrl);
        $myFoyerData = json_decode($apiData, true);

        if (empty($myFoyerData['avoir'])) {
            $myFoyerData = false;
        } else {
            foreach ($myFoyerData['avoir'] as $value) {

                if ($value['id_utilisateur'] == $_SESSION['id_utilisateur']) {
                    $authorisation = $value['role_utilisateur'];
                }
            }
        }

        $this->render('foyer/user', ['myFoyerData' => $myFoyerData, 'authorisation' => $authorisation]);
    }

    public function deleteUserOfFoyer($id)
    {

        // URL de votre API
        $apiUrl = $this->baseUrlApi . 'avoir/delete/' . $id . '/' . $_SESSION['id_foyer'];

        // Configuration de la requête HTTP
        $options = [
            'http' => [
                'header'  => 'Content-Type: application/json',
                'method'  => 'DELETE',
            ]
        ];


        $context  = stream_context_create($options);
        $result = file_get_contents($apiUrl, false, $context);
        // var_dump($result);
        // die;
        // Vérifier le résultat de la requête
        if ($result != '{"status":true}') {
            // Gestion des erreurs
            echo json_encode(array('reponse'  => false));
        } else {
            echo json_encode(array('reponse'  => true));
        }
    }

    public function updateUserRole()
    {
        $keys = [
            'role_foyer',
            'id_user'
        ];
        // Je verifie que les champs sont remplis
        if (Validator::validPostSelect($_POST, $keys)) {

            // Je stocke les données et Je protege mes données.
            $foyerRole = $this->protected_values($_POST['role_foyer']);
            $foyerUser = $this->protected_values($_POST['id_user']);



            // Je reprends le modele de ma BDD
            $userData = [
                'role_utilisateur' => $foyerRole,
                'id_utilisateur' => $foyerUser,
                'id_foyer' => $_SESSION['id_foyer']
            ];


            // Convertir les données en JSON
            $jsonData = json_encode($userData);

            // URL de votre API
            $apiUrl = $this->baseUrlApi . 'avoir/updateRole';

            // Configuration de la requête HTTP
            $options = [
                'http' => [
                    'header'  => 'Content-Type: application/json',
                    'method'  => 'PATCH',
                    'content' => $jsonData
                ]
            ];


            $context  = stream_context_create($options);
            $result = file_get_contents($apiUrl, false, $context);
            // var_dump($result);
            // die;
            // Vérifier le résultat de la requête
            if ($result != '{"status":true}') {
                // Gestion des erreurs
                echo  "<script>
                    window.onload = function() {
                      alert('Une erreur s'est produite lors de l'envoie des données. 
                      Veuillez actualiser la page et recommencer !');
                    };
                  </script>";
            } else {

                header('location:' . $this->baseUrlSite . 'index.php?controller=Foyer&action=userOfFoyer');
            }
        } else {
            echo  "<script>
            window.onload = function() {
              alert('Veuillez renseigner tous les champs du formulaire !');
            };
          </script>";
        }
    }

    public function addUserToFoyer()
    {
        $messageError = '';
        $validName = false;
        // Je récupère tout les noms qui existe déjà pour les transferer plus tard à la vue
        $apiUrl = $this->baseUrlApi . 'utilisateur/getAll';
        $apiReturn = file_get_contents($apiUrl);
        $userAllData = json_decode($apiReturn, true);
        $keys = [
            'nom_user',
        ];
        // Je verifie que les champs sont remplis
        if (isset($_POST) && !empty($_POST)) {

            $idUser = '';
            foreach ($userAllData['user'] as $value) {

                if ($value['nom_utilisateur']  == $_POST['nom_user']) {
                    $idUser = $value['id'];
                    $validName = true;
                    break;
                }
            }

            if ($validName) {


                // Je stocke les données et Je protege mes données.
                $id_User = $this->protected_values($idUser);


                // Je reprends le modele de ma BDD
                $userData = [
                    'id_foyer' => $_SESSION['id_foyer'],
                    'id_utilisateur' => $id_User,
                ];


                // Convertir les données en JSON
                $jsonData = json_encode($userData);

                // URL de votre API
                $apiUrl = $this->baseUrlApi . 'avoir/addUser';

                // Configuration de la requête HTTP
                $options = [
                    'http' => [
                        'header'  => 'Content-Type: application/json',
                        'method'  => 'POST',
                        'content' => $jsonData
                    ]
                ];


                $context  = stream_context_create($options);
                $result = file_get_contents($apiUrl, false, $context);
                // var_dump($result);
                // die;
                // Vérifier le résultat de la requête
                if ($result != '{"status":true}') {
                    // Gestion des erreurs
                    $messageError =  "<script>
                    window.onload = function() {
                      alert('Une erreur s'est produite lors de l'envoie des données. 
                      Veuillez recommencer !');
                    };
                  </script>";
                } else {

                    header('location:' . $this->baseUrlSite . 'index.php?controller=Foyer&action=userOfFoyer');
                }
            } else {
                $messageError =  "<script>
            window.onload = function() {
              alert('Veuillez renseigner un nom valide !');
            };
          </script>";
            }
        }
        $this->render('foyer/addUserForm', ['userAllData' => $userAllData, 'messageError' => $messageError]);
    }
}
