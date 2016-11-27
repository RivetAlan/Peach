<?php
require('../param.inc');
session_start();



$pseudo= $_SESSION['pseudo'];

$dossier     = 'photoProfil/';
$fichier     = basename($_FILES['photo']['name']);
$taille_maxi = 2500000000;
$taille      = filesize($_FILES['photo']['tmp_name']);


$extensions  = array(
    '.jpg',
    '.png',
);
$extension   = strrchr($_FILES['photo']['name'], '.');


//Début des vérifications de sécurité...
if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
    $erreur = 'Vous devez uploader un fichier de type png, jpeg ou gif';
}
if ($taille > $taille_maxi) {
    $erreur = 'Le fichier est trop gros...';
}
if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
    $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    //On formate le nom du fichier ici...
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
        
        if ($extension == '.jpg'){
            require_once("convertirImageJpg250.inc");
            convertirImage390($dossier.$fichier,$dossier."reduc_".$fichier);
            
        }else{
            require_once("convertirImagePng250.inc");
            convertirImage390($dossier.$fichier,$dossier."reduc_".$fichier);
        }
        
        $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");
        $req = "UPDATE user SET photoPath ='".$dossier."reduc_".$fichier."' where UserName='".$pseudo."'";
        //echo($req);
        
        $statement = $pdo->query($req);
        
       
        
        
        
        
        header('Location: ../accueil.php');

    } else //Sinon (la fonction renvoie FALSE).
        {
        echo 'Echec de l\'upload !';
    }
} else {
    echo $erreur;
}

?>
  
