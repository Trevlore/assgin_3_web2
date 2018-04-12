<?php

// in $_GET "target" and  "id"
session_start();
if($_GET['target'] == 'allPost'){
    //unset all post
    unset($_SESSION['postFavorites']);
      
}
elseif($_GET['target'] == 'allImg'){
    //unset all img
    unset($_SESSION['imageFavorites']);
}
else {
    if($_GET['target'] == 'img'){
    unset($_SESSION['imageFavorites'][$_GET['id']]);
    $_SESSION['imageFavorites'] = array_values($_SESSION['imageFavorites']);
    }else{
     //assume post
     
    unset($_SESSION['postFavorites'][$_GET['id']]);
    $_SESSION['postFavorites'] = array_values($_SESSION['postFavorites']);
     }
  
 }

// return to facorites.php
header("Location: favorites.php");
?>