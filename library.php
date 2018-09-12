<?php
// Script: library.php
// Description: Libraire de functions
// Auteur: Micael Rodrigues
// Classe : T.IS-E2B
// Version 1.0: 03.09.2018

require_once ('dbconnection.php');

/**
 * Insertion des images par rapport id post dans la BDD
 */
function InsertDataPicturebyId($NameImage,$idPost) {
    $db = connectDb();
    $sql = "INSERT INTO `postimage`(`NameImage`,`idPost`)
            VALUE (?,?)";
    $request = $db->prepare($sql);
    $request->execute(array($NameImage,$idPost));
}

/**
 * Insertion des images dans la BDD
 */
function InsertDataPicture($NameImage) {
    $db = connectDb();
    $sql = "INSERT INTO `postimage`(`NameImage`)
            VALUE (?)";
    $request = $db->prepare($sql);
    $request->execute(array($NameImage));
}

/**
 * Insertion des posts dans la BDD
 */
function InsertDataPost($NamePost) {
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
}

/**
 *Affiche Commentaire & DatePublication bd --> posts
 */
function GetPosts(){
    $db = connectDb();
    $sql = "SELECT 'idPost', 'Commentaire', 'DatePublication' FROM `posts`";
    $request = $db->prepare($sql);
    $request->execute(array());
    return $request->fetchAll();
}
/**
 * Récupère le Nom de L'image bd --> postImage
 
function GetPostsImage(){
    $db = connectDb();
    $sql = "SELECT `NameImage` FROM `postimage`";
    $request = $db->prepare($sql);
    $request->execute(array());
    return $request->fetchAll();
}*/

/**
 * Récupère le Nom de L'image par rapport a l'id du post lié bd --> postImage
 */
function GetPostsImagebyId($idPost){
    $db = connectDb();
    $sql = "SELECT `NameImage` FROM `postimage` Where idPost = :idPosts";
    $request = $db->prepare($sql);
    $request->execute(array(
        'idPosts' => $idPost
    ));
    return $request->fetchAll();
}
?>