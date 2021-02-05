<?php
    $con = mysqli_connect("localhost","username","password","capo");
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $mysqli = new mysqli("localhost", "username", "password", "capo"); 
    $odb = new PDO('mysql:host=localhost;dbname=capo', 'username', 'password');
$XApiId = "id";
$XApiKey = "key";
$XApiSecret = "secret";
?>
