var urlSite = 'http://application/Gestionnaire_domotique/public/';
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




// ********************************************************************************

// ************************************************ Foyer ***************************************************

// ***************************** Selection du foyer 
let selectFoyer = document.querySelectorAll(".imgFoyers");
selectFoyer.forEach((element) => {

    element.addEventListener("click", function () {
        let id_foyer = element.parentElement.getAttribute('id');
        console.log(id_foyer);
        fetch(urlSite + "index.php?controller=Foyer&action=selectFoyer&id=" + id_foyer)
            .then(response => response.json())
            .then(data => {
                console.log(data)
                if (data) {
                    window.location.href = urlSite + "index.php?controller=Foyer&action=index";
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

// ******************* Phase de teste *********************************************************************************
function traitementEditFoyer(urlRemove, urlsend, bouton) {

    document.getElementById(bouton).addEventListener("submit", function (event) {
        event.preventDefault(); // Empêche le comportement par défaut du formulaire
        var form = event.target; // Récupère le formulaire qui a déclenché l'événement

        // Crée un objet FormData pour rassembler les données du formulaire, y compris les fichiers
        var formData = new FormData(form);
        for (const [name, value] of formData.entries()) {
            console.log(name + ': ' + value);
        }
        // Envoie les données au serveur en utilisant la méthode fetch()
        fetch(urlsend, {
            method: "POST",
            body: formData,
            headers: {
                'Content-Type': 'application/multipart/form-data'
            }
        })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Affiche la réponse du serveur dans la console
                console.log(urlRemove);
            })
            .catch(error => {
                console.error(error); // Affiche les erreurs dans la console
            });
    });

}


let editFoyer = document.querySelectorAll(".editFoyer");
editFoyer.forEach(element => {
    element.addEventListener("click", function () {
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
    
        <input class="btn btn-primary" type="submit" id="submitFoyerUpdate" value="Update">
    </form> <div id="exitForm"></div>`;

        document.getElementById('imageFoyerUpdate').childNodes.forEach(e => {
            if (e.value == image_foyer) {
                e.selected = true;
            }
        });
        fondFormExit('foyerUpdateForm');
        let close = ['foyerUpdateForm', 'exitForm']
        traitementEditFoyer(close, "index.php?controller=Foyer&action=update", 'submitFoyerUpdate');
    })
});
// ***************************** Suppression & edition des Utilisateurs du foyer 
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
        traitementEditFoyer(close, "index.php?controller=Foyer&action=updateUserRole", 'submitRoleUserFoyerUpdate');
    });

});



// ********************************************************************************

// ***************************** Fonctionnement des modules ***************************************************
let toggleModules = document.querySelectorAll(".toggleModule");
toggleModules.forEach(element => {
    element.addEventListener("click", function () {
        if (this.getAttribute('class') == 'card text-bg-dark toggleModule') {

            fetch(this.dataset.urlopen);
            this.setAttribute('class', 'card text-bg-dark toggleModule enable');
            console.log(this.dataset.urlopen);

        } else if (this.getAttribute('class') == 'card text-bg-dark toggleModule enable') {

            fetch(this.dataset.urlclose);
            this.setAttribute('class', 'card text-bg-dark toggleModule');
            console.log(this.dataset.urlclose);
        }
    });

});

let timerModule = document.querySelectorAll(".timerModule");
toggleModules.forEach(element => {
    element.addEventListener("click", function () {
        console.log('timer');
        if (this.getAttribute('class') == 'card text-bg-dark timerModule') {

            fetch(this.dataset.urlopen);
            this.setAttribute('class', 'card text-bg-dark timerModule enable');
            let time = this.dataset.timer * 1000; // Convertion de secondes en millisecond
            console.log(this.dataset.urlopen);

            setTimeout(() => {
                fetch(this.dataset.urlclose);
                this.setAttribute('class', 'card text-bg-dark timerModule');
                console.log(this.dataset.urlclose);
            }, time);

        } else if (this.getAttribute('class') == 'card text-bg-dark timerModule enable') {

            fetch(this.dataset.urlclose);
            this.setAttribute('class', 'card text-bg-dark timerModule');
            console.log(object);
            clearTimeout();
            console.log(this.dataset.urlclose);
        }
    });

});


// ***************************** Selection du type de module
function typeModule(type) {
    console.log(document.getElementById('typeSelected').value);
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
            document.getElementById("varInputeEditModule").setAttribute('hidden', false)
        } else {
            document.getElementById("varInputeEditModule").setAttribute('hidden', true)
        }
        if (type == 'timer') {
            document.getElementById("timerInputeEditModule").setAttribute('hidden', false)
        } else {
            document.getElementById("timerInputeEditModule").setAttribute('hidden', true)
        }
    }

});

document.getElementById('selectTypeEdit_module').addEventListener('change', function () {
    let type = this.value;
    if (type == 'range' || type == 'switch') {
        document.getElementById("varInputeEditModule").setAttribute('hidden', false)
        document.getElementById("timerInputeEditModule").setAttribute('hidden', true)
    } else if (type == 'timer') {
        document.getElementById("varInputeEditModule").setAttribute('hidden', true)
        document.getElementById("timerInputeEditModule").setAttribute('hidden', false)
    } else {
        document.getElementById("timerInputeEditModule").setAttribute('hidden', true)
        document.getElementById("varInputeEditModule").setAttribute('hidden', true)
    }
});



// ********************************************************************************


// document.getElementById("my-form").addEventListener("submit", function (event) {
//     event.preventDefault(); // Empêche le comportement par défaut du formulaire
//     var form = event.target; // Récupère le formulaire qui a déclenché l'événement

//     // Crée un objet FormData pour rassembler les données du formulaire, y compris les fichiers
//     var formData = new FormData(form);
//     for (const [name, value] of formData.entries()) {
//         console.log(name + ': ' + value);
//     }
//     // Envoie les données au serveur en utilisant la méthode fetch()
//     fetch("index.php?controller=creation&action=add", {
//         method: "POST",
//         body: formData,
//         headers: {
//             'Content-Type': 'application/multipart/form-data'
//         }
//     })
//         .then(response => response.text())
//         .then(data => {
//             console.log(data); // Affiche la réponse du serveur dans la console
//             // Vous pouvez mettre à jour la vue en fonction de la réponse du serveur
//             // Par exemple, si vous avez une div avec l'id "response" dans votre HTML :
//             document.getElementById("response").innerHTML = "l'ajout a été effectué";
//         })
//         .catch(error => {
//             console.error(error); // Affiche les erreurs dans la console
//             // Vous pouvez afficher un message d'erreur à l'utilisateur
//             // Par exemple, si vous avez une div avec l'id "error" dans votre HTML :
//             document.getElementById("error").innerHTML = "Une erreur s'est produite : " + error.message;
//         });
// });
