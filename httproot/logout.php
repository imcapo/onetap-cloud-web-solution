<?php
    require_once('environment.php');
    include('db.php');

    session_start();

            
            $user = $_SESSION['userid'];
            $query = "SELECT * FROM `settings`";
      
      if ($result = $con->query($query)) {
    if ($row = $result->fetch_assoc()) {
        $webname = $row["name"];      
        $domain = $row["domain"];  
    }  
} 

    if(session_destroy()) {
        header("Location: https://". $domain . "/index.php");
    }
?>