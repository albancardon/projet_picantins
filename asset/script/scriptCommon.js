
// 1.0 mise à jour nombre d'article dans le panier

    //déclaration des variables
var nbArticlePanier = Array.from(document.getElementsByClassName("js__nbArticlePanier"));

// mise en place des listeners
window.onload = majPanier();

// déclaration des fonctions

function majPanier() {
    nbArticle = JSON.parse(localStorage.getItem("panierTabSave"));
    console.log(nbArticle);
    if (nbArticle!= null) { 
        nbArticle = JSON.parse(localStorage.getItem("panierTabSave"));
        nbArticlePanier.forEach((affichagePanier) => {
        affichagePanier.innerHTML = nbArticle.length;
        })
    }else {
        nbArticlePanier.forEach((affichagePanier) => {
        affichagePanier.innerHTML = 0;
        })
    }
}