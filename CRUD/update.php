<?php
include('conn.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_COOKIE['email'])) {
        $email = $_POST['email'];
        $npassword = $_POST['npassword'];
        $cnpassword = $_POST['cnpassword'];
        $sql = "Select * from $dbname.users where email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if ($npassword === $cnpassword) {
                $sql = "UPDATE $dbname.users SET password = '$npassword' WHERE email = '$email'";
                if ($conn->query($sql) === TRUE) {
                    echo "Password updated successfully\n";
                    setcookie('updatepass','updated',time()+2,'/');
                    header("Location: signedin.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error . "\n";
                    header("Location: update.html");
                }
            } else {
                echo "Password not match";
            }
        }
        else{
            echo "User not found";
        }
    } else {
        echo 'Please log in first';
    }
} else {
    echo 'Wrong Method';
}
