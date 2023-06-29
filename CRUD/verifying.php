<?php  
    include('conn.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['email'];
        $otp = $_POST['otp'];
        if(!(strlen((string)$otp) == 6)){
            setcookie('otpformat', 'true', time()+2, '/');
            header('location:verify.php');
            exit();
        }
        $sql = "select * from $dbname.users where email = '$email'";
        $result = $conn->query($sql);
        $row   = $result->fetch_assoc();
        $verifiedotp = $row['isverified'];
        if($result->num_rows === 0){
            setcookie('emailnotregister', 'true', time()+2, '/');
            
        }
        
        elseif($verifiedotp == 1){
            setcookie('alreadyverified', 'true', time()+2, '/');
        }
        elseif($verifiedotp == $otp){
            $sql = "Update $dbname.users set isverified = 1 where email = '$email'";
            $result = $conn->query($sql);
            setcookie('verified', 'true', time()+2, '/');
            header('Location:signedin.php');
            exit();
        }
        else{
            setcookie('otpnotmatched', 'true', time()+2, '/');
            
        }
        
        header('location:verify.php');
        exit();
    }


?>