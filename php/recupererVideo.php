<?php 
    require("param.inc");

if(isset($_GET['idVideo'])){
    
        $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");
        $requete ="SELECT path FROM video WHERE id ='". $_GET['idVideo']."'";
        
        $statement = $pdo->query($requete);
        $ligne = $statement->fetch(PDO::FETCH_OBJ);
		
        echo ('<video width="800" height="450" src="php'.$ligne->path.'" autoplay id="videojouee" />');
			
	}?>


