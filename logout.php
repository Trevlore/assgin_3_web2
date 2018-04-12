<script> document.cookie = 'test2=0; Max-Age=0';</script>
<?php 
    //remove $_SESSION
    
    session_start();
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
        exit();
    }
    
    if (isset($_SERVER['HTTP_COOKIE'])) {//do we have any
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);//get all cookies 
    foreach($cookies as $cookie) {//loop
        $parts = explode('=', $cookie);//get the bits we need
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);//kill it
        setcookie($name, '', time()-1000, '/');//kill it more
    }
}
    
    
    unset($_SESSION['id']);
    unset($_SESSION['imageFavorites']);
    unset($_SESSION['postFavorites']);
    header("Location: index.php");
    
?>
