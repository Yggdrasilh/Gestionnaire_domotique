<!DOCTYPE html>

<head>
    <html lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- lien bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- lien feuille de style -->
    <link rel="stylesheet" href="style.css">

    <!--  liens font awesome et google fonts -->
    <script src="https://kit.fontawesome.com/8d728e6f8c.js" crossorigin="anonymous"></script>

</head>

<body>
    <div id="wrapper">

        <!---------- STRUCTURE HEADER --------------------- -->
        <header>

            <!-- NAVIGATION -->
            <?php
            generateNavigation();
            ?>


            <!-- ---------------------------------FIN NAVIGATION--------------------------------------------------------- -->

        </header>
        <!-- ------------FIN HEADER---------------------- -->

        <!-------------- CONTENU DU CORPS --------------->

        <div id="corpsPage">

            <?php


            // Fait apparaitre ou non la sidebar si on est connecter
            $photoUser = $_SESSION['photo_utilisateur']  ?? 'image\photo_icon_user_transparant.png';
            $statusUser = $_SESSION['status_utilisateur'] ?? false;
            if ($statusUser != false) {
                $roleFoyer = $_SESSION["role_foyer"] ?? '';
                // var_dump($roleFoyer);
                // die;
                switch ($roleFoyer) {
                    case 'admin':
                        $urlTb = 'index.php?controller=Module&action=tableauBord';
                        $urlAm = 'index.php?controller=Module&action=add';
                        $urlUf = 'index.php?controller=Foyer&action=userOfFoyer';
                        $disable = "class='actionBurger'";
                        $disable2 = "class='actionBurger'";
                        break;
                    case 'modo':
                        $urlTb = 'index.php?controller=Module&action=tableauBord';
                        $urlAm = 'index.php?controller=Module&action=add';
                        $urlUf = 'index.php?controller=Foyer&action=userOfFoyer';
                        $disable = "class='actionBurger'";
                        $disable2 = "class='actionBurger'";
                        break;
                    case 'user':
                        $urlTb = '#';
                        $urlAm = '#';
                        $urlUf = 'index.php?controller=Foyer&action=userOfFoyer';
                        $disable = "class='actionBurger btn disabled' role='button' aria-disabled='true'";
                        $disable2 = "class='actionBurger'";
                        break;

                    default:
                        $urlTb = '#';
                        $urlAm = '#';
                        $urlUf = '#';
                        $disable = "class='actionBurger btn disabled' role='button' aria-disabled='true'";
                        $disable2 = "class='actionBurger btn disabled' role='button' aria-disabled='true'";
                        break;
                }
            ?>
                <!--  class="offcanvas offcanvas-start" -->
                <aside id="menuAside" class="offcanvas offcanvas-start show" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" aria-labelledby="menuAsideLabel" aria-modal="true" role="dialog">
                    <div class="sectionBurger" id="Affichage">
                        <h5>Affichage</h5>
                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Cette fonctionnalité est en cours de développement et n'est pas disponible pour l'instant !">
                            <div id="selectAffichage">
                                <a href="#" id="listeAffichage"><i class="fa-solid fa-list"></i></a>
                                <a href="#" id="mosaiqueAffichage"><i class="bi bi-grid-3x3-gap-fill"></i></a>
                            </div>
                        </span>
                    </div>
                    <div class="sectionBurger">
                        <h5>Gestion domotique</h5>
                        <a href="<?= $urlTb ?>" <?= $disable ?>>
                            <i class="fa-solid fa-table-cells-large"></i>
                            <p>Tableau de bord</p>
                        </a>
                        <a href="<?= $urlAm ?>" <?= $disable ?>>
                            <i class="fa-solid fa-puzzle-piece"></i>
                            <p>Ajouter un module</p>
                            <i class="bi bi-plus-circle"></i>
                        </a>
                        <a href="<?= $urlUf ?>" <?= $disable2 ?>>
                            <i class="bi bi-people"></i>
                            <p>Utilisateur du foyer</p>
                        </a>
                    </div>
                    <div class="sectionBurger">
                        <h5>Mon espace</h5>
                        <a href="index.php?controller=Foyer&action=index" class="actionBurger">
                            <i class="fa-solid fa-house"></i>
                            <p>Mes Foyers</p>
                        </a>
                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Cette fonctionnalité est en cours de développement et n'est pas disponible pour l'instant !">
                            <a href="#" class='actionBurger btn disabled' role='button' aria-disabled='true'>
                                <i class="bi bi-brush"></i>
                                <p>Personnaliser le style</p>
                            </a>
                        </span>
                        <a href="index.php?controller=Foyer&action=creation" class="actionBurger">
                            <i class="bi bi-house-add-fill"></i>
                            <p>Créer un Foyer</p>
                        </a>
                    </div>
                    <div class="sectionBurger" style="display: none;"></div>
                    <div id="compteUserBurger">
                        <a href="index.php?controller=User&action=profil" id="boutonUser">
                            <figure id="photoUser"><img src="<?= $photoUser ?>" alt="photo utilisateur"></figure>
                            <p id="textePhotoUser">Mon compte</p>
                        </a>
                        <figure id="boutonDeconnection"><a href="index.php?controller=User&action=logout"><i class="fa-solid fa-right-from-bracket"></i></a></figure>
                    </div>
                </aside>


            <?php } ?>

            <main id="contenuPage">
                <?= $content ?>
            </main>
        </div>

        <!-------------- FIN CONTENU DU CORPS --------------->



        <!---------- STRUCTURE FOOTER --------------------- -->
        <footer>
            <div id="footer">
                <p id="copyright">
                    GD Copyright 2024
                </p>
            </div>
        </footer>


        <!---------- FIN FOOTER --------------------- -->

    </div>
    <!-- ----- FIN DE WRAPPER------------ -->


    <!-- CONNEXION FICHIER SCRIPT.JS DANS DOSSIER JS -->
    <script src="js/scripts.js"></script>
    <!-- Js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Popover Bootstrap
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>


</body>

</html>