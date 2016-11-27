<?php
    session_start();
    require('param.inc');
    if(isset($_GET["idVideo"]){
      $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
            } catch (PDOException $e) {
                echo ("Echec de la connexion");
            }
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'")
        $requete ="INSERT INTO favori VALUES ('".$_SESSION["idUser"]."','".$_GET["idVideo"]."')";
        $statement = $pdo->query($requete); //requete test si deja question aujourdhui
    }
       $pdo = null;
        
?>