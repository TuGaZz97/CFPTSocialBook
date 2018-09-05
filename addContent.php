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
        }
        //déplace les images dans le répertoire par default
        $uploads_dir = '.img/uploads/';
        //Génère un identifiant unique
        $UUID = uniqid();
        //Récupère l'extention du nom
        $path_parts = pathinfo($uploads_dir.$imagePost['name']);
        $ext = $path_parts['extension'];
            
		move_uploaded_file($imagePost['tmp_name'][$i], "$uploads_dir/$UUID.".".$ext");
        
        
     /*   // Affichage image de base
        echo '<br><img src="img/'.$imagePost['name'][$i].'">';

        // *** 1) Initialise / load image
        $resizeObj = new resize('img/'.$imagePost['name'][$i].'');

        // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
        $resizeObj -> resizeImage(1000, 900, 'landscape');

        // *** 3) Save image
        $resizeObj -> saveImage('img/uploads/'.$imagePost['name'][$i].'', 9);

        //Affichage image redimensionnée
        echo '<br><img src="img/uploads/'.$imagePost['name'][$i].'">';*/
    }

}
?>