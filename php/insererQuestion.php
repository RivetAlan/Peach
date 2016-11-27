<?php
    require("param.inc");
   
   if(isset($_POST["question"]) && $_POST["question"]!= ""){
        try{
        $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
            } catch (PDOException $e) {
                echo ("Echec de la connexion");
            }
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");

        $dateQuestion = date('Y-m-d');

        $requete ="Select question from question where dateQuestion='". $dateQuestion."'";

        $statement = $pdo->query($requete); //requete test si deja question aujourdhui
        $ligne = $statement->fetch(PDO::FETCH_OBJ);
       if($ligne == null){

        $requete ="INSERT INTO question VALUES ('', '".$_POST["question"]."', '".$dateQuestion."')  ";
        $statement = $pdo->query($requete);
        echo("Question insérée");
       }else{ 
           echo("La question du jour a déja été rentrée");
       ?><a href="supprimerQuestion.php">Supprimer la question du jour </a>
       
    <?php

   }
       ?>
<a href="admin.php">Retour au back office</a>
<?php
   }else 
       header('Location: admin.php'); 
   
?>

