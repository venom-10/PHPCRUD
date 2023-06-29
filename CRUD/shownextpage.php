<?php 

    $page = $_COOKIE['page'];
    setcookie('page', $page+4, time()+3600*24, '/');
    header('location: index.php');

?>