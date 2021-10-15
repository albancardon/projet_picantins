
// recupération des données du produit sélectionner

    //declaration variables

    var numId = "";
    var infoProduitNom = document.getElementById("infoProduit-nom");
    var infoProduitPoids = document.getElementById("infoProduit-poids");
    var infoProduitPrix = document.getElementById("infoProduit-prix");
    var infoProduitDescription = document.getElementById("infoProduit-description");
    var infoProduitTel = document.getElementById("infoProduit-tel");
    
    function collectNumId() {
        numId = recupIdBtn.split("js__btnModif-")[1];
        let recupNom = document.getElementById("js__nomProduit-"+numId).innerHTML.trim();
        let recupPoids = document.getElementById("js__poidsProduit-"+numId).innerHTML.trim().split("g")[0];
        let recupPrix = document.getElementById("js__prixProduit-"+numId).innerHTML.trim().split("€")[0];
        let recupDescription = document.getElementById("js__descriptionProduit-"+numId.split("_")[0]).innerHTML.trim();

        infoProduitNom.value = recupNom;
        infoProduitPoids.value = recupPoids;
        infoProduitPrix.value = recupPrix;
        infoProduitDescription.value = recupDescription;
    }