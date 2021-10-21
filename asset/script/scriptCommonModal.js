
// fenetre modale

var btnOpenModales = document.getElementsByClassName("js__btnOpenModale");
var btnModaleOpens = Array.from(btnOpenModales);
var modalWindow = document.getElementById("js__modalWindow");
var mainContent = document.getElementById("js__mainContent");
var btnClose = document.getElementById("js__btnClose");
var recupIdBtn = "";
var focusableElementsArray = [
    'button:not([disabled])',
    'input:not([disabled])',
    '[tabindex]:not([tabindex="-1"])',
];


    // ouverture modale
document.addEventListener("DOMContentLoaded", ()=>{
    
    btnModaleOpens.forEach((btnModaleOpen) => {
        btnModaleOpen.addEventListener("click", (e) => {
            recupIdBtn = btnModaleOpen.id;
            e.preventDefault();
            open(modalWindow);
        })
    });
});

    // fermeture modale
btnClose.addEventListener("click", (e) => {
    e.preventDefault();
    close(modalWindow);
});

window.addEventListener("click", (e) => {
    if (e.target === modalWindow){
        close(modalWindow);
    }
});


window.addEventListener("keydown", function(e) {
    if (e.key === "Escape" || e.key === "Esc") {
        close(modalWindow);
    }
})

function open(modalWindow) {
    let focusableElements = modalWindow.querySelectorAll(focusableElementsArray);
    let firstFocusableElement = focusableElements[0];
    let lastFocusableElement = focusableElements[focusableElements.length - 1];
    let idPage = document.querySelector("body").id;

    modalWindow.setAttribute("aria-hidden", false);
    mainContent.setAttribute("aria-hidden", true);

    if (!firstFocusableElement) {
        return;
    }

    if (idPage === "pageGestionComptes" || idPage === "pageGestionProduits") {
        collectNumId();
    }
    // setTimeout et utilisé pour laisser le temps à l"animation d"ouverture de s"effectuer
    window.setTimeout(() => {
        firstFocusableElement.focus();
        focusableElements.forEach((focusableElement) => {
            focusableElement.addEventListener("keydown", (e) => {

                if (e.key !== "Tab") {
                return;
                }

                if (e.shiftKey) {
                    if (e.target === firstFocusableElement) { 
                        e.preventDefault();

                        lastFocusableElement.focus();
                    }
                } else if (e.target === lastFocusableElement) { 
                    e.preventDefault();

                    firstFocusableElement.focus();
                }
            });
        });
    }, 100);
}

function close(modalWindow) {

    let testModalOverte = modalWindow.getAttribute("aria-hidden");
    
    if (testModalOverte == "true") {
        return; 
    }
    let recupBtnOpen = document.getElementById(recupIdBtn); 
    modalWindow.setAttribute("aria-hidden", true);
    mainContent.setAttribute("aria-hidden", false);
    
    recupBtnOpen.focus();
    recupIdBtn="";
}

