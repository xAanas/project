function aimerscript(demandeid, siaimer, pasaimer) {
    $.ajax({
        type: 'post',
        url: 'http://localhost/project/web/app_dev.php/accueil/aimer/' + demandeid,
        beforeSend: function () {
            document.getElementById("loader" + demandeid).style.display = "inline";
            console.log('ça chargee aimer');
        },
        success: function (data) {
            siaimer.innerHTML = data.demandeJaime;
            pasaimer.innerHTML = data.demandeJaimepas;
            document.getElementById("loader" + demandeid).style.display = "none";
            console.log("okkk ne pas aimer : " + data.demandeJaimepas + " et aimer : " + data.demandeJaime);
        }
    });
}


function neaimerscript(demandeid, pasaimer, siaimer) {
    $.ajax({
        type: 'post',
        url: 'http://localhost/project/web/app_dev.php/accueil/nepasaimer/' + demandeid,
        beforeSend: function () {
            document.getElementById("loader" + demandeid).style.display = "inline";
            console.log('ça chargee ne pas aimer');
        },
        success: function (data) {
            pasaimer.innerHTML = data.demandeJaimepas;
            siaimer.innerHTML = data.demandeJaime;
            document.getElementById("loader" + demandeid).style.display = "none";
            console.log("okkk ne pas aimer : " + data.demandeJaimepas + " et aimer : " + data.demandeJaime);
        }
    });
}

function modifetat(demandeid, etat, champ) {
    $.ajax({
        type: 'post',
        url: 'http://localhost/project/web/app_dev.php/accueil/modifetat/' + demandeid + '/' + etat,
        beforeSend: function () {
            document.getElementById("loaderetat" + demandeid).style.display = "inline";
            console.log('ça chargee changement de etat');
        },
        success: function (data) {

            champ.innerHTML = data.etat;
            if (data.etat === 'Emise') {
                $('#progresscouleur' + demandeid).attr("class", "progress-bar progress-bar-warning");
                $('#progresscouleur' + demandeid).attr("style", "width: 100%");
                $('#progressmot' + demandeid).remove();
                $('#progresscouleur' + demandeid).append('<span class="sr-only-focusable" id="progressmot' + demandeid + '">Emise</span>');
            } else if (data.etat === 'En cour') {
                $('#progresscouleur' + demandeid).attr("class", "progress-bar progress-bar-success");
                $('#progresscouleur' + demandeid).attr("style", "width: 60%");
                $('#progressmot' + demandeid).remove();
                $('#progresscouleur' + demandeid).append('<span class="sr-only-focusable" id="progressmot' + demandeid + '">En cour</span>');
            } else if (data.etat === 'Annulée') {
                $('#progresscouleur' + demandeid).attr("class", "progress-bar progress-bar-danger");
                $('#progresscouleur' + demandeid).attr("style", "width: 100%");
                $('#progressmot' + demandeid).remove();
                $('#progresscouleur' + demandeid).append('<span class="sr-only-focusable" id="progressmot' + demandeid + '">Annulée</span>');
            } else {
                $('#progresscouleur' + demandeid).attr("class", "progress-bar progress-bar-info");
                $('#progresscouleur' + demandeid).attr("style", "width: 100%");
                $('#progressmot' + demandeid).remove();
                $('#progresscouleur' + demandeid).append('<span class="sr-only-focusable" id="progressmot' + demandeid + '">Livée</span>');
            }
            document.getElementById("loaderetat" + demandeid).style.display = "none";
            console.log('etat changé');
        }
    });
}


function commenterscript(id, contenu) {
        var lecommentaire = contenu.value;
        
    while (lecommentaire.indexOf('\\') !== -1) {
          lecommentaire = lecommentaire.replace('\\', 'antislach');
    }
    while (lecommentaire.indexOf('/') !== -1) {
        lecommentaire = lecommentaire.replace('/', 'slach');
    }
    while (lecommentaire.indexOf('?') !== -1) {
        lecommentaire = lecommentaire.replace('?', 'istefhem');
    }
        
    $.ajax({
        type: 'post',
        url: 'http://localhost/project/web/app_dev.php/accueil/commenter/' + id + '/' + lecommentaire,
        beforeSend: function () {
            document.getElementById("loaderCom" + id).style.display = "inline";
            console.log('ça chargee encore commentaire ' + id + '/' + contenu.value); 
            console.log('ça chargee commentaire ' + id + '/' + lecommentaire );


        },
        success: function () {
            document.getElementById("loaderCom" + id).style.display = "none";
            $('#ajoutcomm' + id).append('<li class="list-group-item"> Anas : ' + contenu.value + '<br/> <div align="right"> ' + Date() + ' </div> </li>');
            //$('#ajoutcomm'+id).removeAttr("style").append('Anas : '+ contenu.value +'<br/><div align="right"> '+ Date() +'</div>');
            contenu.value = ' ';
            console.log("okkk commentaire");
        }
    });
}

function effacerDemande(id) {
    $.ajax({
        type: 'post',
        url: 'http://localhost/project/web/app_dev.php/accueil/effacerdemande/' + id,
        beforeSend: function () {
            document.getElementById("loadereffacdem" + id).style.display = "inline";
            console.log('ça chargee effacement demande ' + id);
        },
        success: function (data) {
            document.getElementById("loadereffacdem" + id).style.display = "none";
            console.log("demande " + data.etat);
        }
    });
}

function afficherCommentaires(lescommentaires){
    lescommentaires.style.display = "block";
}