<?php 
    $hostname ='localhost';
    $username ='root';  
    $password ='Root@123';
    $conn = mysqli_connect($hostname, $username, $password);
    if(!$conn){
        echo 'Connection error: '. mysqli_connect_error();
    }
    else{
        echo 'Connection successfull';
    }
    // $sql = 'create database rohitcrud';
    // if($conn->query($sql) === TRUE){
    //     echo "Database created successfully\n";
    // } else {
    //     echo "Error creating database: " . $conn->error. "\n";
    // }
    // change datatype of column
    // $sql = 'alter table rohitcrud.users modify column image varchar(255)';
    // $sql = 'ALTER TABLE rohitcrud.users
    // RENAME COLUMN image TO imagepath';
    
    // $sql = ''
    // $sql = 'Truncate table rohitcrud.users';
    // create table userdetails column name, email, state, address
    // $sql = 'create table rohitcrud.userdetails (
    //     id int(11) auto_increment primary key, 
    //     name varchar(255), email varchar(255), 
    //     state varchar(255), 
    //     address varchar(255))';
    // if($conn->query($sql) === TRUE){
    //     echo "Table created successfully\n";
    // } else {
    //     echo "Error creating table: " . $conn->error. "\n";
    // }
?>