<?php


    require("param.inc");
        try{
        $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
            } catch (PDOException $e) {
                echo ("Echec de la connexion");
            }
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");

        $dateQuestion = date('Y-m-d');

        $requete ="delete from question where dateQuestion='".$dateQuestion."'";

        $statement = $pdo->query($requete); //requete test si deja question aujourdhui
        header('Location: admin.php');
?>