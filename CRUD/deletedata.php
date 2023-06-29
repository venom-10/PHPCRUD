<?php
include('conn.php');
$id =  $_GET['id'];

$sql = "Delete from $dbname.userdetails where id='$id'";
if(isset($_COOKIE['name'])){
    if($conn->query($sql)){
        setcookie('datadeleted', 'true', time()+2, '/');
        header('location:index.php');
    }
}
else{
    setcookie('notlogin', 'OK', time()+2, '/');
    header('location: index.php');
}
