<?php 
    include('conn.php');
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $email = $_GET['email'];
        $password = $_GET['password'];
        $sql = "SELECT * FROM $dbname.users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);
        if(!($result->num_rows)){
            setcookie('notsignedup', 'true', time()+2, '/');
            header('location:signedin.php');
            exit();
        }
        $curruser = $result->fetch_assoc();
        $verify = $curruser['isverified'];
        echo gettype($verify);
        if($verify !== '1'){
            setcookie('notverified','false', time()+2, '/');
            header('location:signedin.php');
            exit();
        }
        if($result->num_rows > 0){
            echo 'Login successfully';
            // Get the name of the user from database
            $sql = "SELECT name FROM $dbname.users WHERE email = '$email'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $name = $row['name'];
            // set cookie for 1 day
            setcookie('email', $email, time()+3600*24, '/');
            setcookie('name', $name, time()+3600*24, '/');
            setcookie('accessToken', hash('sha256', $name.'dfa'), time()+3600*24, '/');
            setcookie('signedin', 'OK', time()+5, '/');
            setcookie('page', 0, time()+3600*24, '/');
            header('Location: index.php');
        } else {
            echo 'Login failed';
        }
    }
?>