<?php 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $filter = $_POST['filter'];
    setcookie('filter', 'true', time()+5,'/');
    if($filter === 'name'){
        setcookie('filterbyname', 'true', time()+3600, '/');
        setcookie('filterbyemail', '', time()-3600, '/');
        setcookie('filterbyaddress', '', time()-3600, '/');
    }
    else if($filter === 'email'){
        setcookie('filterbyemail', 'true', time()+3600, '/');
        setcookie('filterbyname', '', time()-3600, '/');
        setcookie('filterbyaddress', '', time()-3600, '/');
    }
    else{
        setcookie('filterbyaddress', 'true', time()+3600, '/');
        setcookie('filterbyname', '', time()-3600, '/');
        setcookie('filterbyemail', '', time()-3600, '/');
    }
    header('location:index.php');
}


?>