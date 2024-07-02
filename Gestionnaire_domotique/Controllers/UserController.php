<?php

namespace App\Controllers;

use App\Core\Validator;
use App\Controllers\Controller;

class UserController extends Controller
{


    public function login()
    {
        //Préparer le message d'erreur
        $messageError = '';

        // Récupérer les données de mes champs de formulaire

        $userNom = $_POST['nom_user'] ?? '';
        $userPassword = $_POST['password_user'] ?? '';


        if ($userNom != '' && $userPassword != '') {

            // Appeler l'API pour récupérer les informations utilisateur
            $apiUrl = $this->baseUrlApi . '/utilisateur/auth/' . $userNom;
            $apiData = file_get_contents($apiUrl);
            $userData = json_decode($apiData, true);

            // Vérifier le mdp et stocker en session les info utile.    
            foreach ($userData as $user) {
                if (password_verify($userPassword, $user['mdp_utilisateur'])) {
                    // die;
                    // Stocker les informations dans $_SESSION
                    $_SESSION['id_utilisateur'] = $user['id'];
                    $_SESSION['nom_utilisateur'] = $user['nom_utilisateur'];
                    $_SESSION['email_utilisateur'] = $user['email_utilisateur'];
                    $_SESSION['photo_utilisateur'] = $user['photo_utilisateur'];
                    $_SESSION['status_utilisateur'] = $user['status_utilisateur'];
                    // var_dump($_SESSION);
                    //    Envoyer l'utilisateur connecté vers la page d'accueil.
                    header('location:' . $this->baseUrlSite);
                } else {
                    // Si pas ok, message d'erreur.
                    $messageError =  "<script>
                window.onload = function() {
                  alert('Mauvais couple identifiant et mots de passe !');
                };
              </script>";
                }
            }
        } elseif ($userNom != '' || $userPassword != '') {
            // Si pas ok, message d'erreur.
            $messageError =  "<script>
            window.onload = function() {
              alert('Veuillez renseigner tous les champs du formulaire !');
            };
          </script>";
            // Si pas bon : Afficher le formulaire de connexion
        }

        $this->render('user/formConnexion', ['messageError' => $messageError]);
    }

    //     ************************************************************************************************************

    public function logout()
    {
        // detruire la session en cliquant sur le lien 
        session_destroy();

        // var_dump($_SESSION);
        // die;

        header('location:' . $this->baseUrlSite . 'index.php?controller=User&action=login');
    }
    //     ************************************************************************************************************


    public function inscription()
    {
        $messageError = '';
        // Je récupère tout les noms qui existe déjà pour les transferer plus tard à la vue
        $apiUrl = $this->baseUrlApi . 'utilisateur/getAll';
        $apiReturn = file_get_contents($apiUrl);
        $userAllData = json_decode($apiReturn, true);


        $keys = [
            'nom_user',
            'email_user',
            'password_user'
        ];
        // Je verifie que les champs sont remplis
        if (isset($_POST) && !empty($_POST)) {
            if (Validator::validPostSelect($_POST, $keys)) {

                // Je stocke les données et Je protege mes données et hash le password.

                $userNom = $this->protected_values($_POST['nom_user']);
                $userEmail = $this->protected_values($_POST['email_user']);
                $hashedPassword = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
                if (isset($_FILES['photo_user']) && ($_FILES['photo_user']['error'] == 0)) {
                    move_uploaded_file($_FILES['photo_user']['tmp_name'], 'image/' . $_FILES['image']['name']);
                    $userPhoto = $this->protected_values('image/' . $_FILES['image']['name']);
                } else {
                    $userPhoto = $this->protected_values('image/photo_icon_user_transparant.png');
                }


                // Je reprends le modele de ma BDD
                $userData = [
                    'nom_utilisateur' => $userNom,
                    'email_utilisateur' => $userEmail,
                    'mdp_utilisateur' => $hashedPassword,
                    'photo_utilisateur' => $userPhoto
                ];


                // Convertir les données en JSON
                $jsonData = json_encode($userData);

                // URL de votre API
                $apiUrl = $this->baseUrlApi . 'utilisateur/inscription';

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
                      alert('Une erreur s'est produite lors de l'envoie des données (cela peut arriver si le nom utilisateur que vous souhaitez utiliser existe déjà !). 
                      Veuillez recommencer !');
                    };
                  </script>";
                } else {

                    $messageError =  "<div class='alert alert-success' role='alert'>
                    Votre compte a bien été créé - Connectez vous !
                  </div>";

                    header('location:' . $this->baseUrlSite . 'index.php?controller=User&action=login');
                }
            } else {
                $messageError =  "<script>
            window.onload = function() {
              alert('Veuillez renseigner tous les champs du formulaire !');
            };
          </script>";
            }
        }
        $this->render('user/formInscription', ['userAllData' => $userAllData, 'messageError' => $messageError]);
    }

    //     ************************************************************************************************************
    public function profil()
    {

        $this->render('user/profil');
    }


    //     ************************************************************************************************************

    public function updateMdpProfil()
    {
        $messageError = '';

        if (Validator::validPostGlobal()) {
            // if (!empty($newPassword) && !empty($confirmNewPassword) && !empty($oldPassword)) {
            // Récupérer les données du formulaire
            $newPassword = $_POST['new_password_user'] ?? '';
            $confirmNewPassword = $_POST['confim_new_password_user'] ?? '';
            $oldPassword = $_POST['password_user'] ?? '';

            if ($newPassword === $confirmNewPassword) {

                // Appeler l'API pour récupérer les informations utilisateur notament le mdp
                $apiUrl = $this->baseUrlApi . '/utilisateur/auth/' . $_SESSION['nom_utilisateur'];
                $apiData = file_get_contents($apiUrl);
                $userData = json_decode($apiData, true);

                $hashedPassword = $userData['user']['mdp_utilisateur'] ?? '';



                if (password_verify($oldPassword, $hashedPassword)) {

                    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    $apiUrl = $this->baseUrlApi . 'utilisateur/updateMdp/' . $_SESSION['id_utilisateur'];

                    // Envoyer les données à l'API pour mettre à jour le mot de passe
                    $postData = array(
                        'mdp_utilisateur' => $newHashedPassword
                    );

                    $options = array(
                        'http' => array(
                            'method' => 'PATCH',
                            'header' => ['Content-type: application/json'],
                            'content' => json_encode($postData)
                        )
                    );

                    $context = stream_context_create($options);
                    $result = file_get_contents($apiUrl, true, $context);
                    $convert = json_decode($result, true);

                    // Vérifier si la mise à jour a réussi
                    if ($convert['status']) {
                        // Afficher un message de succès à l'utilisateur
                        $messageError =  "<div class='alert alert-warning' role='alert'>
                        Mot de passe mis à jour avec succès !
                    </div>";
                        header('location:' . $this->baseUrlSite . 'index.php?controller=user&action=profil');
                    } else {
                        // Afficher un message d'erreur
                        $messageError =  "<div class='alert alert-warning' role='alert'>
                                Une erreur s'est produite lors de la mise à jour du mot de passe !
                            </div>";
                    }
                } else {
                    // Afficher un message d'erreur si les mots de passe ne correspondent pas
                    $messageError =  " <div class='alert alert-warning' role='alert'>
                                 L'ancien mot de passe est incorrect. Veuillez recommencer !
                            </div>";
                }
            } else {
                // Afficher un message d'erreur si les nouveaux mots de passe ne correspondent pas
                $messageError =  " <div class='alert alert-warning' role='alert'>
                Les deux mots de passe ne correspondent pas... Veuillez recommencer !
            </div>";
            }
        }

        // Rendre la vue du formulaire en passant les données
        $this->render('user/formMdp', ['messageError' => $messageError]);
    }

    public function updateProfil()
    {
        $messageError = '';

        if (Validator::validPostGlobal()) {
            $newNomUser = $_POST['nom_user'] ?? '';
            $newEmailUser = $_POST['email_user'] ?? '';



            $apiUrl = $this->baseUrlApi . 'utilisateur/update/' . $_SESSION['id_utilisateur'];

            $postData = array(
                'nom_utilisateur' => $newNomUser,
                'email_utilisateur' => $newEmailUser,
                'photo_utilisateur' => $_SESSION['photo_utilisateur'],
            );

            $options = array(
                'http' => array(
                    'method' => 'PUT',
                    'header' => 'Content-type: application/json',
                    'content' => json_encode($postData)
                )
            );

            $context = stream_context_create($options);
            $result = file_get_contents($apiUrl, false, $context);
            $result = json_decode($result, true);

            if ($result['status'] === true) {

                // Mettre à jour les données dans $_SESSION
                $_SESSION['nom_utilisateur'] = $newNomUser;
                $_SESSION['email_utilisateur'] = $newEmailUser;
                $_SESSION['photo_utilisateur'] = $_SESSION['photo_utilisateur'];
                header('location:' . $this->baseUrlSite . 'index.php?controller=user&action=profil');
            } else {
                $messageError = "
                    <div class='alert alert-warning' role='alert'>
                        Une erreur s'est produite lors de la mise à jour du profil. Veuillez recommencer !
                    </div>";
            }
        }

        $this->render('user/formProfil', ['messageError' => $messageError]);
    }
}
