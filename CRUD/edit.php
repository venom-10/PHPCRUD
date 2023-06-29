<?php  

include('conn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_COOKIE['email'])) {
        $state = $_POST['state'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];  // gender value can be default
        // if any of the fields are not empty update accordingly
        if(!empty($state)){
            $sql = "UPDATE $dbname.userdetails SET state='$state' WHERE id='$_COOKIE[id]'";
            $conn->query($sql);
        }
        if(!empty($address)){
            $sql = "UPDATE $dbname.userdetails SET address='$address' WHERE id='$_COOKIE[id]'";
            $conn->query($sql);
        }
        if(!empty($gender) && $gender != 'default'){
            $sql = "UPDATE $dbname.userdetails SET gender='$gender' WHERE id='$_COOKIE[id]'";
            $conn->query($sql);
        }
        setcookie('edit', 'OK', time()+2, '/');
        header('location: index.php');
    }
    else{
        setcookie('notlogin', 'OK', time()+2, '/');
        header('location: index.php');
    }
}
else{
    echo 'not post';
}
