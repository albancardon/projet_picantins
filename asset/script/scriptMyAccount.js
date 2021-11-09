
// Sommaire Script page login
// 1.0 Vérification si le mot de passe contient les caractères demander


// 1.0 Vérification si le mot de passe contient les caractères demander

// déclaration des variables
var passNew = document.getElementById("passNew");
var passNewConfirm = document.getElementById("passNewConfirm");
var btnInscpt = document.getElementById("js__btnInscpt");


    // ajout des listeners et mise en place des fonctions
//Vérification si le mot de passe contient les caractères demander lors de la modification 
//et si le mot de passe est semblable à la ré-écriture de ce dernier
btnInscpt.addEventListener("click", (evt)=>{
    let valuePass = passNew.value;
    let valuePassConfirm = passNewConfirm.value;
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