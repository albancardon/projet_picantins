
// ouverture/fermeture fenetre produit box choix poids

    //déclaration variables

var boxDescriptifProduit = document.getElementsByClassName("js__boxDescriptifProduit");
var boxDescriptifProduitTab = Array.from(boxDescriptifProduit);
var produitChoix = document.getElementsByClassName("js__produitChoix");
var produitChoixTab = Array.from(produitChoix);
var mainContent = document.getElementById("js__mainContent");
var valueClassNameOpen = "produit-box-choix ombre visible";
var valueClassNameTransitionOpen = "produit-box-choix ombre transitionOpen";
var valueClassNameMask = "produit-box-choix ombre js__produitChoix mask";
var valueClassNameTransitionClose = "produit-box-choix ombre transitionClose";
var recupNumBox = "";
var boxABouger;
var clickHorsBox = true;


document.addEventListener('DOMContentLoaded', ()=>{

    boxDescriptifProduitTab.forEach((boxDescriptif) => {
        boxDescriptif.addEventListener('click', (e) => {
            e.preventDefault();
            recupNumBox = boxDescriptif.id.split("js__boxProduit-")[1];
            boxABouger = document.getElementById("js__choixPoids-"+recupNumBox);
            moveBox(boxABouger);
        })
    });
});

    // fonction ouverture/fermeture box choix poids

function moveBox(boxABouger) {
    if (boxABouger.className === valueClassNameMask) {
        openBox(boxABouger);
    }else if (boxABouger.className === valueClassNameOpen){
        closeBox(boxABouger);
    }
}

function openBox(boxABouger) {
    boxABouger.className = valueClassNameTransitionOpen;
    setTimeout(()=>{boxABouger.className = valueClassNameOpen}, 800);
}

function closeBox(boxABouger) {
    boxABouger.className = valueClassNameTransitionClose;
    setTimeout(()=>{boxABouger.className = valueClassNameMask}, 800);
}

window.addEventListener('click', () => {
    produitChoixTab.forEach((boxChoix) => {
        boxChoix.addEventListener('click', (e) => {
            e.preventDefault();
            clickHorsBox = null;
            return clickHorsBox;
        })
    });
    if (boxABouger != undefined) {
        if (clickHorsBox && boxABouger.className === valueClassNameOpen) {
            closeBox(boxABouger);
            return;
        }
    }
    
    clickHorsBox = true;
});

    // navigation au clavier ouverture/fermeture box choix poids

window.addEventListener("keydown", function(e) {
    boxDescriptifProduitTab.forEach((boxDescriptif) => {
        if (e.key === "Enter" && boxDescriptif.id === document.activeElement.id ) {
            recupNumBox = boxDescriptif.id.split("js__boxProduit-")[1];
            boxABouger = document.getElementById("js__choixPoids-"+recupNumBox);
            openBox(boxABouger);
        }
    })
    if (e.key === "Escape" || e.key === "Esc") {
        produitChoixTab.forEach((boxChoix)=>{
            if (boxChoix.className === valueClassNameOpen){
                closeBox(boxChoix);
            }
        })
    }
})

// changement valeur de la quantité de produit

    //déclaration des variables

var btnMoinsList = document.getElementsByClassName("js__btnMoins");
var btnMoinsListTab = Array.from(btnMoinsList);
var btnPlusList = document.getElementsByClassName("js__btnPlus");
var btnPlusListTab = Array.from(btnPlusList);
var recupIdProduit = "";
var recupNumQuantite = "";


window.addEventListener("DOMContentLoaded", function(e) {
    btnMoinsListTab.forEach((btnMoins) => {
        let x = 0;
        btnMoins.addEventListener('click', (e) => {
            e.preventDefault();
            recupIdProduit = btnMoins.id.split("-")[1];
            recupNumQuantite = btnMoins.id.split("js__choixPoids-"+recupIdProduit+"-btnMoinsChoix-")[1];
            let quantiteModifer = document.getElementById("js__choixPoids-"+recupIdProduit+"-quantite-"+recupNumQuantite);
            if (quantiteModifer.value > 0) {
                quantiteModifer.value--;
            }
        })
    });
    btnPlusListTab.forEach((btnPlus) => {
        btnPlus.addEventListener('click', (e) => {
            e.preventDefault();
            recupIdProduit = btnPlus.id.split("-")[1];
            recupNumQuantite = btnPlus.id.split("js__choixPoids-"+recupIdProduit+"-btnPlusChoix-")[1];
            let quantiteModifer = document.getElementById("js__choixPoids-"+recupIdProduit+"-quantite-"+recupNumQuantite);
            quantiteModifer.value++;
        })
    });
});