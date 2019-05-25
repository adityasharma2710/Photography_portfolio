<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "isk_mnk";
    
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    if(!$conn){
        die("Database Not Connected : ". mysqli_connect_error());
    } else {
        echo "Database connected !!!";
    }
?>