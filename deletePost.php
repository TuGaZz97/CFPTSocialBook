<?php
/* Micael Rodrigues
 * 24.09.2018
 * deletePost.php 
 */
require_once("library.php");

$errors = array();
//Vérifier contenu reçu par le formulaire
if(filter_has_var(INPUT_POST, "deletePost")){
    //Check enter comment post user
    $Comment = filter_input(INPUT_POST, "textArea", FILTER_SANITIZE_STRING);
}