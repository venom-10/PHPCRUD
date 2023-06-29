<?php
    $hostname ='localhost';
    $username ='root';
    $password ='Root@123';
    $dbname = 'rohitcrud';
    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    if(!$conn){
        echo 'Connection error: '. mysqli_connect_error();
    }
    $sql = "select count(*) from $dbname.user";
    $result = $conn->query($sql);
    $totalrow = $result->num_rows;
?>