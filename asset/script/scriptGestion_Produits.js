
// Sommaire Script page Gestion produit
// 1.0 recupération info Produit
// 2.0 modale categorie

// 1.0 recupération info Produit

    //declaration variables
var numId = "";
var infoProduitNom = document.getElementById("infoProduit-nom");
var infoProduitPoids = document.getElementById("infoProduit-poids");
var infoProduitPrix = document.getElementById("infoProduit-prix");
var infoProduitDescription = document.getElementById("infoProduit-description");
var infoProduitTel = document.getElementById("infoProduit-tel");
var referenceProduit = document.getElementById("referenceProduit");

    // déclaration de la fonction
    //fonction appeler sur le script de la modale lors de l'overture de la fenetre modale
function collectNumId() {
    numId = recupIdBtn.split("js__btnModif-cat-")[1];
    let recupNom = document.getElementById("js__nomProduit-cat-"+numId).innerHTML.trim();
    let recupPoids = document.getElementById("js__poidsProduit-cat-"+numId).innerHTML.trim().split("g")[0];
    let recupPrix = document.getElementById("js__prixProduit-cat-"+numId).innerHTML.trim().split("€")[0];

    referenceProduit.value = recupIdBtn;
    infoProduitNom.value = recupNom;
    infoProduitPoids.value = recupPoids;
    infoProduitPrix.value = recupPrix;
    referenceProduit.value = recupIdBtn.split("js__btnModif-")[1];
}


// 2.0 changement choix  produit pour ajout nouveau

    // déclaration des variables
var ouvertureModif = document.getElementById("category-product");
var chooseProduct = document.getElementById("choose-product");
var nameProduct = document.getElementById("name-product");
var classNameMask = "hidden";
var classNameVisible = "form-champ";

    // ajout des listeners modif type champ
    chooseProduct.addEventListener("change",(e)=>{e.preventDefault;changeChamp()} );

    //déclaration des fonctions

function changeChamp(){
    if (chooseProduct.value === "modif"){
        chooseProduct.className = classNameMask;
        chooseProduct.removeAttribute("name");
        chooseProduct.removeAttribute("required");
        nameProduct.className = classNameVisible;
        nameProduct.setAttribute("name","name-product");
        nameProduct.setAttribute("required","");
    }else{
        let recupCat = chooseProduct.value.split("-")[1];
        ouvertureModif.options[recupCat].setAttribute("selected", "");
    }
}


// 3.0 modale categorie

    // déclaration des variables
var boxModifCategorie = document.getElementById("js__boxModifCategorie");
var btnCloseBoxModif = document.getElementById("js__btnCloseBoxModif");
var classBoxModifNameOpen = "aside-modification visible";
var classBoxModifNameTransitionOpen = "aside-modification transitionOpen";
var classBoxModifNameMask = "aside-modification mask";
var classBoxModifNameTransitionClose = "aside-modification transitionClose";
var clickHorsBox = true;

    // ajout des listener ouverture/fermeture box 
ouvertureModif.addEventListener("change",(e)=>{e.preventDefault;openModifCateg()} );
btnCloseBoxModif.addEventListener("click",()=>{ closeBoxModif(boxModifCategorie)});
window.addEventListener("keydown", function(e) {
    if (e.key === "Escape" || e.key === "Esc") {
        closeBoxModif(boxModifCategorie);
    }
})

    //déclaration des fonctions

function openModifCateg(){
    if (ouvertureModif.value === "modif"){
        if (boxModifCategorie.className === classBoxModifNameMask) {
            openBoxModif(boxModifCategorie);
        }else if (boxModifCategorie.className === classBoxModifNameOpen){
            closeBoxModif(boxModifCategorie);
        }
    }
}

function openBoxModif(boxModifABouger) {
    boxModifABouger.className = classBoxModifNameTransitionOpen;
    setTimeout(()=>{boxModifABouger.className = classBoxModifNameOpen}, 800);
}

function closeBoxModif(boxModifABouger) {
    boxModifABouger.className = classBoxModifNameTransitionClose;
    setTimeout(()=>{boxModifABouger.className = classBoxModifNameMask}, 800);
}


// 4.0 demande suppression du format

    // déclaration des variables
var btnSuppTab = Array.from(document.getElementsByClassName("js__btn-supp-format"));
var btnRefusSupp = document.getElementById("js__btnRefusSupp");
var boxValidation = document.getElementById("js__box-validation");
var classVisible = "js__box-validation ombre visible";
var classHidden = "hidden";
var recupIdBtnSupp = "";

    // ajout des listeners 
document.addEventListener("DOMContentLoaded", ()=>{
    
    btnSuppTab.forEach((btnSupp) => {
        btnSupp.addEventListener("click", (e) => {
            recupIdBtnSupp = btnSupp.id;
            collectInfoSupp()
            e.preventDefault();
            boxValidation.className = classVisible;
        })
    });
});
btnRefusSupp.addEventListener("click",(e)=>{
    e.preventDefault();
    closeBoxValdation();
})

    // declaration des fonction
function closeBoxValdation(){
    boxValidation.className = classHidden;
    recupIdBtnSupp = "";
}


//5.0 recupération des données format produit à supprimer

    //declaration variables
var numIdSupp = "";
var infoSuppId = document.getElementById("infoSupp-id");

    // déclaration de la fonction
function collectInfoSupp() {
    infoSuppId.value = recupIdBtnSupp;
}

// 6.0 demande suppression du produit

    // déclaration des variables
var btnSuppProdTab = Array.from(document.getElementsByClassName("js__btn-supp-produit"));
var btnRefusSuppProd = document.getElementById("js__btnRefusSuppProd");
var boxValidationProd = document.getElementById("js__box-validation-suppProduit");
var recupIdBtnSuppProd = "";
    
        // ajout des listeners 
document.addEventListener("DOMContentLoaded", ()=>{
    btnSuppProdTab.forEach((btnSuppProd) => {
        btnSuppProd.addEventListener("click", (e) => {
            recupIdBtnSuppProd = btnSuppProd.id;
            collectInfoSuppProd()
            e.preventDefault();
            boxValidationProd.className = classVisible;
        })
    });
});
btnRefusSuppProd.addEventListener("click",(e)=>{
    e.preventDefault();
    closeBoxValdationProd();
})

    // declaration des fonction

function closeBoxValdationProd(){
    boxValidationProd.className = classHidden;
    recupIdBtnSuppProd = "";
}

//7.0 recupération des données du produit à supprimer

    //declaration variables
var numIdSuppProd = "";
var infoSuppIdProd = document.getElementById("infoSuppProd-id");

    // déclaration de la fonction
function collectInfoSuppProd() {
    infoSuppIdProd.value = recupIdBtnSuppProd;
}