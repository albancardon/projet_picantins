
// Sommaire Script commun
// 1.0 mise à jour nombre d'article dans le panier
// 2.0 script boutton haut de page


// 1.0 mise à jour nombre d'article dans le panier

    //déclaration des variables
var nbArticlePanier = Array.from(document.getElementsByClassName("js__nbArticlePanier"));
var classIdClient = document.getElementsByClassName("js__idClient");
if (classIdClient.length > 0){
    var idClient = classIdClient[0].id.split("idClient")[1];
}else{
    var idClient = "";
}
var tabSave = "panierTabSave"+idClient;

// mise en place des listeners
window.onload = majPanier();

// déclaration des fonctions
// fonction pour récupérer le panier en fonction de l'idClient si il existe 
// sinon copie celuie de l'etat non connecter dans le panier lié à l'idClient
function majPanier() {
    nbArticle = JSON.parse(localStorage.getItem(tabSave)).length;
    if (nbArticle!= 0) { 
        nbArticlePanier.forEach((affichagePanier) => {
            affichagePanier.innerHTML = nbArticle;
        })
    }else {
        if (nbArticle== 0 && idClient != ""){
            recupPanier = localStorage.getItem("panierTabSave");
            localStorage.setItem(tabSave,recupPanier);
            majPanier();
        }
        else{
            nbArticlePanier.forEach((affichagePanier) => {
                affichagePanier.innerHTML = 0;
        })
        }
    }
}

// 2.0 script boutton haut de page

    //déclaration des variables
var btnUp=document.querySelectorAll(".bouton-up")[0];
var hauteurScrool=(window.innerHeight/10);
var opacite=0;

    // mise en place des listeners
btnUp.addEventListener("click",moveInteval);
window.addEventListener("scroll",fctOpacityBtnUp);
window.onload = fctStartBtnUp();


    //fonction remonter
function moveInteval(){
    moveWindow= setInterval(
        () =>{
            let positionWindow=window.scrollY;
            if(positionWindow>0) {
                positionWindow-=hauteurScrool;
                window.scrollBy(0,-hauteurScrool);
            }else{
                Stop()
            }
        }, 
        10);
    moveWindow
}
function Stop(){
    clearInterval(moveWindow)
};

    //fonction opaciter bouton haut de page
function fctOpacityBtnUp(){
    let position=window.scrollY;
    if(position>=230){
        opacite+=0.01;
        if((btnUp.style.opacity)<=0.5){
            btnUp.style.opacity=opacite;
        }
        else{
            opacite=0.5;
        }
    }
    else if(position<=50){
        btnUp.style.opacity=0;
    }
    else{
        btnUp.style.opacity-=0.05;
    }
};
function fctStartBtnUp(){
    let position=window.scrollY;
    if(position>=230){
        opacite=0.5;
        btnUp.style.opacity=0.5;
    }
};

