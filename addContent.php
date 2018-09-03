<?php
// Script: addContent.php
// Description: Filtre les informations transmise par le formulaire d'upload de fichiers
// Auteur: Micael Rodrigues
// Classe : T.IS-E2B
// Version 1.0: 03.09.2018

require_once("library.php");

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
    }

}
?>