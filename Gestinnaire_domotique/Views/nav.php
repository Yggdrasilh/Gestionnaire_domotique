<?php
// Fonction pour générer la navigation en fonction du rôle de l'utilisateur
function generateNavigation()
{
    if ($_SESSION['status_utilisateur'] == 'admin') {
    } else {
?>
        <nav id="navigation">
            <div id="LogoSite">
                <a href="http://application/Gestinnaire_domotique/public/">
                    <img src="" alt="Logo">
                </a>
            </div>
            <div id="nomFoyer">
                <h2><?php
                    $nomFoyer = $_SESSION['nom_foyer'] ?? '';
                    echo $nomFoyer;
                    ?></h2>
            </div>
            <div id="compteUser">
                <a href="http://application/Gestinnaire_domotique/public/" id="boutonUser">
                    <figure id="photoUser"><img src="<?= $_SESSION['photo_utilisateur'] ?>" alt="photo utilisateur"></figure>
                    <p id="textePhotoUser">Mon compte</p>
                </a>
                <figure id="boutonDeconnection"><a href="http://application/Gestinnaire_domotique/public/"><i class="fa-solid fa-right-from-bracket"></i></a></figure>
            </div>
            <div id="boutonBurger" data-bs-toggle="offcanvas" data-bs-target="#menuAside" aria-controls="menuAside">
                <!-- <class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"> -->
                <i class="fa-solid fa-bars" style="display: block;" id="barIconBurger"></i>
                <i class="fa-solid fa-xmark" style="display: none;" id="xIconBurger"></i>
            </div>
        </nav>
<?php
    }
}
