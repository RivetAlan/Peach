window.addEventListener("load", initialiser);
function initialiser (evt)
{
    var boutonQuestion = document.getElementById("fleche");
    boutonQuestion.addEventListener("click",ouvrirListe);
    var boutonProfil = document.getElementById("boutonProfil");
    boutonProfil.addEventListener("click",ouvrirMenu);
    var fermerMenu = document.getElementById("filtreNoir");
    fermerMenu.addEventListener("click",fermerLeMenu);
    
    var boutonInfo = document.querySelector("#icones>img");
    boutonInfo.addEventListener("mouseover", infoHover);
    boutonInfo.addEventListener("mouseout", infoOut);
    
    var favoris = document.querySelector("#videoclique>div:nth-child(2)>div:nth-child(2)>i");
    favoris.addEventListener("mouseover",favoriserHover);
    favoris.addEventListener("mouseout",defavoriserHover);
    favoris.addEventListener("click",favoriserClick);
    
    rendreVidCliquable();
    
    var fermerVideo = document.getElementById("fermerVideo");
    fermerVideo.addEventListener("click",fermerLaVideo);
    
    var autresQuestions = document.querySelectorAll("#autres_questions h2");
    for (var z=0 ; z<autresQuestions.length ; z++)
    {
        autresQuestions[z].addEventListener("click",changementQuestion);
    }
    
}

function rendreVidCliquable(evt){
        var lesImgs = document.getElementsByClassName("videoimg");
    for(var i = 0 ; i < lesImgs.length ; i++){
        lesImgs[i].addEventListener("click", apparaitreVideo);
    }
}


function ouvrirListe (evt)
{
    var profil = document.getElementById("autres_questions");
    profil.classList.toggle("ouvrir");
    
   var fleche = document.getElementById("fleche");
    fleche.classList.toggle("tourner"); 
}
function ouvrirMenu (evt)
{
    var profil = document.getElementById("profil");
    profil.classList.toggle("ouvrirMenu");
    var filtreNoir= document.getElementById("filtreNoir");
    filtreNoir.classList.toggle("filtreNoir");
}
function fermerLeMenu (evt)
{
    profil.classList.toggle("ouvrirMenu");
    filtreNoir.classList.toggle("filtreNoir");
}
function infoHover (evt)
{
    this.src="medias/img/infoPlein.png";
}
function infoOut (evt)
{
    this.src="medias/img/infoVide.png";
}

function favoriserHover (evt)
{
    this.classList.remove("fa-star-o");
    this.classList.add("fa-star");
}
function defavoriserHover (evt)
{
    this.classList.add("fa-star-o");
    this.classList.remove("fa-star");
}
function favoriserClick (evt)
{
    this.removeEventListener("mouseout",defavoriserHover);
    this.classList.remove("fa-star-o");
    this.classList.add("fa-star");
    this.addEventListener("click",defavoriserClick);
	var xhr = new XMLHttpRequest();
	laVideo = document.querySelector("video");
	var idVideo = laVideo.id;
	var video = document.getElementById("#videojouee");
	xhr.open("get","php/ajouterFavoris.php?idVideo=" + idVideo , true);
	xhr.onreadystatechange = traiterReponse;
	xhr.send(null);
}

function defavoriserClick (evt)
{
    this.classList.add("fa-star-o");
    this.classList.remove("fa-star");
    this.addEventListener("mouseout",defavoriserHover);
    this.removeEventListener("click",defavoriserClick);
}

function apparaitreVideo(evt)
{

    var videoPleinEcran = document.getElementById("videoclique");
    videoPleinEcran.classList.toggle("apparaitre");
    var filtreNoir2= document.getElementById("filtreNoir2");
    filtreNoir2.classList.toggle("filtreNoir2");
	var idImage = this.id;
	var xhr2 = new XMLHttpRequest();
        
    xhr2.open("get","php/recupererVideo.php?idVideo=" + idImage
,true);
    xhr2.onreadystatechange = traiterReponseVideo;
    xhr2.send(null);
}

function changementQuestion(evt)
{

	var idQuestion = this.id;
	var xhr2 = new XMLHttpRequest();
        
    xhr2.open("get","php/changementVideos.php?idQuestion=" + idQuestion
,true);
    xhr2.onreadystatechange = traiterChangementQuestion;
    xhr2.send(null);
}

function fermerLaVideo (evt)
{
    var videoPleinEcran = document.getElementById("videoclique");
    videoPleinEcran.classList.toggle("apparaitre");
    document.querySelector("video").pause();
    var filtreNoir2= document.getElementById("filtreNoir2");
    filtreNoir2.classList.toggle("filtreNoir2");
}
function traiterReponse (e) 
{
        var video = document.getElementById("#videojouee");
        if (this.readyState==4 ) {
            if (this.status==200) {
                var contenuHTML= this.responseText;
               var element = document.getElementById("conteneur");
                /*if (video == null)
                    video = document.getElementById("#conteneur").style.display="none";
                    */
                element.insertAdjacentHTML("afterBegin", contenuHTML);
                
        }else {
            alert(this.statusText);
            
        }
        }
}
function traiterReponseVideo (e) 
{
        var video = document.getElementById("#");
        if (this.readyState==4 ) {
            if (this.status==200) {
                var contenuHTML= this.responseText;
               var element = document.getElementById("videocliquee");
                
               element.innerHTML = contenuHTML;
              /* element.insertAdjacentHTML("afterBegin", contenuHTML);*/
                
        }else {
            alert(this.statusText);
            
        }
        }
}

function traiterChangementQuestion (e) 
{
        
        if (this.readyState==4 ) {
            if (this.status==200) {
                var video25 = document.getElementById("video");
                while (video25.firstChild) {
                    video25.removeChild(video25.firstChild);
                }
                ouvrirListe();
                var contenuHTML= this.responseText;
                video.insertAdjacentHTML("afterBegin", contenuHTML);
                rendreVidCliquable();
                
        }else {
            alert(this.statusText);
            
        }
        }
}

