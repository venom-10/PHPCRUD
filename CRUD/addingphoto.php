<?php
include('conn.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_COOKIE['email']) {
        $data = $_POST['image'];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $id =  $_COOKIE['photoid'];
        $sql = "select * from $dbname.userdetails where id ='$id'";
        $row = $conn->query($sql);
        $result = $row->fetch_assoc();
        $username = $result['name'];
        $useremail = $result['email'];
        $image_name = 'Uploads/' . $username . "_" . $useremail . '.png';
        $filename = $username . "_" . $useremail . '.png';
        file_put_contents($image_name, $data);

        if ($name && $_FILES['files']['size'] == 0) {
            echo 'File size is too big';
            exit();
        }


        $sql = "UPDATE $dbname.userdetails SET imagepath='$filename' WHERE id='$id'";
        if ($conn->query($sql)) {
            setcookie('upload', 'uploaded', time() + 2, '/');
            header('Location:index.php');
        }
        echo 'successfully save : )';
    } else {
        echo 'Please Log in first to update your profile<br>';
    }
} else {
    echo 'Wrong Method';
}
