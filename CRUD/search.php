<?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $searchname = $_POST['search'];
        setcookie('searchbyname', $searchname, time()+1, '/');
        header('location:index.php');
        exit();
    }
?>