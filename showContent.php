<?php
/*
 * Micael Rodrigues
 * T.IS-E2B
 * 12.09.2018
 */
require_once 'library.php';

$ShowPosts = GetPosts();

if (isset($ShowPosts['idPost'])) 
{ 
    $idPost = $ShowPosts['idPost'];
    $ShowPicture =GetPostsImagebyId($idPost);
}

include_once 'index.php';