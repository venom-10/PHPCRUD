<?php 
    include('conn.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if($_COOKIE['email']){
            $email = $_COOKIE['email'];
            $name = $_FILES["files"]["name"];
            $tmp_name = $_FILES['files']['tmp_name'];
            $uploadFolder = './uploads';
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $filename = $_COOKIE['name']."_".$_COOKIE['email'].".".$extension;
            $FileDest = $uploadFolder."/".$filename;
            
            if($name && $_FILES['files']['size'] == 0){
                echo 'File size is too big';
                exit();
            }

            if(move_uploaded_file($tmp_name, $FileDest)){
                $sql = "UPDATE $dbname.users SET imagepath='$filename' WHERE email='$email'";
                if($conn->query($sql)){
                    setcookie('upload', 'uploaded', time()+2, '/');
                    echo 'Your Profile Just Updated';
                    header('Location:index.php');
                }
                echo 'successfully save :)';
            }else{
                echo 'Error uploading';
            }

        }
        else{
            echo 'Please Log in first to update your profile<br>';
        }
    }
    else{
        echo 'Wrong Method';
    }
?>