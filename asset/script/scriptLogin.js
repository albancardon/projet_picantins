
// Sommaire Script page login
// 1.0 vérification ddes donnée entrée dans les formulaires


// 1.0 vérification des données entrées dans les formulaires

    //declaration variables
var btnLogin = document.getElementById("js__btnLogin");
var passInscrpt = document.getElementById("passInscrpt");
var passInscrptConfirm = document.getElementById("passInscrptConfirm");
var btnInscpt = document.getElementById("js__btnInscpt");

    // ajout des listeners et mise en place des fonctions
// Vérification si le mot de passe contient les caractères demander
btnLogin.addEventListener("click", (evt)=>{
    let valuePass = passLogin.value;
    let chaineMaj = /[A-Z]/g;
    let chaineMin = /[a-z]/g;
    let chaineChiffre = /[0-9]/g;
    let resultSearch = valuePass.search(chaineMaj,chaineMin,chaineChiffre); 
    if(resultSearch !== -1){
    } else{
        alert("votre mot de passe ne contient pas les caractères demandé.");
        evt.preventDefault();
    }
});

//Vérification si le mot de passe contient les caractères demander lors de l'inscription 
//et si le mot de passe est semblable à la ré-écriture de ce dernier
btnInscpt.addEventListener("click", (evt)=>{
    let valuePass = passInscrpt.value;
    let valuePassConfirm = passInscrptConfirm.value;
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
            alert("votre mot de passe ne contient pas les caractères demandé.");
            evt.preventDefault();
        }
    }
});

