<?php
// Fonction pour générer la navigation en fonction du rôle de l'utilisateur
function generateNavigation()
{

    if (isset($_SESSION['nom_utilisateur']) && !empty($_SESSION['nom_utilisateur'])) {
?>
        <nav id="navigation">
            <div id="LogoSite">
                <a href="https://www.cefii-developpements.fr/noah1375/Gestionnaire_domotique/public/">
                    <img src="image\Logo_GD_v1.png" alt="Logo">
                </a>
            </div>
            <div id="nomFoyer">
                <a href="https://www.cefii-developpements.fr/noah1375/Gestionnaire_domotique/public/">
                    <h3 id="divFoyerNom"><?php
                                            $nomFoyer = $_SESSION['nom_foyer'] ?? '';
                                            echo $nomFoyer;
                                            ?></h3>
                </a>
            </div>
            <div id="compteUser">
                <a href="index.php?controller=User&action=profil" id="boutonUser">
                    <img id="photoUser" src="<?= $_SESSION['photo_utilisateur'] ?>" alt="photo utilisateur">
                    <p id="textePhotoUser">Mon compte</p>
                </a>
                <a id="boutonDeconnection" href="index.php?controller=User&action=logout"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
            <div id="boutonBurger" class="open" data-bs-toggle="offcanvas" data-bs-target="#menuAside" aria-controls="menuAside">
                <!-- <class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"> -->
                <i class="fa-solid fa-bars" id="IconBurger"></i>
            </div>
        </nav>
<?php
    }
}
