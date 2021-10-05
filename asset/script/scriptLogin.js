var passLogin = document.getElementById("passLogin");
var btnLogin = document.getElementById("btnLogin");
var passInscrpt = document.getElementById("passInscrpt");
var passInscrptConfirm = document.getElementById("passInscrptConfirm");
var btnInscpt = document.getElementById("btnInscpt");

// Vérification si le mot de passe contient les caractères demander
btnLogin.addEventListener("click", (evt)=>{
    let valuePass = passLogin.value;
    let chaineMaj = /[A-Z]/g;
    let chaineMin = /[a-z]/g;
    let chaineChiffre = /[0-9]/g;
    let resultSearch = valuePass.search(chaineMaj,chaineMin,chaineChiffre); 
    if(resultSearch !== -1){
        console.log("test ok");
    } else{
        alert("votre mot de passe ne contient pas les caractères demandé.");
        evt.preventDefault();
    }
});

//Vérification si le mot de passe contient les caractères demander lors de l'inscription 
//et si le mot de pass est semble a la ré-écriture de ce dernier
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
            console.log("test ok");
        } else{
            alert("votre mot de passe ne contient pas les caractères demandé.");
            evt.preventDefault();
        }
    }
});

