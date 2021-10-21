
// 1.0 recuprération des données du local storage

    //1.1 déclaration des variables et applicatrion des listener
var panierTab = [];
var panierListeArticle = document.getElementById("js__panierListeArticle");
var panierVide = document.getElementById("js__panierVide");
var tabPrixArticle = [];
var prixPanier = 0;
var prixPanierAfficher = Array.from(document.getElementsByClassName("js__prixPanier"));
var tabQuantite = document.getElementsByClassName("js__quantite");
var btnSupprTab = document.getElementsByClassName("produit-suppr");
var asidePanier = document.getElementById("js_asidePanier");

window.onload = createStorage();
window.onload = recupProduitStorage();

    // 1.2 décalaration fonction de création du stockage local storage
function createStorage(){
    if ( typeof localStorage != "undefined" && JSON){
        if (localStorage.getItem("panierTabSave")==null){
            localStorage.setItem("panierTabSave",JSON.stringify(panierTab));
        }else{
            panierTab = JSON.parse(localStorage.getItem("panierTabSave"));
            if (panierTab.length > 0) {
                panierVide.className = "invisible";
                asidePanier.className = "aside-panier";
            }
        }
    }else {
        alert("Le stockage sur votre PC n'a pu etre effectuer.")
    }
}

    // 1.3 décalaration fonction de récupération des données du local storage
function recupProduitStorage() {
    panierTab.forEach((produit) => {
        let idProduitPanier = produit[0];
        let nomProduitPanier = produit[1];
        let poidsProduit = produit[2];
        let prixUnitaireProduit = produit[3];
        let quantiteProduitPanier = produit[4];
        let descriptionPanier = produit[5];
        let imagePanier = produit[6];
        let produitTab = [idProduitPanier, nomProduitPanier, poidsProduit, prixUnitaireProduit, quantiteProduitPanier, descriptionPanier, imagePanier];
        insert(produitTab);
        calculPrixArticle(prixUnitaireProduit,quantiteProduitPanier);
    });
    calculPrixPanier(tabPrixArticle);
    prixPanierAfficher.forEach((affichage) => {
        affichage.innerHTML = prixPanier+"€";
    });
    modifQuantite();
}

// 2.0 décalaration fonction d'insertion des articles du panier
function insert(produitTab) {
    let recupId = produitTab[0].split(/(\d)/);
    let recupNom = produitTab[1];
    let recupPoids = produitTab[2];
    if (recupPoids === null) {
        recupPoids = "Vendu à l'unité";
    }else{
        recupPoids = "Ballotin de "+recupPoids+"g";
    }
    let recupPrixUnitaire = produitTab[3];
    let recupQuantite = produitTab[4];
    let recupDescription = produitTab[5];
    let recupImage = produitTab[6];

    panierListeArticle.insertAdjacentHTML("beforeend",
    `
        <article id="js__produit-`+recupId[1]+`-poids-`+recupId[3]+`" class="produit-panier ombre">
            <img class="img-produit ombre" src="`+recupImage+`" alt="image produit">
            <section class="legende-produit">
                <h3 class="gras majDbutMot">`+recupNom+`</h3>
                <p>
                    `+recupDescription+`
                </p>
                <p>
                    `+recupPoids+`
                </p>
                <div class="quantite-produit-box">
                    <div class="quantite-produit ombre">
                        <label for="panier-quantite1">Qté:</label>
                        <input id="js_produit-`+recupId[1]+`-quantite-`+recupId[3]+`"
                        class="quantite-value js__quantite" type="number" min="0" max="99"
                        name="panier-quantite1" id="panier-quantite1" value="`+recupQuantite+`" 
                        pattern="[0-9]{1,2}">
                    </div>
                    <p id="js__produit-`+recupId[1]+`-suppr-`+recupId[3]+`" class="produit-suppr">Supprimer</p>
                </div>
            </section>
            <section class="prix-article-panier">
                <p>Prix Unitaire </p>
                <p id="js__produit-`+recupId[1]+`-prix-`+recupId[3]+`" class="gras">`+recupPrixUnitaire+`€</p>
            </section>
        </article>
    `);
}

// 3.0 fonction calcul du prix de l'article
function calculPrixArticle(prixUnitaire,quantiteProduit) {
    let prixProduit = prixUnitaire * quantiteProduit;
    tabPrixArticle.push(prixProduit);
}

//4.0 fonction calcul prix du panier
function calculPrixPanier(tabPrixArticle){
    prixPanier = 0;
    for (let i = 0; i < tabPrixArticle.length; i++) {
        prixPanier = prixPanier + tabPrixArticle[i];
    }
    return prixPanier;
}

// 5.0 fonction modification quantité / suppression

function modifQuantite() {
    for (i = 0; i < tabQuantite.length; i++) {
        tabQuantite[i].addEventListener("change", (e)=>{
            e.preventDefault();
            let event = e.target;
            let recupId = e.target.id;
            let recupNumProduit = recupId.split(/(\d)/);
            let prixUnitaireProduit = Number (document.getElementById("js__produit-"+recupNumProduit[1]+"-prix-"+recupNumProduit[3]).innerHTML.split("€")[0]);
            let quantiteProduit = Number (event.value);
            let index = 0;
            for (j = 0; j < tabQuantite.length; j++) {
                if (tabQuantite[j].id === recupId) {
                    index = j;
                }
            }
            tabPrixArticle[index] = prixUnitaireProduit * quantiteProduit;
            if (quantiteProduit === 0) {
                let elementId = document.getElementById("js__produit-"+recupNumProduit[1]+"-poids-"+recupNumProduit[3]);
                tabPrixArticle.splice(index,1);
                panierTab.splice(index,1);
                elementId.remove();
                localStorage.setItem("panierTabSave",JSON.stringify(panierTab));
                if (panierTab.length == 0) {
                    panierVide.className = "produit-panier ombre";
                    asidePanier.className = "invisible";
                    prixPanierAfficher.forEach((affichage) => {
                        affichage.innerHTML = "0€";
                    });
                }
                return
            }
            prixPanier = calculPrixPanier(tabPrixArticle);
            prixPanierAfficher.forEach((affichage) => {
                affichage.innerHTML = prixPanier+"€";
            });
            panierTab[index][4] = quantiteProduit;
            localStorage.setItem("panierTabSave",JSON.stringify(panierTab));
        });

        btnSupprTab[i].addEventListener("click",(e) => {
            let recupIdSuppr = e.target.id;
            let recupNumSuppr = recupIdSuppr.split(/(\d)/);
            let elementId = document.getElementById("js__produit-"+recupNumSuppr[1]+"-poids-"+recupNumSuppr[3])
            let index = 0;
            let recupIdProduit = "p"+recupNumSuppr[1]+"q"+recupNumSuppr[3];
            for (k = 0; k < btnSupprTab.length; k++) {
                if (btnSupprTab[k].id === recupIdSuppr) {
                    index = k;
                }
                if (panierTab[k] != undefined ) {
                    if (panierTab[k][0] == recupIdProduit) {
                        panierTab.splice(k,1);
                    }
                }
            }
            let recupPrixUnitaire = Number (document.getElementById("js__produit-"+recupNumSuppr[1]+"-prix-"+recupNumSuppr[3]).innerHTML.split("€")[0]);
            let recupQuantiteProduit = Number (document.getElementById("js_produit-"+recupNumSuppr[1]+"-quantite-"+recupNumSuppr[3]).value);
            let recupPrixArticle = recupPrixUnitaire * recupQuantiteProduit;
            prixPanier = prixPanier - recupPrixArticle;
            prixPanierAfficher.forEach((affichage) => {
                affichage.innerHTML = prixPanier+"€";
            });
            tabPrixArticle.splice(index,1);
            elementId.remove();
            localStorage.setItem("panierTabSave",JSON.stringify(panierTab));
            if (panierTab.length == 0) {
                panierVide.className = "produit-panier ombre";
                asidePanier.className = "invisible";
                prixPanierAfficher.forEach((affichage) => {
                    affichage.innerHTML = "0€";
                });
            }
        })
    }
}