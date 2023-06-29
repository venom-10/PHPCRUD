<?php
include('conn.php');
if(isset($_POST['image']))
{
    if($_COOKIE['name']){
        $email = $_COOKIE['email'];
        $data = $_POST['image'];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = 'uploads/' . $_COOKIE['name']."_".$_COOKIE['email']. '.png';
        $filename = $_COOKIE['name']."_".$_COOKIE['email']. '.png';
        file_put_contents($image_name, $data);
        $sql = "UPDATE $dbname.users SET imagepath='$filename' WHERE email='$email'";
        if($conn->query($sql)){
            setcookie('upload', 'uploaded', time()+5, '/');
            header('location:index.php');
        }
        else{
            echo 'Error uploading';
        }
        echo $image_name;
    }
}
?>
