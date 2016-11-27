<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<h1>Galerie de video</h1>
<?php 
        require('php/param.inc');

        $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");

        $dateJour = date('Y-m-d');
        
        $requete ="Select path , video.id from video, question where question_id=question.id AND question.dateQuestion ='".$dateJour."'" ;
        $statement = $pdo->query($requete); //requete test si deja question aujourdhui
        $ligne = $statement->fetch(PDO::FETCH_OBJ);
       
        while(!($ligne == false)){
?>

    
        <img src="php<?php echo($ligne->path)?>" id="<?php echo($ligne->id)?>" class="vignette">
        
<?php  
                             $ligne = $statement->fetch(PDO::FETCH_OBJ); 
                                 }
    $pdo = null;


?>