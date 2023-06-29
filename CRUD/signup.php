<?php
include('conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "select * from $dbname.users where email = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        setcookie('duplicate_email','true', time()+2, '/' );
        header('location:signedup.php');
        exit();
    }
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $profile = $_FILES["files"]["name"];
    $otp = random_int(100000, 999999);
    if (strlen($password) >= 6) {
        $cap = preg_match('/[A-Z]/', $password);
        $spe = preg_match('/[!@#$%^&*()]/', $password);
        $num = preg_match('/[0-9]/', $password);
        setcookie('cap', $cap, time() + 5, '/');
        setcookie('spe', $spe, time() + 5, '/');
        setcookie('num', $num, time() + 5, '/');
        if ($cap && $spe && $num) {
            if ($password !== $cpassword) {
                setcookie('notmatch', 'OK', time() + 2, '/');
                header('Location:signedup.php');
            } else if (!$profile) {
                $sql = "Insert into $dbname.users (name, email, password,  isverified) values ('$name', '$email', '$password', '$otp')";
                if ($conn->query($sql) === TRUE) {
                    echo 'User created successfully';
                    setcookie('signedin', 'OK', time() + 2, '/');
                    header('Location:verify.php');
                } else {
                    echo 'Error: ' . $sql . '<br>' . $conn->error;
                }
            } else {
                $tmp_name = $_FILES['files']['tmp_name'];
                $uploadFolder = './uploads';
                $extension = pathinfo($profile, PATHINFO_EXTENSION);
                $filename = $name . "_" . $email . "." . $extension;
                $FileDest = $uploadFolder . "/" . $filename;
                if ($_FILES["files"]["name"] && $_FILES['files']['size'] == 0) {
                    echo 'File size is too big';
                    exit();
                }
                if (move_uploaded_file($tmp_name, $FileDest)) {
                    $sql = "insert into $dbname.users (name, email, password, imagepath, isverified) values ('$name', '$email', '$password', '$filename', '$otp')";
                    if ($conn->query($sql)) {
                        echo 'User Created Successfully';
                        setcookie('signedin', 'OK', time() + 2, '/');
                        header('Location:verify.php');
                    } else {
                        echo 'Error: ' . $sql . '<br>' . $conn->error;
                    }
                } else {
                    echo 'Error uploading';
                }
            }
        } else
            header('Location:signedup.php');
    } else if (strlen($password) < 6) {
        setcookie('short', 'OK', time() + 2, '/');
        header('Location:signedup.php');
    } else if ($password !== $cpassword) {
        setcookie('notmatch', 'OK', time() + 2, '/');
        header('Location:signedup.php');
    }


    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'checkmailphp1@gmail.com';
    $mail->Password   = 'qfjndipqdwtijtui';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;



    $mail->setFrom('checkmailphp1@gmail.com', 'rohit');

    $mail->addAddress($email);

    $mail->Subject = 'Verify With Us';


    $mail->isHTML(true);
    $mailContent = ' 
    <h2>Please Verify your Email</h2> 
    <p>This is your code' . "  " . $otp . '</p>';
    $mail->Body = $mailContent;
    
    if (!$mail->send()) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent.';
    }
}
