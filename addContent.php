<?php
// Script: exemple_AddContentAvecTransaction.php
// Description: Filtre les informations transmise par le formulaire d'upload de fichiers
// Auteur: Micael Rodrigues
// Classe : T.IS-E2B
// Version 1.0: 03.09.2018
// Version 2.0: 03.10.2018

require_once("library.php");
require_once("dbconnection.php");
include("resize-class.php");

$errors = array();

if(filter_has_var(INPUT_POST, "submitContent")){
  //Check enter comment post user
  $Comment = filter_input(INPUT_POST, "textArea", FILTER_SANITIZE_STRING);
  $imagePost = $_FILES['inputFile'];
  if(!empty($Comment)){
    $db = connectDB();
    try{
      $db->beginTransaction();
      $idPost = InsertDataPost($Comment);
      //Envoi du message dans la base de donnée
      //traitement des images
      if (isset($imagePost)) {
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

            /**************************traitement image*******************************************************************/
            $name = $imagePost['tmp_name'][$i];
            $filename = $imagePost['name'][$i];
            //déplace les images dans le répertoire par default
            $uploads_dir = 'img/uploads/';
            //Génère un identifiant unique
            $UUID = uniqid();
            //Déplace l'image sélectionner dans le dossier upload
            move_uploaded_file($name, "$uploads_dir/$UUID"."_"."$filename");
            // *** 1) Initialise / load image
            $resizeObj = new resize($uploads_dir."/".$UUID."_".$filename);

            // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(1024, 768, 'exact');

            // *** 3) Save image
            $resizeObj -> saveImage($uploads_dir.$UUID. "_" .$filename.'', 9);

            if(!empty($filename)) //Si pas d'image --> juste upload commentaire
            /*{
              $idPost = InsertDataPost($Comment);
            }
            else*/{
              //Ajout dans la BD
              InsertDataPicturebyId($UUID. "_" .$filename,$idPost);
              //Redirection vers page principal
            }
            header('Location: index.php');
            //Affichage image redimensionnée
            //echo '<br><img src="img/uploads/'.$UUID. "_" .$filename.'">';
          }
          $db->commit();
        }
      }
    }catch(Exception $e){
      echo "Error". $e->getMessage();
      $db->rollBack();
    }
  }
  else
  {
    header('Location: index.php');
    echo "Erreur d'uploads";
  }
}
