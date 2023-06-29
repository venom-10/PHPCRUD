<?php  
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo 'this';
        setcookie('filterbyname','',time()-3,'/');
        setcookie('filterbyaddress','',time()-3,'/');
        setcookie('filterbyemail','',time()-3,'/');
        setcookie('searchbyname','',time()-3,'/');
        setcookie('page',0,time()+3600*24,'/');
        header('location:index.php');
    }

?>