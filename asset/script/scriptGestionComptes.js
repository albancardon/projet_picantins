
//declaration des variables

var pageClient = document.getElementsByClassName("js__tableClient_page");
var nbPageClient = pageClient .length;
let countPageClient = 0;
var navCarouselClient = document.getElementById("js__navCarouselClient");
var pageCarousel = document.getElementsByClassName("page-carousel");
var numPage= document.getElementsByClassName("js__numPage");

//navigation caroussel pageClient

window.onload = ajoutListeNavigation();

function ajoutListeNavigation(){
    let li = document.createElement("li");
    li.setAttribute( "id" , "js__btnPrecedentClient");
    li.classList.add("page-carousel");

    let img = document.createElement("img");
    img.classList.add("icon-carousel");
    img.setAttribute( "src" , "../asset/icon/fleche-gauche.png");
    img.setAttribute( "alt" , "fléche vers la gauche");

    li.appendChild(img);
    navCarouselClient.appendChild(li);

    for (let i = 0; i < nbPageClient; i++) {
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
    img1.setAttribute( "src" , "../asset/icon/fleche-droite.png");
    img1.setAttribute( "alt" , "fléche vers la droite");

    li1.appendChild(img1);
    navCarouselClient.appendChild(li1);

    const btnPrecedentClient = document.getElementById("js__btnPrecedentClient");
    const btnSuivantClient = document.getElementById("js__btnSuivantClient");
    
    btnSuivantClient.addEventListener("click",slideSuivanteClient);
    btnPrecedentClient.addEventListener("click",slidePrecedentClient);

}


// caroussel changement de page compte client

    // changement avec les fleches
    function slideSuivanteClient(){
        pageClient[countPageClient].classList.remove('active');
        pageClient[countPageClient].classList.add('inactive');
        if (countPageClient < nbPageClient-1) {
            countPageClient++;
        }else{
            countPageClient = 0;
        }
        pageClient[countPageClient].classList.remove('inactive');
        pageClient[countPageClient].classList.add('active');
        for (let i = 0; i < pageClient.length; i++) {
            numPage[i].classList.remove('select');
        }
        numPage[countPageClient].classList.add('select');
    }

    function slidePrecedentClient(){
        pageClient[countPageClient].classList.remove('active');
        pageClient[countPageClient].classList.add('inactive');
        if (countPageClient > 0) {
            countPageClient--;
        }else{
            countPageClient = nbPageClient-1;
        }
        pageClient[countPageClient].classList.remove('inactive');
        pageClient[countPageClient].classList.add('active');
        for (let i = 0; i < pageClient.length; i++) {
            numPage[i].classList.remove('select');
        }
        numPage[countPageClient].classList.add('select');
    }

    // changement avec les chiffres

    function changementPage(id) {
        for (let i = 0; i < pageClient.length; i++) {
            pageClient[i].classList.remove('active');
            pageClient[i].classList.add('inactive');
            numPage[i].classList.remove('select');
        }
        pageClient[id].classList.remove('inactive');
        pageClient[id].classList.add('active');
        numPage[id].classList.add('select');
    }

// modale information client 

var btnOpenModales = document.getElementsByClassName("js__btnOpenModale");
var btnModaleOpens = Array.from(btnOpenModales);
var modalWindow = document.getElementById("js__modalWindow");
var mainContent = document.getElementById("js__mainContent");
var btnClose = document.getElementById("js__btnClose");
var recupIdBtn = "";
var focusableElementsArray = [
    'button:not([disabled])',
    'input:not([disabled])',
    '[tabindex]:not([tabindex="-1"])',
];


    // ouverture modale
document.addEventListener('DOMContentLoaded', ()=>{
    
    btnModaleOpens.forEach((btnModaleOpen) => {
        btnModaleOpen.addEventListener('click', (e) => {
            recupIdBtn = btnModaleOpen.id;
            e.preventDefault();
            open(modalWindow);
        })
    });
});

    // fermeture modale
btnClose.addEventListener("click", (e) => {
    e.preventDefault();
    close(modalWindow);
});

window.addEventListener('click', (e) => {
    if (e.target === modalWindow){
        close(modalWindow);
    }
});


window.addEventListener('keydown', function(e) {
    console.log(e.key);
    if (e.key === "Escape" || e.key === "Esc") {
        close(modalWindow);
    }
})

function open(modalWindow) {
    let focusableElements = modalWindow.querySelectorAll(focusableElementsArray);
    let firstFocusableElement = focusableElements[0];
    let lastFocusableElement = focusableElements[focusableElements.length - 1];

    modalWindow.setAttribute('aria-hidden', false);
    mainContent.setAttribute('aria-hidden', true);

    if (!firstFocusableElement) {
        return;
    }
    collectNumId()
    // setTimeout et utilisé pour laisser le temps à l'animation d'ouverture de s'effectuer
    window.setTimeout(() => {
        firstFocusableElement.focus();
        focusableElements.forEach((focusableElement) => {
            focusableElement.addEventListener('keydown', (e) => {

                if (e.key !== "Tab") {
                return;
                }

                if (e.shiftKey) {
                    if (e.target === firstFocusableElement) { 
                        e.preventDefault();

                        lastFocusableElement.focus();
                    }
                } else if (e.target === lastFocusableElement) { 
                    e.preventDefault();

                    firstFocusableElement.focus();
                }
            });
        });
    }, 100);
}

function close(modalWindow) {

    let testModalOverte = modalWindow.getAttribute('aria-hidden');
    
    if (testModalOverte == "true") {
        return; 
    }
    let recupBtnOpen = document.getElementById(recupIdBtn); 
    modalWindow.setAttribute('aria-hidden', true);
    mainContent.setAttribute('aria-hidden', false);
    
    recupBtnOpen.focus();
    recupIdBtn="";
}

// recupération des données du client sélectionner

    //declaration variables

var numId = "";
var infoCompteNom = document.getElementById("infoCompte-nom");
var infoComptePrenom = document.getElementById("infoCompte-prenom");
var infoCompteMail = document.getElementById("infoCompte-mail");
var infoCompteAdresse = document.getElementById("infoCompte-adresse");
var infoCompteTel = document.getElementById("infoCompte-tel");

function collectNumId() {
    numId = recupIdBtn.split("js__btnModif-")[1];
    let recupNom = document.getElementById("js__nomCompte-"+numId).innerHTML.trim();
    let recupPrenom = document.getElementById("js__prénomCompte-"+numId).innerHTML.trim();
    let recupMail = document.getElementById("js__mailCompte-"+numId).innerHTML.trim();
    let recupAdresse = document.getElementById("js__adressecompte-"+numId).innerHTML.trim();
    let recupTel = document.getElementById("js__telcompte-"+numId).innerHTML.trim();

    infoCompteNom.value = recupNom;
    infoComptePrenom.value = recupPrenom;
    infoCompteMail.value = recupMail;
    infoCompteAdresse.value = recupAdresse;
    infoCompteTel.value = recupTel;
}