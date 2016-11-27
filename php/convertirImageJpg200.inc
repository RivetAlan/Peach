<?php
/** 
 * Réduction d'une image en une vignette de 200 pixels de coté
 *
 * @author <alain.corbiere@univ-lemans.fr>
 * @param nomFichierAConvertir nom du fichier de l'image à convertir
 * @return nomFichierConverti nom du fichier de l'image convertie
 *
 */ 
  function convertirImage390 ($nomFichierAConvertir, $nomFichierConverti) {
    $imageSource = imageCreateFromJpeg($nomFichierAConvertir);
	//$imageSource = imageCreateFromPng($nomFichierAConvertir);
    $tailleImage = getImageSize($nomFichierAConvertir);
    $largeurImageSource = $tailleImage[0];
    $hauteurImageSource = $tailleImage[1];
    if ($hauteurImageSource > $largeurImageSource) {
      $largeurImageReechantillonne = 200;
      // Contraint le rééchantillonage à une largeur fixe et maintient le ratio de l'image
      $hauteurImageReechantillonne = round(($largeurImageReechantillonne / $largeurImageSource) * $hauteurImageSource);
      $positionX = 0 ;
      $positionY = round(($hauteurImageReechantillonne-$largeurImageReechantillonne)/2) ;
    } else {
      $hauteurImageReechantillonne = 200;
      // Contraint le rééchantillonage à une largeur fixe et maintient le ratio de l'image
      $largeurImageReechantillonne = round(($hauteurImageReechantillonne / $hauteurImageSource) * $largeurImageSource);
      $positionX = round(($largeurImageReechantillonne-$hauteurImageReechantillonne)/2) ;
      $positionY = 0 ;
    }
    $imageReechantillonne = imageCreateTrueColor($largeurImageReechantillonne, $hauteurImageReechantillonne );
    /* ImageCopyResampled copie et rééchantillonne l'image originale*/
    imageCopyResampled($imageReechantillonne,$imageSource,0,0,0,0,
                       $largeurImageReechantillonne, $hauteurImageReechantillonne,
                       $largeurImageSource, $hauteurImageSource);
    $largeurImageDestination = 200 ;
    $hauteurImageDestination = 200 ;
    $imageDestination = imageCreateTrueColor($largeurImageDestination,$hauteurImageDestination);
    imageCopy ( $imageDestination, $imageReechantillonne, 0, 0,
                $positionX, $positionY, $largeurImageDestination,
                $hauteurImageDestination );
    imageDestroy($imageReechantillonne);
    imageJpeg($imageDestination, $nomFichierConverti) ;
    imageDestroy($imageDestination);
  }
?>