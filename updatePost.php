<?php
/* Micael Rodrigues
* 24.09.2018
* deletePost.php
*/
require_once("library.php");
require_once("dbconnection.php");

$database = connectDb();
//Vérifier contenu reçu par le formulaire
if(filter_has_var(INPUT_POST, "updatePost")){

  try {
    $database->beginTransaction();
    
    $NewComment = filter_input(INPUT_POST, 'CommentModification', FILTER_SANITIZE_STRING);
    $idPost = filter_input(INPUT_POST, 'idPostModal', FILTER_SANITIZE_STRING);

    if (UpdatePosts($idPost,$NewComment)) {
      header("Location: index.php");
      echo "Suppression réussie";
      $database->commit();
      header('Location: index.php');
    } else {
      throw new Exception('Update_Comment_failed');
    }
  } catch(Exception $e) {
    Debug($e);
    $database->rollBack();
    die;
  }
}
