<?php
/*
 * Micael Rodrigues
 * T.IS-E2B
 * 12.09.2018
 */
require_once 'library.php';

$ShowPosts = GetPosts();
$id = $ShowPosts['idPost'];
$ShowPicture =GetPostsImagebyId($id);


/*if (!empty($ShowPosts['idPost'])) 
{ 

}*/

include_once 'index.php';