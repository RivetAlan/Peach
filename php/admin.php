 <?php session_start();
require('param.inc');
    $_SESSION["id"] = 1; // a modifier par la valeur de l'user
    if($_SESSION["id"] == 1){
        ?>
<html>
    <body>
        <h1>Inserer la question du jour</h1>
        <form action="insererQuestion.php" method="post">
            <fieldset>
                <label> Question du jour</label>
                <input type="text" name="question">
            </fieldset>
            <input type="submit">
        </form>
    
        
    </body>

</html>
<?php
        $aujourdhui = date('Y-m-d');
        $date = date("Y-m-d", strtotime("-7 day", strtotime($aujourdhui))); 
        $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");
        $requete ="SELECT question FROM question WHERE dateQuestion >= '".$date."'";
        echo $requete;
        $statement = $pdo->query($requete);
        $ligne = $statement->fetch(PDO::FETCH_OBJ);
        $jours = ['lundi','mardi','mercredi','jeudi', 'vendredi' , 'samedi' ,' dimanche' ];
        $i = 0;
         while(!($ligne==false) || $i<7){
             ?> <h2><?php  echo($jours[$i])?> : <?php echo $ligne->question ?></h2><?php
            $ligne = $statement->fetch(PDO::FETCH_OBJ);     
            $i++;
         }

    } else{
         header('Location: ../accueil.php');  
    }
?>