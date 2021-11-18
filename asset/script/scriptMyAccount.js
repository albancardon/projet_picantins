
// Sommaire Script page login
// 1.0 recupération des données client
// 2.0 vérification mot de passe


// 1.0 recupération des données client

    //declaration variables
var btnLienEdit = document.getElementsByClassName("lien-edit")[0];
var nom = document.getElementById("js__nom");
var prenom = document.getElementById("js__prenom");
var mail = document.getElementById("js__mail");
var adresse = document.getElementById("js__adresse");
var tel = document.getElementById("js__tel");
var recup_nom = document.getElementById("compte-nom");
var recup_prenom = document.getElementById("compte-prenom");
var recup_mail = document.getElementById("mailLogin");
var recup_adresse = document.getElementById("compte-adresse");
var recup_tel = document.getElementById("compte-tel");

    // mise en place des listeners
btnLienEdit.addEventListener("click", collectInfoCompte());

    // déclaration de la fonction
function collectInfoCompte() {
    recup_nom.value = nom.innerHTML;
    recup_prenom.value = prenom.innerHTML;
    recup_mail.value = mail.innerHTML;
    recup_adresse.value = adresse.innerHTML;
    recup_tel.value = tel.innerHTML;
}

// 2.0 vérification mot de passe

    //declaration variables
var btnModifCompte = document.getElementById("js__btnModifCompte");
var passNew = document.getElementById("passLogin");
var passNewConfirm = document.getElementById("passLoginConfirm");


//Vérification si le mot de passe contient les caractères demander lors de la modification
//et si le mot de passe est semblable à la ré-écriture de ce dernier
btnModifCompte.addEventListener("click", (evt)=>{
    let valuePass = passNew.value;
    let valuePassConfirm = passNewConfirm.value;
    console.log("passNew "+passNew.value);
    if (valuePass != ""){
        if (valuePass != valuePassConfirm) {
            alert("Mot de passe et confirmation de mort passe non identique!");
            evt.preventDefault();
        }else{
            let chaineMaj = /[A-Z]/g;
            let chaineMin = /[a-z]/g;
            let chaineChiffre = /[0-9]/g;
            let resultSearch = valuePass.search(chaineMaj,chaineMin,chaineChiffre); 
            if(resultSearch !== -1){
            } else{
                alert("votre mot de passe ne contient pas les caractères demandé. \n(minimum 8 caractéres contenant une majuscule, une minuscule et un nombre");
                evt.preventDefault();
            }
        }
    } 
});