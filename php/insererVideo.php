<?php
require('param.inc');
require('convertirImageJpg200.inc');
session_start();
$_SESSION['idUser'] = '1';
$dossier     = 'videos/';
$fichier     = str_replace(' ','',basename($_FILES['video']['name']));
$fichier     = str_replace('&','',$fichier);
$taille_maxi = 2501000000000000;
$taille      = filesize($_FILES['video']['tmp_name']);
 $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");
        $requete ="SELECT id FROM question WHERE dateQuestion = '".date('Y-m-d')."'";
     $statement = $pdo->query($requete);
    $ligne = $statement->fetch(PDO::FETCH_OBJ);

    $id_question_jour = $ligne->id;
    $pdo = null;
$fichierSansExtension = substr($fichier,0,-4);
$fichierJpeg = $fichierSansExtension.".jpg";
$extensions  = array(
    '.mp4',
    '.mp4',
    '.mov',
    '.webm',
    '.avi',
    '3gp'
);
$extension   = strrchr($_FILES['video']['name'], '.');
//Début des vérifications de sécurité...
if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
    $erreur = 'Vous devez uploader un fichier de type mp4, mov ou webm';
}
if ($taille > $taille_maxi) {
    $erreur = 'Le fichier est trop gros...';
}
if ($fichier == ".htacces") {
    $erreur = 'Essaye pas de m avoir';
}
if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
    $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '', $fichier);
    echo($fichier);
    echo($fichierJpeg);
    //On formate le nom du fichier ici...
    if (move_uploaded_file($_FILES['video']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
        
        $command = "ffmpeg.exe -i ".$dossier.$fichier." -ss 2 -vframes 1 -f mjpeg videos/".$fichierJpeg;
       
        $lignes = array();
        $returnVar=0;
        exec($command." 2>&1", $lignes, $returnVar);
         $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");
        $requete ="INSERT INTO video VALUES ('','/".$dossier.$fichier."','"
        .$_SESSION['idUser']. "','".$id_question_jour."','0','".$id_question_jour."','"
        .$_SESSION['idUser']."')";
        
        $statement = $pdo->query($requete);
        convertirImage390($dossier.$fichierJpeg,$dossier.$fichierJpeg);
        header('Location: ../accueil.php');

    } else //Sinon (la fonction renvoie FALSE).
        {
        echo 'Echec de l\'upload !';
    }
} else {
    echo $erreur;
}

?>