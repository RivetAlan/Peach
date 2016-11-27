window.addEventListener("load", initialiser);
function initialiser (evt)
{
    var boutonQuestion = document.getElementById("fleche");
    boutonQuestion.addEventListener("click",ouvrirListe);
    
}
function ouvrirListe (evt)
{
    var profil = document.getElementById("autres_questions");
    profil.classList.toggle("ouvrir");
    
   var fleche = document.getElementById("fleche");
    fleche.classList.toggle("tourner"); 
}