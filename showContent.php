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
    $id = $ShowPosts['idPost'];
    $ShowPicture =GetPostsImagebyId($id);
}

include_once 'index.php';