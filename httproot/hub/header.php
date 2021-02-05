<?php
require('../db.php');
include("../auth_session.php");
session_start();
$userid = $_SESSION["userid"];
?>
<?php
                        $user = $_SESSION['userid'];
                        $query = "SELECT * FROM `settings`";
                  
                  if ($result = $con->query($query)) {
                if ($row = $result->fetch_assoc()) {
                    $webname = $row["name"];      
                    $domain = $row["domain"];  
                    $webhook = $row["discwebhook"];  
                }  
            } 
            
            $user = $_SESSION['userid'];
            $query = "SELECT * FROM `aplans` WHERE userid='$user'";
      
      if ($result = $con->query($query)) {
    if ($row = $result->fetch_assoc()) {
        $sub = $row["sub"];
        $type = $row["type"];         
    }  
} 
$user = $_SESSION['userid'];
$query2 = "SELECT * FROM `users` WHERE userid='$user'";

if ($result2 = $con->query($query2)) {
if ($row2 = $result2->fetch_assoc()) {
$userid = $row2["userid"];
$credits = $row2["credits"];
$rank = $row2["rank"];
$ban = $row2["ban"];
}  
} 
?>
<?php
if ($ban == "yes") {
  die("banned :)");
  header('Location: https://' . $domain . '/logout.php');
}
?>
<?php 
$query = "SELECT * FROM aplans WHERE userid = '$user'";
 
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $end = $row["expiry"];
        $t = time();
        if ($t > $end) {
          $sql3 = "DELETE FROM aplans WHERE userid='$user'";
          if(mysqli_query($con, $sql3)){
        }
        }
    }
    $result->free();
} 
?>
<head>
<script src="https://www.google.com/recaptcha/api.js"></script>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<title>
<?php echo htmlspecialchars($webname); ?> | Hub
</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<body class="body" id="particles-js"></body>
<div class="animated bounceInDown">
  <nav>
  <a class="link-2" href="index.php">Home</a>
  <a class="link-2" href="shop.php">Shop</a>
  <a class="link-2" href="../logout.php">Logout</a>
  <?php
  if ($rank == "100") {
    echo('<a style="color: red;" class="link-2" href="admin.php">Admin</a>');
  }
  ?>
</nav>
  </div>
  <div class="footer">
      <span>Made with <i class="fa fa-heart pulse"></i><a href="https://www.youtube.com/c/capomodding"> By capo</a></span>
    </div>
    <script type="text/javascript" src="script.js"></script>