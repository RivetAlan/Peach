<?php 
require("param.inc");

    $idQ = $_GET['idQuestion'];

        $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");
    $requete = "Select path, video.id from video where question_id='".$idQ."'" ; 
    $statement = $pdo->query($requete);
    $ligne = $statement->fetch(PDO::FETCH_OBJ); 
    while(!($ligne==false)){
        $fichierSansExtension = substr($ligne->path,0,-4);
        $fichierJpeg = $fichierSansExtension.".jpg";
?>
    <div class="video">
        <img src="php<?php echo($fichierJpeg)?>" id="<?php echo($ligne->id);?>" class="videoimg" />
    </div>
<?php 
        $ligne= $statement->fetch(PDO::FETCH_OBJ); 
        } 
    $pdo = null;
?>