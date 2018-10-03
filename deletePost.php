<?php
/* Micael Rodrigues
* Version 1.0 : 24.09.2018
* Version 2.0 : 03.10.2018
* deletePost.php
*/
require_once("library.php");
require_once("dbconnection.php");

$errors = array();
$database = connectDb();
//Vérifier contenu reçu par le formulaire
if(filter_has_var(INPUT_POST, "deletePost")){

  try {
    $database->beginTransaction();

    //Comment & images
    $idPost = filter_input(INPUT_POST, 'idPostModal', FILTER_SANITIZE_STRING);

    $Post = GetPostbyId($idPost);
    $Image = GetPostsImagebyId($idPost);

    if (is_array($Post)) {
      $comment = isset($Post['Commentaire']) ? $Post['Commentaire'] : NULL;
      $date = isset($Post['DatePublication']) ? $Post['DatePublication'] : NULL;
      $ImageDelete = isset($Image['NameImage']) ? $Image['NameImage'] : NULL;

      /*
      Si Delete les posts écrits alors fait aussi les images
      */
      if (DeletePosts($idPost)) {

        foreach ($Image as $img) {
          DeletePostsImage($img['idPostImage']);
          //Supprime l'image du répertoire courant uniquement si tout a été correctement supprimé
          if(!unlink("img/uploads/" . $img['NameImage'])) {
            throw new Exception('file_not_exists');
          }
        }
        header("Location: index.php");
        echo "Suppression réussie";
        $database->commit();
        header('Location: index.php');
      } else {
        throw new Exception('deletion_failed');
      }
    } else {
      throw new Exception('posts_empty');
    }


  } catch(Exception $e) {
    Debug($e);
    $database->rollBack();
    die;
  }
}
