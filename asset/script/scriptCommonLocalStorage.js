
// Sommaire Script local storage panier
// 1.0 locale storage

// 1.0 locale storage

    // déclaration des variables storage panier 
var btnAjoutPanier = document.getElementsByClassName("js__btnAjoutPanier");
var btnAjoutPanierTab = Array.from(btnAjoutPanier);
var classIdClient = document.getElementsByClassName("js__idClient");
if (classIdClient.length > 0){
    var idClient = classIdClient[0].id.split("idClient")[1];
}else{
    var idClient = "";
}
var tabSave = "panierTabSave"+idClient;
var panierTab = [];
    // ajout des listeners

    // modification panier
    document.addEventListener('DOMContentLoaded', ()=>{
        createStorage();

        btnAjoutPanierTab.forEach((btnAjout) => {
            btnAjout.addEventListener('click', (e) => {
                e.preventDefault();
                // fonction insertion nouveau produit dans storage
                let numProduit = btnAjout.id.split("-")[1];
                let numQuantite = btnAjout.id.split("js__btnAjoutProduit-"+numProduit+"-quantite-")[1];
                let quantiteProduitPanier = Number (document.getElementById("js__choixPoids-"+numProduit+"-quantite-"+numQuantite).value);
                let idProduitPanier = "p-"+numProduit+"-q-"+numQuantite; // exemple p3q2 = produit n°3 quantité n°2

                if (quantiteProduitPanier > 0) {
                    for (i = 0; i < panierTab.length; i++) {
                        let produit = panierTab[i];
                        if (produit[0] === idProduitPanier) {
                            quantiteProduitPanier = Number (produit[4]) + quantiteProduitPanier;
                            produit[4] = quantiteProduitPanier;
                            panierTab[i] = produit;
                            panierTab.sort();
                            localStorage.setItem(tabSave,JSON.stringify(panierTab));
                            resetProduit (idProduitPanier);
                            return;
                        }
                    }
                    let nomProduitPanier = document.getElementById("js__produit-"+numProduit).innerHTML;
                    let poidsProduit = Number (document.getElementById("js__produit-"+numProduit+"-poids-"+numQuantite).innerHTML.trim().split("g")[0]);
                    let prixUnitaireProduit = Number (document.getElementById("js__produit-"+numProduit+"-prix-"+numQuantite).innerHTML.trim().split("€")[0]);
                    let descriptionPanier = document.getElementById("js__descriptionProduit-"+numProduit).innerHTML.trim();
                    let imagePanier = "asset"+document.getElementById("js__imageProduit-"+numProduit).src.split("asset")[1];
                    let produitTab = [idProduitPanier, nomProduitPanier, poidsProduit, prixUnitaireProduit, quantiteProduitPanier, descriptionPanier, imagePanier];
                    panierTab.push(produitTab);
                    panierTab.sort();
                    localStorage.setItem(tabSave,JSON.stringify(panierTab));
                    resetProduit (idProduitPanier);
                }else {
                    return;
                }
                majPanier();
            })
        });
    });

    // fonction de création du stockage local storage ou du chargement des anciens produits
function createStorage(){
    if ( typeof localStorage != "undefined" && JSON){
        if (localStorage.getItem(tabSave)==null){
            localStorage.setItem(tabSave,JSON.stringify(panierTab));
        }else{
            panierTab = JSON.parse(localStorage.getItem(tabSave));
        }
    }else {
        alert("Le stockage sur votre PC n'a pu etre effectuer.")
    }
}

    // fonction reset valeur quantité recupProduitStorage

function resetProduit (idProduitPanier){
        tabNumProduitQuantite = idProduitPanier.split("-");
        champNbArticle = document.getElementById("js__choixPoids-"+tabNumProduitQuantite[1]+"-quantite-"+tabNumProduitQuantite[3]);
        champNbArticle.value = 0;
}