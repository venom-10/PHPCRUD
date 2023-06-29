<?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if($_COOKIE['email'] || $_COOKIE['name']){
            setcookie('email', '', time()-3600, '/');
            setcookie('name', '', time()-3600, '/');
            setcookie('page', '', time()-3600, '/');
            setcookie('accessToken', '', time()-3600, '/');
            setcookie('logout', 'OK', time()+2, '/');
            header('Location: signedin.php');
        }
        else{
            echo '<h1>You are not log in, Pls log in</h1>';
        }
    }
    else{
        echo '<h1>Wrong Method</h1>';
    }
?>