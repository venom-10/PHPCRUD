<?php
    include('conn.php');
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(($_COOKIE['email'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = "Select * from $dbname.users where email = '$email' and password = '$password'";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                $sql = "Delete from $dbname.users where email = '$email'";
                if($conn->query($sql) === TRUE){
                    echo "User deleted successfully\n";
                    setcookie('delete','deleted',time()+2,'/');
                    setcookie('email', '', time()-3600, '/');
                    setcookie('name', '', time()-3600, '/');
                    header("Location: index.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error. "\n";
                }
            }
            else{
                echo "User not found";
            }
        } 
        else {
            echo 'Please Log in first';
        }
    }
    else{
        echo 'Wrong Method';
    }