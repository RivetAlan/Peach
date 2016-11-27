<?php
    session_start();

    require("../param.inc");

    try{
	$pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
		} catch (PDOException $e) {
			echo ("Echec de la connexion");
		}
	$pdo->query("SET NAMES utf8");
	$pdo->query("SET CHARACTER SET 'utf8'");
    

    


    if(isset($_POST) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = $_POST['pseudo'];
        $mdpDonne = $_POST['mdp'];
        
        $req="SELECT id,UserName,password FROM user WHERE UserName ='".$pseudo."' " ;
        $verifConnexion=$pdo->query($req);
        $donnees=$verifConnexion->fetch(PDO::FETCH_OBJ);
        
        
        if(md5(SALAGE.$mdpDonne)==$donnees->password){
            
            $_SESSION['idUser'] = $donnees->id;
            $_SESSION['pseudo'] = $pseudo;
            header('Location: ../accueil.php');
        
        }else{
            
            echo 'Combinaison pseudo/mdp mauvaise';
            
        }
        
	$pdo=null;
}
 
    
    



?>