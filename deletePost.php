<?php
/* Micael Rodrigues
* 24.09.2018
* deletePost.php
*/
require_once("library.php");

$errors = array();

//Vérifier contenu reçu par le formulaire
if(filter_has_var(INPUT_POST, "deletePost")){
  //Comment & images
  $idPost = filter_input(INPUT_POST, 'idPostModal', FILTER_SANITIZE_STRING);

echo $idPost;

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
      //DeletePostsImage($Image['idPostImage']);
      //Supprime l'image du répertoire courant
      unlink("./img/uploads/" + $Image['NameImage']);
      header("location: index.php");
      echo "Suppression réussi";
      exit;
    }

  } else {
    header("location:index.php");
    echo "Tableau de post vide";
    exit;
  }
} else {
  header("location:index.php");
  echo "Pas d'éléments à supprimer";
  exit;
}
