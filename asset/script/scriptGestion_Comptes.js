
// Sommaire Script page Gestion Comptes
// 1.0 carroussel
    // 1.1 création navigation caroussel 
    // 1.2 caroussel changement de page compte client
        // 1.2.1 changement avec les fleches
        // 1.2.2 changement avec les chiffres
// 2.0 recupération des données du client sélectionner

// 1.0 carroussel

    //declaration des variables
var tableClient = document.getElementsByClassName("js__tableClient_page");
var nbTableClient = tableClient .length;
let countTableClient = 0;
var navCarouselClient = document.getElementById("js__navCarouselClient");
var pageCarousel = document.getElementsByClassName("page-carousel");
var numPage= document.getElementsByClassName("js__numPage");

    // 1.1 création navigation caroussel
        // ajout des listeners
window.onload = ajoutListeNavigation();

        //déclaration des fonctions
function ajoutListeNavigation(){
    let li = document.createElement("li");
    li.setAttribute( "id" , "js__btnPrecedentClient");
    li.classList.add("page-carousel");

    let img = document.createElement("img");
    img.classList.add("icon-carousel");
    img.setAttribute( "src" , "asset/icon/fleche-gauche.png");
    img.setAttribute( "alt" , "fléche vers la gauche");

    li.appendChild(img);
    navCarouselClient.appendChild(li);

    for (let i = 0; i < nbTableClient; i++) {
        let li = document.createElement("li");
        li.setAttribute( "id" , "carousselClientPage"+i);
        li.classList.add("page-carousel");
        li.classList.add("js__numPage");
        li.innerHTML = i+1;
        li.addEventListener("click",()=> changementPage(i));
        navCarouselClient.appendChild(li);
    }
    document.getElementsByClassName("js__numPage")[0].classList.add("select");

    let li1 = document.createElement("li");
    li1.setAttribute( "id" , "js__btnSuivantClient");
    li1.classList.add("page-carousel");

    let img1 = document.createElement("img");
    img1.classList.add("icon-carousel");
    img1.setAttribute( "src" , "asset/icon/fleche-droite.png");
    img1.setAttribute( "alt" , "fléche vers la droite");

    li1.appendChild(img1);
    navCarouselClient.appendChild(li1);

    const btnPrecedentClient = document.getElementById("js__btnPrecedentClient");
    const btnSuivantClient = document.getElementById("js__btnSuivantClient");
    
    btnSuivantClient.addEventListener("click",slideSuivanteClient);
    btnPrecedentClient.addEventListener("click",slidePrecedentClient);
}

    // 1.2 caroussel changement de page compte client

        //déclaration des fonctions
        // 1.2.1 changement avec les fleches
    function slideSuivanteClient(){
        tableClient[countTableClient].classList.remove('active');
        tableClient[countTableClient].classList.add('inactive');
        if (countTableClient < nbTableClient-1) {
            countTableClient++;
        }else{
            countTableClient = 0;
        }
        tableClient[countTableClient].classList.remove('inactive');
        tableClient[countTableClient].classList.add('active');
        for (let i = 0; i < tableClient.length; i++) {
            numPage[i].classList.remove('select');
        }
        numPage[countTableClient].classList.add('select');
    }

    function slidePrecedentClient(){
        tableClient[countTableClient].classList.remove('active');
        tableClient[countTableClient].classList.add('inactive');
        if (countTableClient > 0) {
            countTableClient--;
        }else{
            countTableClient = nbTableClient-1;
        }
        tableClient[countTableClient].classList.remove('inactive');
        tableClient[countTableClient].classList.add('active');
        for (let i = 0; i < tableClient.length; i++) {
            numPage[i].classList.remove('select');
        }
        numPage[countTableClient].classList.add('select');
    }

        // 1.2.2 changement avec les chiffres

    function changementPage(id) {
        for (let i = 0; i < tableClient.length; i++) {
            tableClient[i].classList.remove('active');
            tableClient[i].classList.add('inactive');
            numPage[i].classList.remove('select');
        }
        tableClient[id].classList.remove('inactive');
        tableClient[id].classList.add('active');
        numPage[id].classList.add('select');
    }

// 2.0 recupération des données du client sélectionner

    //declaration variables

var numId = "";
var infoCompteNom = document.getElementById("infoCompte-nom");
var infoComptePrenom = document.getElementById("infoCompte-prenom");
var infoCompteMail = document.getElementById("infoCompte-mail");
var infoCompteAdresse = document.getElementById("infoCompte-adresse");
var infoCompteTel = document.getElementById("infoCompte-tel");

    // déclaration de la fonction
    //fonction appeler sur le script de la modale lors de l'overture de la fenetre modale
function collectNumId() {
    numId = recupIdBtn.split("js__btnModif-")[1];
    let recupNom = document.getElementById("js__nomCompte-"+numId).innerHTML.trim();
    let recupPrenom = document.getElementById("js__prénomCompte-"+numId).innerHTML.trim();
    let recupMail = document.getElementById("js__mailCompte-"+numId).innerHTML.trim();
    let recupAdresse = document.getElementById("js__adresseCompte-"+numId).innerHTML.trim();
    let recupTel = document.getElementById("js__telcompte-"+numId).innerHTML.trim();

    infoCompteNom.value = recupNom;
    infoComptePrenom.value = recupPrenom;
    infoCompteMail.value = recupMail;
    infoCompteAdresse.value = recupAdresse;
    infoCompteTel.value = recupTel;
}