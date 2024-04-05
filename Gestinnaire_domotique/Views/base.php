<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- lien bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- lien feuille de style -->
    <link rel="stylesheet" href="style.css">

    <!--  liens font awesome et google fonts -->
    <script src="https://kit.fontawesome.com/cff33ecd93.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="wrapper">

        <!---------- STRUCTURE HEADER --------------------- -->
        <header>

            <!-- NAVIGATION -->
            <?php
            generateNavigation();
            ?>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="menu-icon">
                <path fill="#313131" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
            </svg>

            <!-- ---------------------------------FIN NAVIGATION--------------------------------------------------------- -->

        </header>
        <!-- ------------FIN HEADER---------------------- -->

        <!-------------- CONTENU DU CORPS --------------->
        <div id="corpsPage">
            <aside id="menuAside" class="offcanvas offcanvas-start show" tabindex="-1" aria-labelledby="menuAsideLabel" aria-modal="true" role="dialog">
                <div id="compteUserBurger" style="display: none;">
                    <a href="http://application/Gestinnaire_domotique/public/" id="boutonUser">
                        <figure id="photoUser"><img src="<?= $_SESSION['photo_utilisateur'] ?>" alt="photo utilisateur"></figure>
                        <p id="textePhotoUser">Mon compte</p>
                    </a>
                    <figure id="boutonDeconnection"><a href="http://application/Gestinnaire_domotique/public/"><i class="fa-solid fa-right-from-bracket"></i></a></figure>
                </div>
                <div class="sectionBurger" id="Affichage">
                    <h4>Affichage</h4>
                    <div id="selectAffichage">
                        <a href="ttp://application/Gestinnaire_domotique/public/" id="listeAffichage"><i class="fa-solid fa-list"></i></a>
                        <a href="ttp://application/Gestinnaire_domotique/public/" id="mosaiqueAffichage"><i class="bi bi-grid-3x3-gap-fill"></i></a>
                    </div>
                </div>
                <div class="sectionBurger">
                    <h4>Gestion domotique</h4>
                    <a href="http://application/Gestinnaire_domotique/public/" class="actionBurger">
                        <i class="fa-solid fa-table-cells-large"></i>
                        <p>Tableau de bord</p>
                    </a>
                    <a href="http://application/Gestinnaire_domotique/public/" class="actionBurger">
                        <i class="fa-solid fa-puzzle-piece"></i>
                        <p>Ajouter un module</p>
                        <div class="compter">
                            <p><?= $nbModule ?></p>
                        </div>
                        <i class="fa-regular fa-circle-plus"></i>
                    </a>
                    <a href="http://application/Gestinnaire_domotique/public/" class="actionBurger">
                        <i class="fa-regular fa-user-group"></i>
                        <p>Utilisateur du foyer</p>
                    </a>
                </div>
                <div class="sectionBurger">
                    <h4>Mon espace</h4>
                    <a href="http://application/Gestinnaire_domotique/public/" class="actionBurger">
                        <i class="fa-solid fa-house"></i>
                        <p>Mes Foyers</p>
                    </a>
                    <a href="http://application/Gestinnaire_domotique/public/" class="actionBurger">
                        <i class="fa-regular fa-paintbrush"></i>
                        <p>Personnaliser le style</p>
                    </a>
                    <a href="http://application/Gestinnaire_domotique/public/" class="actionBurger">
                        <i class="bi bi-house-add-fill"></i>
                        <p>Créer un Foyer</p>
                    </a>
                </div>
                <div class="sectionBurger" style="display: none;"></div>
            </aside>

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

        </footer>


        <!---------- FIN FOOTER --------------------- -->

    </div>
    <!-- ----- FIN DE WRAPPER------------ -->


    <!-- CONNEXION FICHIER SCRIPT.JS DANS DOSSIER JS -->
    <script src="js/scripts.js"></script>

    <!-- CONNEXION js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>