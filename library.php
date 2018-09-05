<?php
// Script: library.php
// Description: Libraire de functions
// Auteur: Micael Rodrigues
// Classe : T.IS-E2B
// Version 1.0: 03.09.2018

require_once ('dbconnection.php');

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
?>