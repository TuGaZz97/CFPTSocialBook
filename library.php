<?php
// Script: library.php
// Description: Libraire de functions
// Auteur: Micael Rodrigues
// Classe : T.IS-E2B
// Version 1.0: 03.09.2018
// Version 2.0 : 03.10.2018

require_once ('dbconnection.php');

/**
* Insertion des images par rapport id post dans la BDD
*/
function InsertDataPicturebyId($NameImage,$idPost) {

  try{
    $db = connectDb();
    $sql = "INSERT INTO `postimage`(`NameImage`,`idPost`)
    VALUE (?,?)";
    $request = $db->prepare($sql);
    $request->execute(array($NameImage,$idPost));
  }catch(Exception $e){
    echo "Erreur lors de l'insertion d'image by id";
    echo "failed: " . $e->getMessage();
  }
}

/**
* Insertion des posts dans la BDD
*/
function InsertDataPost($NamePost) {
  try{
    $db = connectDb();
    $sql = "INSERT INTO `posts`(`Commentaire`,`DatePublication`)
    VALUE (:Commentaire,:Date)";
    $date = date("Y-m-d H:i:s");
    $request = $db->prepare($sql);
    $request->execute(array(
      'Commentaire' => $NamePost,
      'Date' => $date
    ));
    return $db->lastInsertId();
  }catch(Exception $e){
    echo "Erreur lors de l'insertion de posts";
    echo "failed: " . $e->getMessage();
  }
}

/**
*Affiche Commentaire & DatePublication bd --> posts
*/
function GetPosts(){
  $db = connectDb();
  $sql = "SELECT `idPost`, `Commentaire`, `DatePublication` FROM `posts`";
  $request = $db->prepare($sql);
  $request->execute(array());
  return $request->fetchAll();
}

/**
*Affiche Commentaire & DatePublication d'après un id bd --> posts
*/
function GetPostbyId($idPost){
  $db = connectDb();
  $sql = "SELECT `idPost`, `Commentaire`, `DatePublication` FROM `posts` WHERE `idPost` = :idPostById";
  $request = $db->prepare($sql);
  $request->execute(array(
    'idPostById' => $idPost
  ));
  return $request->fetchAll();
}

/**
* Récupère le Nom de L'image par rapport a l'id du post lié bd --> postImage
*/
function GetPostsImagebyId($idPost){
  $db = connectDb();
  $sql = "SELECT * FROM `postimage` Where idPost = :idPosts";
  $request = $db->prepare($sql);
  $request->execute(array(
    'idPosts' => $idPost
  ));
  return $request->fetchAll();
}

/**
* Supprime l'image dans la base de donnée
*/
function DeletePostsImage($idImage){
  try{
    $db = connectDb();
    $sql = "DELETE FROM `postimage` Where idPostImage = :idImage";
    $request = $db->prepare($sql);
    $request->execute(array(
      'idImage' => $idImage
    ));
  }catch(Exception $e){
    echo "Erreur lors de la suppression d'image";
    echo "failed: " . $e->getMessage();
  }
}

/**
* Supprime le posts dans la base de donnée
*/
function DeletePosts($idPost){
  try{
    $db = connectDb();
    $sql = "DELETE FROM `posts` WHERE `idPost` = :idPosts";
    $request = $db->prepare($sql);
    $request->execute(array(
      'idPosts' => $idPost
    ));
    return true;
  }catch(Exception $e){
    echo "Erreur lors de la suppression de post";
    echo "failed: " . $e->getMessage();
    return false;
  }
}

/**
* Modification les posts dans la base de donnée
*/
function UpdatePosts($idPost,$ModifComment){
  try{
    $db = connectDb();
    $sql = "UPDATE `posts` SET `idPost`=:idPosts,`Commentaire`=:ModifComment,`DateModification`=:Date";
    $date = date("Y-m-d H:i:s");
    $request = $db->prepare($sql);
    $request->execute(array(
      'idPosts' => $idPost,
      'Date' => $date,
      'ModifComment' => $ModifComment
    ));
    return true;
  }catch(Exception $e){
    echo "Erreur lors de l'upload de post";
    echo "failed: " . $e->getMessage();
    return false;
  }
}


function Debug($content) {
  echo "<pre>";
  print_r($content);
  echo "</pre>";
  echo "<br/>";
}
