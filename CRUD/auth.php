<?php
// if ($_POST['name']) {
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $intro = $_POST['intro'];
//     $sensitive = fopen("$name.txt", "w");

//     $data = "Name: " . $name . "\nEmail: " . $email . "\nIntro: " . $intro;

//     echo $data;

//     $sensitive = fopen("$name.txt", "w");
//     fwrite($sensitive, $data);
//     fclose($sensitive);
// }
// if ($_GET['search']) {
//     $name = $_GET['search'];
//     $filePath = '$name.txt';
//     if (file_exists($filePath)) {
        
//         $sensitive = fopen("$name.txt", "r");
//         $data = fread($sensitive, filesize("$name.txt"));
//         fclose($sensitive);
//         echo $data;
//     } else {
//         echo "The file not exist";
//     }
    
// }
// if($_POST['updatedName']){
//     $name = $_POST['updatedName'];
//     $email = $_POST['updatedEmail'];
//     $intro = $_POST['updatedIntro'];
//     $sensitive = fopen("$name.txt", "w");

//     $data = "Name: " . $name . "\nEmail: " . $email . "\nIntro: " . $intro;

//     echo $data;

//     $sensitive = fopen("$name.txt", "w");
//     fwrite($sensitive, $data);
//     fclose($sensitive);
// }
// if($_POST['deletedName']){
//     $name = $_POST['deletedName'];
//     unlink("$name.txt");
//     echo 'deleted';
// }


$servername = "localhost";
$username = "root";
$password = "Root@123";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully\n";

// Create database
// $sql = "CREATE DATABASE IF NOT EXISTS loginDB";
// if($conn->query($sql) === TRUE){
//     echo "Database created successfully\n";
// } else {
//     echo "Error creating database: " . $conn->error. "\n";
// }
// $sql = 'CREATE TABLE IF NOT EXISTS loginDB.users (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(30) NOT NULL,
//     email VARCHAR(50),LONGBLOB
//     password VARCHAR(50),
//     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//     )';
// if($conn->query($sql) === TRUE){
//     echo "Table created successfully\n";
// } else {
//     echo "Error creating table: " . $conn->error. "\n";
// }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if($password !== $cpassword){
        echo 'Password not match';
        exit();
    }
    $sql = "INSERT INTO loginDB.users (name, email, password) VALUES ('$name', '$email', '$password')";
    if($conn->query($sql) === TRUE){
        echo "New record created successfully\n";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error. "\n";
    }
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $email = $_GET['email'];
    $password = $_GET['password'];
    $sql = "SELECT * FROM loginDB.users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        echo 'Login successfully';
        // Get the name of the user from database
        $sql = "SELECT name FROM loginDB.users WHERE email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['name'];
        // set cookie for 1 day
        setcookie('email', $email, time()+3600*24, '/');
        setcookie('name', $name, time()+3600*24, '/');
        header('Location: index.php');
    } else {
        echo 'Login failed';
    }
}
