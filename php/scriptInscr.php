<?php


    require("../param.inc");
   
    try{
	$pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
		} catch (PDOException $e) {
			echo ("Echec de la connexion");
		}
	$pdo->query("SET NAMES utf8");
	$pdo->query("SET CHARACTER SET 'utf8'");
    

    $pseudo = $_POST['pseudo']; 
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $mdpverif = $_POST['mdpverif'];

    if($mdp == $mdpverif){
        
        
        
        //cryptage du mdp
        $mdp_hash=md5(SALAGE.$mdp);
        
        //On dépose tout dans la BDD, avec les salt pour décoder le mdp lors de la connexion       
        
        $req = $pdo->prepare("INSERT INTO user(UserName, photoPath, nbVideo, password,  email) VALUES (:pseudo, 'photoProfil/imgProf.png', 0 , :mdp, :email)");
    $req->execute(array(
            "pseudo" => $pseudo, 
            "mdp" => $mdp_hash,
            "email" => $email
            ));
        
        header('Location: ../bonjour.html');
        
    }else {
        echo "Les deux mdp sont différents";
    } 
    
$pdo = null;

?>