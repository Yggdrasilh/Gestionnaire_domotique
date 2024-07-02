<?php

namespace App\Controllers;

use App\Core\Validator;
use App\Controllers\Controller;

class ModuleController extends Controller
{
    public function index()
    {


        if (isset($_SESSION['id_foyer']) && !empty($_SESSION['id_foyer'])) {
            // Appeler l'API pour récupérer les modules du foyer
            $apiUrl = $this->baseUrlApi . 'module/findAllByFoyer/' . $_SESSION['id_foyer'];
            $apiData = file_get_contents($apiUrl);
            $moduleData = json_decode($apiData, true);

            if (empty($moduleData['module'])) {
                $moduleData = 'noModule';
            }
        } else {
            $moduleData = false;
        }



        $this->render('home/index', ['moduleData' => $moduleData]);
    }

    public function workModule($url)
    {
        $url = $url ?? '';

        if (!empty($url) && isset($url)) {
            // Appeler l'API pour récupérer mes foyers

            $moduleAction = file_get_contents($url);
            $result = json_decode($moduleAction, true);
            // var_dump($result);
            // die;
        }
    }

    public function add()
    {

        $messageError = 'passe';

        if (isset($_SESSION['id_foyer']) || !empty($_SESSION['id_foyer'])) {
            $keys = [
                'nom_module',
                'type_module',
                'photo_module',
                'position_module',
                'url_open_module',
                'url_var_module',
                'url_close_module',
                'timer_module',
            ];
            // Je verifie que les champs sont remplis
            if (isset($_POST) && !empty($_POST)) {
                if (Validator::validPostSelect($_POST, $keys)) {

                    // Je stocke les données et Je protege mes données et hash le password.

                    $nomModule = $this->protected_values($_POST['nom_module']);
                    $typeModule = $this->protected_values($_POST['type_module']);
                    $positionModule = $this->protected_values($_POST['position_module']);
                    $url_openModule = $this->protected_values($_POST['url_open_module']);
                    $url_varModule = $this->protected_values($_POST['url_var_module']);
                    $url_closeModule = $this->protected_values($_POST['url_close_module']);
                    $timerModule = $this->protected_values($_POST['timer_module']);
                    if (isset($_FILES['photo_module']) && ($_FILES['photo_module']['error'] == 0)) {
                        move_uploaded_file($_FILES['photo_module']['tmp_name'], 'image/' . $_FILES['image']['name']);
                        $photoModule = $this->protected_values('image/' . $_FILES['image']['name']);
                    } else {
                        $photoModule = $this->protected_values($this->protected_values($_POST['photo_module']) ?? 'image/maison.webp');
                    }


                    // Je reprends le modele de ma BDD
                    $moduleData = [
                        'nom_module' => $nomModule,
                        'type_module' => $typeModule,
                        'photo_module' => $photoModule,
                        'position_module' => $positionModule,
                        'url_open_module' => $url_openModule,
                        'url_var_module' => $url_varModule,
                        'url_close_module' => $url_closeModule,
                        'timer_module' => $timerModule,
                        'id_foyer' => $_SESSION['id_foyer']
                    ];


                    // Convertir les données en JSON
                    $jsonData = json_encode($moduleData);

                    // URL de votre API
                    $apiUrl = $this->baseUrlApi . 'module/add';

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

                        header('location:' . $this->baseUrlSite);
                    }
                } else {
                    $messageError =  "<script>
            window.onload = function() {
              alert('Veuillez renseigner tous les champs du formulaire !');
            };
          </script>";
                }
            }
            // Appeler l'API pour récupérer la valeur de la dernière position de module
            $apiUrl = $this->baseUrlApi . 'module/findMaxPosition/' .  $_SESSION['id_foyer'];
            $apiData = file_get_contents($apiUrl);
            $positionData = json_decode($apiData, true);
        } else {
            $messageError = false;
        }

        $this->render('module/ajout', ['messageError' => $messageError, 'positionData' => $positionData]);
    }



    // **************** Tableau de bord

    public function tableauBord()
    {


        if (isset($_SESSION['id_foyer']) && !empty($_SESSION['id_foyer'])) {
            // Appeler l'API pour récupérer les modules du foyer
            $apiUrl = $this->baseUrlApi . 'module/findAllByFoyer/' . $_SESSION['id_foyer'];
            $apiData = file_get_contents($apiUrl);
            $moduleData = json_decode($apiData, true);

            if (empty($moduleData['module'])) {
                $moduleData = 'noModule';
            }
        } else {
            $moduleData = false;
        }



        $this->render('module/tableauBord', ['moduleData' => $moduleData]);
    }

    public function tableauBordDelete($id)
    {


        if (isset($_SESSION['id_foyer']) && !empty($_SESSION['id_foyer'])  && isset($id) &&  !empty($id)) {
            // Appeler l'API pour récupérer les modules du foyer
            $apiUrl = $this->baseUrlApi . 'module/delete/' . $id;

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
        } else {
            echo json_encode(array('reponse'  => false));
        }
    }

    public function edit($id)
    {

        $messageError = 'passe';

        if (isset($_SESSION['id_foyer']) || !empty($_SESSION['id_foyer'])) {
            $keys = [
                'nom_module',
                'type_module',
                'photo_module',
                'position_module',
                'url_open_module',
                'url_var_module',
                'url_close_module',
                'timer_module',
            ];
            // Je verifie que les champs sont remplis
            if (isset($_POST) && !empty($_POST)) {
                if (Validator::validPostSelect($_POST, $keys) && !empty($id)) {

                    // Je stocke les données et Je protege mes données et hash le password.

                    $nomModule = $this->protected_values($_POST['nom_module']);
                    $typeModule = $this->protected_values($_POST['type_module']);
                    $positionModule = $this->protected_values($_POST['position_module']);
                    $url_openModule = $this->protected_values($_POST['url_open_module']);
                    $url_varModule = $this->protected_values($_POST['url_var_module']);
                    $url_closeModule = $this->protected_values($_POST['url_close_module']);
                    $timerModule = $this->protected_values($_POST['timer_module']);
                    if (isset($_FILES['photo_module']) && ($_FILES['photo_module']['error'] == 0)) {
                        move_uploaded_file($_FILES['photo_module']['tmp_name'], 'image/' . $_FILES['image']['name']);
                        $photoModule = $this->protected_values('image/' . $_FILES['image']['name']);
                    } else {
                        $photoModule = $this->protected_values($this->protected_values($_POST['photo_module']) ?? 'image/maison.webp');
                    }


                    // Je reprends le modele de ma BDD
                    $moduleData = [
                        'nom_module' => $nomModule,
                        'type_module' => $typeModule,
                        'photo_module' => $photoModule,
                        'position_module' => $positionModule,
                        'url_open_module' => $url_openModule,
                        'url_var_module' => $url_varModule,
                        'url_close_module' => $url_closeModule,
                        'timer_module' => $timerModule,
                        'id_foyer' => $_SESSION['id_foyer']
                    ];


                    // Convertir les données en JSON
                    $jsonData = json_encode($moduleData);

                    // URL de votre API
                    $apiUrl = $this->baseUrlApi . 'module/update/' . $id;

                    // Configuration de la requête HTTP
                    $options = [
                        'http' => [
                            'header'  => 'Content-Type: application/json',
                            'method'  => 'PUT',
                            'content' => $jsonData
                        ]
                    ];


                    $context  = stream_context_create($options);
                    $result = file_get_contents($apiUrl, false, $context);

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

                        header('location:' . $this->baseUrlSite . 'index.php?controller=Module&action=tableauBord');
                    }
                } else {
                    $messageError =  "<script>
            window.onload = function() {
              alert('Veuillez renseigner tous les champs du formulaire !');
            };
          </script>";
                }
            }
            // Appeler l'API pour récupérer les données du module
            $apiUrl = $this->baseUrlApi . 'module/find/' .  $id;
            $apiData = file_get_contents($apiUrl);
            $moduleData = json_decode($apiData, true);
        } else {
            $messageError = false;
        }

        $this->render('module/edit', ['messageError' => $messageError, 'moduleData' => $moduleData['module']]);
    }
}
