<?php
// Script: addContent.php
// Description: Filtre les informations transmise par le formulaire d'upload de fichiers
// Auteur: Micael Rodrigues
// Classe : T.IS-E2B
// Version 1.0: 03.09.2018

require_once("library.php");
include("resize-class.php");

$errors = array();

if(filter_has_var(INPUT_POST, "submitContent")){

    //Check enter comment post user
    $Comment = filter_input(INPUT_POST, "texteArea", FILTER_SANITIZE_STRING);

    $imagePost = $_FILES['inputFile'];
    for($i=0;$i<count($imagePost['name']); $i++)
    {
        //Check type,errors,size
        if (strpos($imagePost["type"][$i], 'image') !== false)
        {
            echo "is image -> ".$imagePost["type"][$i]."<br>";
            if ($imagePost["error"][$i] == 0)
            {
                echo "FileName ->".$imagePost["name"][$i]."<br>";
                echo "as no error -> ".$imagePost["error"][$i]."<br>";
                if ($imagePost["size"][$i] > 70000000)
                {
                    echo "is bigger than 70'000'000 bytes -> ".$imagePost["size"][$i];
                }
            }

            /*********************************************************************************************/
            $name = $imagePost['tmp_name'][$i];  
            $filename = $imagePost['name'][$i]; 
            //déplace les images dans le répertoire par default
            $uploads_dir = 'img/uploads';
            //Génère un identifiant unique
            $UUID = uniqid();

            /* Methode GD

            //Taille max de l'image
            $width = 1200;
            $height = 1200;

            // Calcul des nouvelles dimensions
            list($width_orig, $height_orig) = getimagesize($name);

            $ratio_orig = $width_orig/$height_orig;

            if ($width/$height > $ratio_orig) {
                $width = $height*$ratio_orig;
            } else {
                $height = $width/$ratio_orig;
            }

            // Redimensionnement
            $image_p = imagecreatetruecolor($width, $height);
            $image = imagecreatefromjpeg($name);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
            //Déplace l'image dans le répertoire uploads
            move_uploaded_file($imagePost['tmp_name'][$i], "$uploads_dir/$UUID"."_"."$filename");*/

            //Déplace l'image sélectionner dans le dossier upload
            move_uploaded_file($name, "$uploads_dir/$UUID"."_"."$filename");
            // *** 1) Initialise / load image
            $resizeObj = new resize($uploads_dir."/".$UUID."_".$filename);

            // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(1000, 900, 'landscape');

            // *** 3) Save image
            $resizeObj -> saveImage($uploads_dir.$UUID. "_" .$filename.'', 9);

            //Affichage image redimensionnée
            echo '<br><img src="img/uploads/'.$UUID. "_" .$filename.'">';
        }
        else
        {
            header('Location: index.php');
        }



    }

}
?>