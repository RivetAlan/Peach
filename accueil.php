<!DOCTYPE html>
<?php 
session_start(); 
if(isset($_SESSION['idUser'])){
    require( 'php/param.inc'); 
$pdo=new PDO( "mysql:host=".MYHOST. ";dbname=".MYDB,MYUSER,MYPASS); 
$pdo->query("SET NAMES utf8"); 
$pdo->query("SET CHARACTER SET 'utf8'");
$dateJour = date('Y-m-d');

try{
$pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
    } catch (PDOException $e) {
        echo ("Echec de la connexion");
    }
$pdo->query("SET NAMES utf8");
$pdo->query("SET CHARACTER SET 'utf8'");

$pseudo = $_SESSION['pseudo'];


 $req="SELECT photoPath,nbVideo,pourcentageAvis,email FROM user WHERE UserName ='".$pseudo."' " ;
    $verifConnexion=$pdo->query($req);
    $donnees=$verifConnexion->fetch(PDO::FETCH_OBJ);


    $photoPath = $donnees->photoPath ;
    $nbVideo = $donnees->nbVideo ;
    $pourcentageAvis = $donnees->pourcentageAvis ;
    $email = $donnees->email ;
    
?>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Accueil Peach</title>
    <meta name="description" content="An interactive getting started guide for Brackets.">
    <link rel="stylesheet" href="css/resetCSS.css">
    <link rel="stylesheet" href="css/styleAide.css">
    <link rel="stylesheet" href="css/overlay.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,800,300,300italic,400italic,600italic,700italic,700,800italic,600' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-2.2.1.min.js" integrity="sha256-gvQgAFzTH6trSrAWoH1iPo9Xc96QxSZ3feW6kem+O00=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>
    <script type='text/javascript' src="script/dragdealer.js"></script>
    <script type='text/javascript' src="script/script.js"></script>
</head>

<body>
   
   
   
   <div class="container overlay overlay-slidedown">
	 
            <div id="rectangleInfo">
               <div id="close">
                   <i class="fa fa-times fa-3x" style="color: #f68172"></i>
               </div>
                <img id="logo" src="./medias/img/logoPeach.png"/>
                <div id="corpsInfo">
                   <div id="description">
                    <img alt="iconeDescription" class="picto" src="medias/img/info.png"/>
                       <br><br>
                       <p><strong>Peach</strong> est un réseau social vidéo. Il vous offre la possibilité de donner votre avis sur des sujets d’actualités variés. En vous prenant en <strong>vidéo face caméra</strong>, vous pourrez réagir à la question de votre choix. Soyez bref, <strong>vous disposez d’une minute</strong>. À chaque jour, sa nouvelle question. Vous pourrez choisir la question de la semaine qui vous convient le plus.</p>
                       <br><br>
                       <p>Via la plateforme Peach, vous pourrez naviguez très simplement pour consulter les réponses des autres utilisateurs. <strong>Réagissez et donnez votre avis !</strong></p>
                       <br><br>
                       <p>Le site est un mur de vidéos, une mosaïque de visages, chacun de ces visages étant celui d’un utilisateur du réseau. </p>
                       <img alt="iconeSP" class="picto" id="pictoSP" src="medias/img/iconeSP.png"/>
                       <br><br>
                       <div>
                           <p id="paragraphe4">À l’aide de <strong>l’application mobile</strong> Peach, il vous sera possible de donner votre avis en vidéo et de le poster directement sur le site.</p>
                        </div>
                    </div>
                    <hr>
                    <div id="aide">
                        <div id="aide1" class="aide">
                            <i class="fa fa-arrows fa-4x" style="color: #28e0f4"></i>
                            <p><strong>Choisissez la question</strong> qui vous intéresse parmi celles proposées au cours de la semaine. À l’aide d’un simple cliquer-glisser, <strong>naviguez</strong> parmi toutes les réactions des utilisateurs et consultez celles qui vous intéresse.</p>
                        </div>
                        <div id="aide2" class="aide">
                            <i class="fa fa-check fa-4x" style="color: #28e0f4"></i>
                            <p>Vous venez de consulter un avis d’un utilisateur sur une question et vous souhaitez réagir ? À l’aide des boutons situés en dessous de la vidéo, <strong>exprimez vous!</strong><br>Vous pouvez également, s’il le témoignage vous a séduit, placez celui-ci dans vos favoris. </p>
                        </div>
                        <div id="aide3" class="aide">
                            <i class="fa fa-upload fa-4x" style="color: #28e0f4"></i>
                            <p>Rendez vous sur l’application Peach. Connectez vous avez vos identifiants, choisissez la question et <strong>lancez vous !</strong><br>Exprimez-vous pendant une minute. Une fois terminé, envoyez votre <strong>peach</strong> et rendez vous sur notre site pour consulter votre vidéo et celles de la communauté.</p>
                        </div>
                        <div id="aide4" class="aide">
                            <i class="fa fa-pie-chart fa-4x" style="color: #28e0f4"></i>
                            <p>En cliquant sur le bandeau vertical situé à gauche, vous pouvez accéder a <strong>votre profil</strong>. Vous pouvez également l’éditer à l’aide du petit crayon situé en haut à gauche. <br>Vous trouverez les <strong>informations</strong> suivantes : le nombre de peach postés, le pourcentage d’avis positif. En bas de celui-ci, vous pourrez consultez toutes les vidéos que vous avez mises en favoris.</p>
                        </div>
                        <div id="aide5" class="aide">
                            <i class="fa fa-plus fa-4x" style="color: #28e0f4"></i>
                            <p>À l’aide d’un bouton placé juste a côté de l’icône info, vous pourrez accéder aux <strong>archives</strong> qui rassemblent toutes les vidéos postées sur Peach. Une vidéo est conservée par jour, vous pourrez ainsi consulter les anciens sujets qui ont suscités le plus de <strong>réactions</strong>.</p>
                        </div>

                        </div>
                    </div>
                </div>
            

	</div>
   
   
   
   
   
   
    <div id="profil">
        <div>
            <div>
                <img src="php/<?php echo $photoPath ?>" alt="imageProfil">
                <div></div>
            </div>
            <div>
                <h1><?php echo $pseudo ?></h1>
                <div>
                    <div>
                        <p><?php echo $nbVideo ?></p>
                        <h3>PEACHS PUBLIÉS</h3>
                    </div>
                    <div>
                        <p><?php echo $pourcentageAvis ?></p>
                        <h3>D'AVIS POSITIFS</h3>
                    </div>
                    <div>
                        <p>371</p>
                        <h3>RÉACTIONS</h3>
                    </div>
                </div>
            </div>
            
            <div>
                <h2>Favoris</h2>
                <div>
                    <div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div>
                        <p>AFFICHER PLUS DE FAVORIS</p>
                        <img src="medias/img/favArrow.png" alt="Flêche favoris">
                    </div>
                </div>
            </div>
            
            
            <div>
                
                
                <form action="php/insererVideo.php" method="post" enctype="multipart/form-data" style="height: 60px;
    width: 250px">
                    <input name="video" type="file" id="my-file" onchange="this.form.submit()" style=" cursor : pointer ; opacity : 0; z-index : 25; position: fixed ; height: 60px;
    width: 250px;" value="PITCHER"/>
                </form>
                <div><i class="fa fa-upload fa-2x"></i>
                <h2>PEACHER</h2></div>

                
            </div>
            <div id="changerPhoto">
            <form method="post" enctype="multipart/form-data" action="php/insererPhotoProfil.php">
        <input onchange="this.form.submit()" name="photo" id="choixPhoto" type="file"/>
    
        </form>
           </div>
           <a href="php/scriptDeco.php"> Se déconnecter</a>
           
        </div>
        <div>
            <div id="boutonProfil">
                <img src="medias/img/iconProfil.png" alt="iconProfil">
            </div>
        </div>
    </div>
    <div id="main">
        <div id="filtreNoir"></div>
        <div id="filtreNoir2"></div>
        <div id="bandeau_question">
            <img id="fleche" src="medias/img/arrow.png" alt="fleche" />
            
    <?php
        $date = date('Y-m-d');
        $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");
        $requete ="SELECT * FROM question WHERE dateQuestion <= '".$date."' ORDER BY dateQuestion desc";
        $statement = $pdo->query($requete);
        $ligne = $statement->fetch(PDO::FETCH_OBJ);
    ?>
            <h2 id="<?php echo $ligne->id; ?>">
    <?php
        echo $ligne->question;
        unset($ligne);
        ?>
                     
                    </h2>
        </div>

        <div id="autres_questions">
        <?php 
        $aujourdhui = date('Y-m-d');
        
        $date = date("Y-m-d", strtotime("-6 day", strtotime($aujourdhui))); 
        $ligne = $statement->fetch(PDO::FETCH_OBJ);
        $i = 0;
        while(!($ligne==false) && $i<6){
             ?> <h2 id="<?php echo $ligne->id; ?>"> <?php 
                echo $ligne->question;
            ?></h2>
            <?php
                $ligne = $statement->fetch(PDO::FETCH_OBJ);     
                $i++;
        }
?>
        </div>
        
        <div id="conteneur" class="dragdealer">
            <div id="video" class="handle">
				 <?php 
$requete ="Select path, video.id from video, question where question_id=question.id AND question.dateQuestion ='".$dateJour."'" ; 
$statement = $pdo->query($requete);
$ligne = $statement->fetch(PDO::FETCH_OBJ); 
                    while(!($ligne==false)){
                        $fichierSansExtension = substr($ligne->path,0,-4);
                        $fichierJpeg = $fichierSansExtension.".jpg";
                ?>
			   <div class="video">
					<img src="php<?php echo($fichierJpeg)?>" id="<?php echo($ligne->id);?>" class="videoimg" />
			   </div>
                <?php 
                        $ligne= $statement->fetch(PDO::FETCH_OBJ); 
                        } 
                    $pdo = null;
                ?>
            </div>
        </div>

     <div id="videoclique">
         
            <div class="videocliquee" id="videocliquee"></div>
            <div>
                <div><i id="btnFav" class="fa fa-check fa-3x"></i></div>
                <div><i class="fa fa-star-o fa-3x"></i></div>
                <div><i class="fa fa-times fa-3x"></i></div>
            </div>
            <img alt="fermerVideo" src="medias/img/delete.png" id="fermerVideo"/>
            
            <!--<div>
                <div id="progressBar"></div>
                <div>
                    <p>86%</p>
                    <p>d'avis positifs</p>
                </div>
                <div>
                    <p>32</p>
                    <p>réactions</p>
                </div>
            </div>-->
        </div> 
        <div class="btn" id="icones">
            <img src="medias/img/infoVide.png" alt="Information">
        </div>
        <img src="medias/img/logo.png" alt="logo" />
    </div>
       <script src="script/custom.js"></script>
        <script>
            //$('#video').draggable();
            new Dragdealer('conteneur', {
                vertical: true

            });
        </script>
    <script type='text/javascript' src="script/progressbar.min.js"></script>
    
</body>

</html>
    
    
    
 <?php   
    
}else{
    header('Location: bonjour.html');
    
}

?>