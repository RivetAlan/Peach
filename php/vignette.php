<?php
	require_once("config.php");
	require_once("Video.php");

class Vignette
{

	private $id;
	private $idVideo;
	private $time;
	
	public function Vignette($id, $idVideo, $time)
	{
		$this->id = $id;
		$this->idVideo = $idVideo;
		$this->time = $time;
	}
	
	public function getTime() {return $this->time;}
	
	public function toHtml()
	{
		return 
		"<div style='float: left; padding: 2px; font-size: 0.65em; border: 1px solid #808080'>".
			"<img src='".$this->makeUrl()."' alt=' '/><br/>".
			"<table style='width: 100%'><tr><td>f=".$this->getTime()."</td>".
			"<td style='text-align: right;'><a href='?deleteVignette=".$this->id."'><img style='height: 1.5em;' src='_delete.png' alt='' title='Supprimer'/></a></td></tr></table>".
		"</div>";
			
	}
	
	public static function effacerDansBase($id)
		{
			$lien = mysql_connect(DBHOST, DBUSER, DBPWD)  or die("erreur lors de la connexion à la base : ".mysql_error());
			mysql_select_db(DBBASE, $lien);
			$req = "DELETE FROM `vignettes` WHERE (`id` = '".$id."');";
			if (!mysql_query($req, $lien)) die("erreur lors de la suppression d'une vignette : ".mysql_error());
			mysql_close($lien);
		}
	
	public static function creerVignette_($video, $position)
	{
			if ($video->mov==null) $video->setInfos();
			$numFrame = round(( $position * $video->mov->getFrameCount() ) / $video->mov->getDuration());
			$vignette = new Vignette(0, $video->getId(), $numFrame);
			
			//$old = error_reporting(0);

			$frame = $video->mov->getFrame($numFrame);
			if (!$frame) $frame = null;
//			echo "frame ".$numFrame."/".$video->mov->getFrameCount()." ".$frame."<br/>";
			
			if ($frame!=null)
			{
				$frame->resize(64, 48);
				$gdi = $frame->toGDImage();
			}
			
			//error_reporting($old);

			if ($frame!=null)
			{
				
				$vignette->ecrireEnBaseDeDonnees();

				$nomFinal = $vignette->getFileName();
				imagegif($gdi, $nomFinal);
				return $vignette;
			}
			return null;

	}
	

	public static function creerVignette($video, $position)
	{
			$numFrame = round( $position * 25);
			$vignette = new Vignette(0, $video->getId(), $numFrame);
			$vignette->ecrireEnBaseDeDonnees();

			$nomFinal = $vignette->getFileName();

			$lignes = array();
			$returnVar=0;
			$command = FFMPEG." -i ".$video->getFileName()." -s ".TAILLE_VIGNETTES." -ss ".$position." -vframes 1 -f mjpeg ".$nomFinal;
			exec($command." 2>&1", $lignes, $returnVar);

			
			if ($returnVar==0)
			{
				return $vignette;
			}
			else
			{
				$vignette->effacerEnBaseDeDonnees();
				return null;
			}

	}
	
	
	
	public function getFileName()
	{
		return DOSSIER_PHYSIQUE."../vignettes/vignette_".$this->idVideo."_".$this->id.".gif";
	}

	public function makeUrl()
	{
		return "vignettes/vignette_".$this->idVideo."_".$this->id.".gif";
	}
		
	public function ecrireEnBaseDeDonnees()
	{
		$lien = mysql_connect(DBHOST, DBUSER, DBPWD)  or die("erreur lors de la connexion à la base : ".mysql_error());
		mysql_select_db(DBBASE, $lien);
		$req = "INSERT into `vignettes` (`id_video`, `time`) VALUES ('".$this->idVideo."','".$this->time."');";
		if (!mysql_query($req, $lien)) die("erreur à l'insertion en base : ".mysql_error());
		$this->id = mysql_insert_id($lien);
		mysql_close($lien);
	}
	
	public function effacerEnBaseDeDonnees()
	{
		$lien = mysql_connect(DBHOST, DBUSER, DBPWD)  or die("erreur lors de la connexion à la base : ".mysql_error());
		mysql_select_db(DBBASE, $lien);
		$req = "DELETE FROM `vignettes` WHERE `id`='".$this->id."' LIMIT 1;";
		if (!mysql_query($req, $lien)) die("erreur suppression en base : ".mysql_error());
		mysql_close($lien);
	}
}



?>