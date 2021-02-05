<?php

include('db.php');
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    session_start();
            $query = "SELECT * FROM `settings`";
      
      if ($result = $con->query($query)) {
    if ($row = $result->fetch_assoc()) {
        $webname = $row["name"];      
        $domain = $row["domain"];  
    }  
} 
    if(!isset($_SESSION["userid"])) {
        header('Location: https://'. $domain . '/index.php');
        exit();
    }
?>