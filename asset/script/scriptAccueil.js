
// Sommaire Script de la page Accueil
// 1.0 css pour les categories

// 1.0 css pour les categories

    //déclaration des variables
var tabCategorie = Array.from(document.getElementsByClassName("container-box-produit"));

    // mise en place des listeners
window.onload = majCSS;
window.onresize = majCSS;
    
    // déclaration des fonctions
    
function majCSS() {
    let largeurEcran = document.body.clientWidth;
    let nbCategotie = tabCategorie.length;
    let marginBox = 64*nbCategotie;
    let resultatLargeur = Math.floor((largeurEcran/nbCategotie) - marginBox);
    if (window.matchMedia("(min-width: 768px)").matches) {
        tabCategorie.forEach((categorie) => {
            let recupNumId = categorie.id.split("categorie-")[1];
            let boxImg = document.getElementById("boxImg-"+recupNumId);
            if (resultatLargeur > 140) {
                boxImg.style.width = resultatLargeur+'px';
            }else{
                boxImg.style.width = '140 px';
            }
            if (nbCategotie <= 5) {
                valueMarginTop = (recupNumId*10)-10;
                categorie.style.marginTop = valueMarginTop+'%';
            }else if(nbCategotie > 5 && nbCategotie <= 10){
                valueMarginTop = ((recupNumId-5)*10)-10;
                categorie.style.marginTop = valueMarginTop+'%';
            }else {
                valueMarginTop = ((recupNumId-10)*10)-10;
                categorie.style.marginTop = valueMarginTop+'%';
            }
        })
    } else {
        tabCategorie.forEach((categorie) => {
            let recupNumId = categorie.id.split("categorie-")[1];
            let boxImg = document.getElementById("boxImg-"+recupNumId);
            categorie.style.marginTop = 0;
            boxImg.style.width = '10em';
        })
    }
}