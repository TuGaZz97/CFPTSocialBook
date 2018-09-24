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

    try{
        $db = connectDb();
        $db->beginTransaction();
        $sql = "INSERT INTO `postimage`(`NameImage`,`idPost`)
            VALUE (?,?)";
        $request = $db->prepare($sql);
        $request->execute(array($NameImage,$idPost));
        $db->commit();
    }catch(Exception $e){
        $db->rollBack();
        echo "Erreur lors de l'insertion d'image by id";
        echo "failed: " . $e->getMessage();
    }
}

/**
 * Insertion des images dans la BDD
 */
function InsertDataPicture($NameImage) {

    try{
        $db = connectDb();
        $db->beginTransaction();
        $sql = "INSERT INTO `postimage`(`NameImage`)
            VALUE (?)";
        $request = $db->prepare($sql);
        $request->execute(array($NameImage));
        $db->commit();
    }catch(Exception $e){
        $db->rollBack();
        echo "Erreur lors de l'insertion d'image";
        echo "failed: " . $e->getMessage();
    }
}

/**
 * Insertion des posts dans la BDD
 */
function InsertDataPost($NamePost) {
    try{
        $db = connectDb();
        $db->beginTransaction();
        $sql = "INSERT INTO `posts`(`Commentaire`,`DatePublication`)
            VALUE (:Commentaire,:Date)";
        $date = date("Y-m-d H:i:s");
        $request = $db->prepare($sql);
        $request->execute(array(
            'Commentaire' => $NamePost,
            'Date' => $date
        ));
        return $db->lastInsertId();
        $db->commit();
    }catch(Exception $e){
        $db->rollBack();
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
 * Récupère le Nom de L'image par rapport a l'id du post lié bd --> postImage
 */
function GetPostsImagebyId($idPost){
    $db = connectDb();
    $sql = "SELECT `NameImage`, `idPost` FROM `postimage` Where idPost = :idPosts";
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
        $db->beginTransaction();
        $sql = "DELETE FROM `postimage` Where idPostImage = :idImage";
        $request = $db->prepare($sql);
        $request->execute(array(
            'idImage' => $idImage
        ));
        $db->commit();
    }catch(Exception $e){
        $db->rollBack();
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
        $db->beginTransaction();
        $sql = "DELETE FROM `posts` WHERE `idPost` = :idPosts";
        $request = $db->prepare($sql);
        $request->execute(array(
            'idPosts' => $idPost
        ));
        $db->commit();
    }catch(Exception $e){
        $db->rollback();
        echo "Erreur lors de la suppression de post";
        echo "failed: " . $e->getMessage();
    }
}
?>