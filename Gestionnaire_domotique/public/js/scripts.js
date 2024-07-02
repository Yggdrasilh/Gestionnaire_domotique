var urlSite = 'https://www.cefii-developpements.fr/noah1375/Gestionnaire_domotique/public/';
// ***************************** Starter pack ***************************************************

function fondFormExit(id) {
    document.getElementById('exitForm').addEventListener("click", function () {
        document.getElementById(id).remove();
        this.remove();
    });
}

function close(tabl) {
    tabl.forEach(element => {
        document.getElementById(element).remove();
    });
}

/**************** Inscription unique name */
(typeof allNameUser != 'undefined') ? inscUniqueName(allNameUser.user) : null

function inscUniqueName(user) {
    let nom = document.getElementById('nom');
    document.getElementById('envoyer').addEventListener('submit', function (e) {
        e.preventDefault()
        let validity = true;
        user.forEach(elt => {

            if (nom.value == elt.nom_utilisateur) {
                nom.setAttribute('class', 'form-control is-invalid');

                // Ajouter un nouvel élément pour le message d'erreur
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.textContent = 'This username is already use !';
                (document.querySelector('.invalid-feedback') == null) ? nom.parentElement.appendChild(errorDiv) : false;
                validity = false;
            }
        });
        (validity) ? document.getElementById('envoyer').submit() : null;
    });
}




/**************** Responsive */
var screenWidth = window.innerWidth;
var screenHeight = window.innerHeight;
// console.log(screenWidth, screenHeight);

function orientationResponsiveStart(w, h) {
    if (h > w && w <= 900) {
        return true;
    } else {
        return false;
    }
}
window.onresize = function () {
    if (window.innerWidth != screenWidth) {
        location.reload();
        timerResize = setTimeout(
            responsive(),
            pushButton())
    }

}


function responsive() {
    screenWidth = window.innerWidth;
    screenHeight = window.innerHeight;
    let elt = document.getElementById('menuAside');
    let button = document.getElementById('boutonBurger');
    let orientation = orientationResponsiveStart(screenWidth, screenHeight);
    if (orientation) {
        elt.setAttribute('class', 'offcanvas offcanvas-start');
        elt.dataset.bsScroll = false;
        elt.dataset.bsBackdrop = true;

        button.addEventListener('click', function (e) {

            if (this.classList.value == 'close') {
                document.getElementById('IconBurger').setAttribute('class', 'fa-solid fa-bars');
                button.setAttribute('class', 'open');
            } else if (this.classList.value == 'open') {
                document.getElementById('IconBurger').setAttribute('class', 'fa-solid fa-xmark');
                button.setAttribute('class', 'close');
                document.querySelector('.offcanvas-backdrop').addEventListener('click', () => {
                    document.getElementById('IconBurger').setAttribute('class', 'fa-solid fa-bars');
                    button.setAttribute('class', 'open');
                })
            }
        });

    } else {
        elt.setAttribute('class', 'offcanvas offcanvas-start show');
        elt.dataset.bsScroll = true;
        elt.dataset.bsBackdrop = false;
    }
}

(document.getElementById('menuAside') != null) ? responsive() : null;
/*************************** */

// ********************************************************************************

// ************************************************ Foyer ***************************************************

// ***************************** Selection du foyer 
let selectFoyer = document.querySelectorAll(".imgFoyers");
selectFoyer.forEach((element) => {

    element.addEventListener("click", function () {
        let id_foyer = element.parentElement.getAttribute('id');

        fetch(urlSite + "index.php?controller=Foyer&action=selectFoyer&id=" + id_foyer)
            .then(response => response.json())
            .then(data => {

                if (data.reponse) {
                    if ((document.querySelector(".selected") != null)) {
                        document.querySelector(".selected").setAttribute('class', 'card mesFoyers')
                    } else {
                        location.reload();
                    }
                    document.getElementById(id_foyer).setAttribute('class', 'card mesFoyers selected')
                    document.getElementById('divFoyerNom').innerHTML = data.nom;
                } else {
                    alert("Erreur de chargement des données est survenue, veuillez actualiser la page")
                }
            })
    });

});


// ***************************** Suppression et edition du foyer 
let suppFoyer = document.querySelectorAll(".suppFoyer");
suppFoyer.forEach(element => {
    element.addEventListener("click", function () {
        let id_foyer = this.dataset.id;
        if (confirm('Voulez vous vraiment supprimer ce foyer ?')) {
            fetch(urlSite + "index.php?controller=Foyer&action=delete&id=" + id_foyer)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById(id_foyer).remove();
                    } else {
                        alert('Un problème est survenue veillez recommencer !')
                    }
                })
        }
    });

});

// ******************* Formulaire d'update et traitement des données
function traitementEditFoyer(urlRemove, urlsend, bouton, id) {

    document.getElementById(bouton).addEventListener("submit", function (event) {
        event.preventDefault(); // Empêche le comportement par défaut du formulaire
        var form = event.target; // Récupère le formulaire qui a déclenché l'événement

        // Crée un objet FormData pour rassembler les données du formulaire, y compris les fichiers
        var formData = new FormData(form);

        // Envoie les données au serveur en utilisant la méthode fetch()
        fetch(urlsend, {
            method: "POST",
            body: formData,
            // headers: {
            //     'Content-Type': 'application/multipart/form-data'
            // }
        })
            .then(response => response.json())
            .then(data => {
                if (data.reponse == true) {
                    close(urlRemove);//ferme la popup d'update
                    document.querySelector('.img' + id).src = data.image;
                    document.querySelector('.title' + id).innerHTML = data.title;
                    document.querySelector('.ef' + id).dataset.image = data.image;
                    document.querySelector('.ef' + id).dataset.nom = data.title;
                    if (document.getElementById(id).getAttribute('class') == 'card mesFoyers selected') {
                        fetch(urlSite + "index.php?controller=Foyer&action=selectFoyer&id=" + id)
                            .then(response => response.json())
                            .then(data => {
                                if (data.reponse) {
                                    document.getElementById('divFoyerNom').innerHTML = data.nom;
                                }
                            })
                    }

                }
            })
            .catch(error => {
                console.error(error); // Affiche les erreurs dans la console
                alert('Une erreur est survenu veillez recommencer!');
            });
    });

}



let editFoyer = document.querySelectorAll(".editFoyer");
editFoyer.forEach(element => {
    element.addEventListener("click", function () { // apès une première update, les données du formulaire ne se réactualise pas, (reste sur la même image)
        let id_foyer = this.dataset.id;
        let image_foyer = this.dataset.image;
        let nom_foyer = this.dataset.nom;

        document.getElementById('emplacementForm').innerHTML += `<form action="index.php?controller=Foyer&action=update" method="post" id="foyerUpdateForm" enctype='multipart/form-data'>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nom du Foyer</span>
            <input type="text" class="form-control" placeholder="Nom du Foyer" aria-label="Username" aria-describedby="basic-addon1" name='nom_foyer' value="${nom_foyer}">
        </div>
    
        <div class="input-group mb-3">
            <label class="input-group-text" for="imageFoyerUpdate">Image du foyer</label>
            <select class="form-select" id="imageFoyerUpdate" name="photo_foyer">
                <option value="image/maison.webp">Maison</option>
                <option value="image/maison_villa.webp">Villa</option>
                <option value="image/maison_immeuble.webp">Immeuble</option>
                <option value="image/maison_grande.webp">Grande maison</option>
                <option value="image/maison_chateau.webp">Château</option>
                <option value="image/maison_chalet.webp">Chalet</option>
                <option value="image/maison_bourgeoise.webp">Maison bourgeoise</option>
            </select>
        </div>
    
        <div class="input-group mb-3" hidden>
            <input type="number" class="form-control" id="idFoyerUpdate" name="id_foyer" value="${id_foyer}">
        </div>
    
        <input class="btn btn-primary" type="submit" id="submitFoyerUpdate">
    </form> <div id="exitForm"></div>`;

        document.getElementById('imageFoyerUpdate').childNodes.forEach(e => {
            if (e.value == image_foyer) {
                e.selected = true;
            }
        });
        fondFormExit('foyerUpdateForm');
        let close = ['foyerUpdateForm', 'exitForm'];
        let id = id_foyer;
        traitementEditFoyer(close, "index.php?controller=Foyer&action=update", 'foyerUpdateForm', id);
    })
});


// ***************************** Suppression & edition des Utilisateurs du foyer 

// ******************* Formulaire d'update et traitement des données
function traitementEditUserOfFoyer(urlRemove, urlsend, bouton, id) {

    document.getElementById(bouton).addEventListener("submit", function (event) {
        event.preventDefault(); // Empêche le comportement par défaut du formulaire
        var form = event.target; // Récupère le formulaire qui a déclenché l'événement

        // Crée un objet FormData pour rassembler les données du formulaire, y compris les fichiers
        var formData = new FormData(form);

        // Envoie les données au serveur en utilisant la méthode fetch()
        fetch(urlsend, {
            method: "POST",
            body: formData,
            // headers: {
            //     'Content-Type': 'application/multipart/form-data'
            // }
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.reponse == true) {
                    close(urlRemove);//ferme la popup d'update
                    document.querySelector('.role' + id).innerHTML = data.role;
                    document.querySelector('.euof' + id).dataset.role = data.role;
                }
            })
            .catch(error => {
                console.error(error); // Affiche les erreurs dans la console
                alert('Une erreur est survenu veillez recommencer!');
            });
    });

}

let suppUserOfFoyer = document.querySelectorAll(".suppUserOfFoyer");
suppUserOfFoyer.forEach(element => {
    element.addEventListener("click", function () {
        let idUser = this.dataset.iduser;
        let idLink = this.dataset.id;

        if (confirm('Voulez vous vraiment supprimer cette utilisateur ?')) {
            fetch(urlSite + "index.php?controller=Foyer&action=deleteUserOfFoyer&id=" + idUser)
                .then(response => response.json())
                .then(data => {

                    if (data) {
                        document.getElementById(idLink).remove();
                    } else {
                        alert('Un problème est survenue veillez recommencer !')
                    }
                })
        }
    });

});

let editUserOfFoyer = document.querySelectorAll(".editUserOfFoyer");
editUserOfFoyer.forEach(element => {
    element.addEventListener("click", function () {
        let idLink = this.dataset.id;
        let role = this.dataset.role;
        let idUser = this.dataset.iduser;
        let name = this.dataset.name;
        document.getElementById('emplacementForm').innerHTML += `<form action="index.php?controller=Foyer&action=updateUserRole" method="post" id="updateRoleForm" enctype='multipart/form-data'>
    
        <h5>${name}</h5>
        <div class="input-group mb-3">
            <label class="input-group-text" for="roleFoyerUpdate">Rôle de l'utilisateur</label>
            <select class="form-select" id="roleFoyerUpdate" name="role_foyer">
                <option value="user">Utilisateur</option>
                <option value="modo">Modérateur</option>
            </select>
        </div>
    
        <div class="input-group mb-3" hidden>
            <input type="number" class="form-control" id="idFoyerUpdate" name="id_user" value="${idUser}">
        </div>

        <input class="btn btn-primary" type="submit" id="submitRoleUserFoyerUpdate" value="Save">
    </form><div id="exitForm">`;
        document.getElementById('roleFoyerUpdate').childNodes.forEach(e => {

            if (e.value == role) {
                e.selected = true;
            }
        });
        fondFormExit('updateRoleForm');
        let close = ['updateRoleForm', 'exitForm']
        traitementEditUserOfFoyer(close, "index.php?controller=Foyer&action=updateUserRole", 'updateRoleForm', idLink);
    });

});



// ********************************************************************************

// ***************************** Fonctionnement des modules ***************************************************
var proxyUrl = 'https://cors-anywhere.herokuapp.com/';

let toggleModules = document.querySelectorAll(".toggleModule");
toggleModules.forEach(element => {
    element.addEventListener("click", function () {
        if (this.getAttribute('class') == 'card text-bg-dark toggleModule') {
            document.getElementById('link' + this.id).setAttribute('href', this.dataset.urlclose)
            this.setAttribute('class', 'card text-bg-dark toggleModule enable');


        } else if (this.getAttribute('class') == 'card text-bg-dark toggleModule enable') {

            document.getElementById('link' + this.id).setAttribute('href', this.dataset.urlopen)
            this.setAttribute('class', 'card text-bg-dark toggleModule');

        }
    });

});

let timerModule = document.querySelectorAll(".timerModule");
timerModule.forEach(element => {
    let TimerID
    element.addEventListener("click", function () {
        if (this.getAttribute('class') == 'card text-bg-dark timerModule') {

            fetch(proxyUrl + this.dataset.urlopen);
            this.setAttribute('class', 'card text-bg-dark timerModule enable');
            let time = this.dataset.timer * 1000; // Convertion de secondes en millisecond
            console.log(this.dataset.urlopen);

            TimerID = setTimeout(() => {
                fetch(proxyUrl + this.dataset.urlclose);
                this.setAttribute('class', 'card text-bg-dark timerModule');
                console.log(this.dataset.urlclose);
            }, time);

        } else if (this.getAttribute('class') == 'card text-bg-dark timerModule enable') {
            fetch(proxyUrl + this.dataset.urlclose);
            this.setAttribute('class', 'card text-bg-dark timerModule');
            clearTimeout(TimerID);
            console.log(this.dataset.urlclose);
        }
    });

});

function pushButton() {
    let pushModule = document.querySelectorAll(".pushModule");
    let touchTypeOpen;
    let touchTypeClose;
    pushModule.forEach(element => {
        if (orientationResponsiveStart(screenWidth, screenHeight)) {
            touchTypeOpen = "touchstart";
            touchTypeClose = "touchend";
        } else {
            touchTypeOpen = "mousedown";
            touchTypeClose = "mouseup";
        }
        element.addEventListener(touchTypeOpen, function () {
            fetch(proxyUrl + this.dataset.urlopen);
            console.log(this.dataset.urlopen);
        });
        element.addEventListener(touchTypeClose, function () {
            fetch(proxyUrl + this.dataset.urlclose);
            console.log(this.dataset.urlclose);
        });

    });
}

pushButton();

// ***************************** Selection du type de module
function typeModule(type) {
    document.getElementById('typeSelected').value = type;
}

document.querySelectorAll('.nav-link').forEach((e) => {
    e.addEventListener('click', function () {
        let type = this.id;
        switch (type) {
            case 'nav-toggle-tab':
                typeModule('toggle')
                break;
            case 'nav-timer-tab':
                typeModule('timer')
                break;
            case 'nav-push-tab':
                typeModule('push')
                break;
            case 'nav-range-ta':
                typeModule('range')
                break;
            case 'nav-switch-tab':
                typeModule('switch')
                break;
            default:
                typeModule('toggle')
                break;
        }

    })
})


// ***************************** Delete module
document.querySelectorAll('.deleteModule').forEach((elt) => {
    elt.addEventListener('click', function () {
        let idModule = this.dataset.id;

        if (confirm('Voulez vous vraiment supprimer ce module ?')) {
            fetch(urlSite + "index.php?controller=Module&action=tableauBordDelete&id=" + idModule)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById(idModule).remove();
                    } else {
                        alert('Un problème est survenue veillez recommencer !')
                    }
                })
        }
    })
});

// ***************************** Edit module

if (document.getElementById('editSelectPhotoModule') != null) {

    document.getElementById('editSelectPhotoModule').childNodes.forEach(e => {
        let photo = document.getElementById('editSelectPhotoModule').dataset.photo;
        if (e.value == photo) {
            e.selected = true;
        }
    });

    document.getElementById('selectTypeEdit_module').childNodes.forEach(e => {
        let type = document.getElementById('selectTypeEdit_module').dataset.type;
        if (e.value == type) {
            e.selected = true;
            if (type == 'range' || type == 'switch') {
                document.getElementById("varInputeEditModule").removeAttribute('hidden')
            } else {
                document.getElementById("varInputeEditModule").setAttribute('hidden', true)
            }
            if (type == 'timer') {
                document.getElementById("timerInputeEditModule").removeAttribute('hidden')
            } else {
                document.getElementById("timerInputeEditModule").setAttribute('hidden', true)
            }
        }

    });

    document.getElementById('selectTypeEdit_module').addEventListener('change', function () {
        let type = this.value;
        if (type == 'range' || type == 'switch') {
            document.getElementById("varInputeEditModule").removeAttribute('hidden')
            document.getElementById("timerInputeEditModule").setAttribute('hidden', true)
        } else if (type == 'timer') {
            document.getElementById("varInputeEditModule").setAttribute('hidden', true)
            document.getElementById("timerInputeEditModule").removeAttribute('hidden')
        } else {
            document.getElementById("timerInputeEditModule").setAttribute('hidden', true)
            document.getElementById("varInputeEditModule").setAttribute('hidden', true)
        }
    });
}


// ********************************************************************************

