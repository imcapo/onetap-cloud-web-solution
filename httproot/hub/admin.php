<?php
require('../db.php');
include("../auth_session.php");
include("header.php");
session_start();
?>
<?php
if ($rank != "100") {
    die('<center><div class="container">
    <div class="con4" style="height: 120px; border-top: 6px solid red; border-bottom: 6px solid red;">
    <h3 style="color: white; margin-top: 16px;">Internal Error: You are not authentificated!</h3><br>
    <a href="index.php">Home</a>
    </div>
    </div></center>');
}
?>

<head>
<link rel="stylesheet/less" type="text/css" href="styles.less" />
<script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
select {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  appearance: none;
  outline: 0;
  box-shadow: none;
  border: 0 !important;
  background: black;
  background-image: none;
}
/* Remove IE arrow */
select::-ms-expand {
  display: none;
}
/* Custom Select */
.select {
  position: relative;
  display: flex;
  width: 20em;
  height: 3em;
  line-height: 3;
  background: #5e9452;
  overflow: hidden;
  border-radius: .25em;
}
select {
  flex: 1;
  padding: 0 .5em;
  color: white;
  cursor: pointer;
  background: #8cd17c77;
}
/* Arrow */
.select::after {
  content: '\25BC';
  position: absolute;
  top: 0;
  right: 0;
  padding: 0 1em;
  background: #5e9452;
  cursor: pointer;
  pointer-events: none;
  -webkit-transition: .25s all ease;
  -o-transition: .25s all ease;
  transition: .25s all ease;
}
/* Transition */
.select:hover::after {
  color: #8cd17c77;
}
        </style>
</head>
<?php
    if(array_key_exists('button1', $_POST)) { 
            stop(); 
        } 
    if(array_key_exists('button2', $_POST)) { 
            update(); 
        }
    if(array_key_exists('button6', $_POST)) { 
          product(); 
      }
    if(array_key_exists('button5', $_POST)) { 
          news(); 
    }
    if(array_key_exists('button4', $_POST)) { 
      del(); 
}
        ?>
<div class="container">
<div class="con4" style="height: 1150px;">
<h3 style="color: white; margin-top: 20px;">Admin</h3><br>
<form method="post">
<center><div class="form-group">
    <span>Website Name</span>
    <input class="form-field" id="webn" name="webn" type="text" placeholder="Enter Website Name">
</div>
<div class="form-group">
    <span>Ban User</span>
    <input class="form-field" id="ban" name="ban" type="text" placeholder="Enter UserID">
</div>
<div class="form-group">
    <span>Remove Subscription</span>
    <input class="form-field" id="rmv" name="rmv" type="text" placeholder="Enter UserID">
</div>
<div class="form-group">
<span>Discord Webhook</span>
    <input class="form-field" id="whook" name="whook" type="text" placeholder="Enter Webhook for Log Channel">
</div>
<button type="submit" style="border: transparent;" name="button2" onclick="update()" id="nigger" class="myButton">Submit</button>	
<h3 style="color: white; margin-top: 20px;">Create Product</h3><br>
<div class="select" style="margin-bottom: 10px;">
													<select style="background: ;" onchange="price()" class="" id="slct" name="slct" size="1">
														<optgroup label="Type">
         <option value="config">Config</option>
         <option value="script">Script</option>
														</optgroup>

													</select></div>
<div class="form-group">
    <span>Product Name</span>
    <input class="form-field" id="pname" name="pname" type="text" placeholder="Enter Product Name">
</div>
                          <div style="margin-top: 15px;" class="form-group">
    <span>Onetap CFG/Script ID</span>
    <input class="form-field" id="otid" name="otid" type="text" placeholder="Enter Onetap CFG/SCRIPT ID">
</div>
                          <div style="margin-top: 15px;" class="form-group">
    <span>Product Price</span>
    <input class="form-field" id="price" name="price" type="text" placeholder="Enter Product Price (Example: 5)">
</div>
                          <button type="submit" style="border: transparent;" name="button6" onclick="update()" id="nigger" class="myButton">Create Product</button>	
                          <h3 style="color: white; margin-top: 20px;">Create News</h3><br>
<div class="form-group">
    <span>News Title</span>
    <input class="form-field" id="title" name="title" type="text" placeholder="Enter News Content">
</div>
                          <div style="margin-top: 15px;" class="form-group">
    <span>News Content</span>
    <input class="form-field" id="content" name="content" type="text" placeholder="Enter Onetap CFG/SCRIPT ID">
</div>
                          <button type="submit" style="border: transparent;" name="button5" onclick="news()" id="nigger" class="myButton">Create News</button>	
</form>
</center>
</div>
<div class="con1" style="">
<form method="post">
				<ul>
				<li>
<?php 

$query = "SELECT * FROM products ORDER BY `id` DESC LIMIT 20";
 
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $host = $row["name"];
        $type = $row["type"];
        echo '
                <div class="con">
				<h3 style="color: white;">' . $host . ' ['.$type.']</h3>
        <button type="submit" value="' . $id . '" name="button1" onclick="stop()" id="nigger" style="margin-bottom: 10px; background: #bf3434; border-color: #bf3434;" class="myButton2">Delete</button>	
                </div>
                ';
        }
    }
    $result->free();
?>
<?php 

$query = "SELECT * FROM news ORDER BY `id` DESC LIMIT 20";
 
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $host = $row["title"];
        echo '
                <div class="con">
				<h3 style="color: white;">' . $host . ' [news]</h3>
        <button type="submit" value="' . $id . '" name="button4" onclick="stop()" id="nigger" style="margin-bottom: 10px; background: #bf3434; border-color: #bf3434;" class="myButton2">Delete</button>	
                </div>
                ';
        }
    }
    $result->free();
?>
</ul>
				</li>
				</form>
				</div>
</div>
</div>
<script type="text/javascript" src="script.js"></script>
<?php
function update() {
    $user = $_SESSION['userid'];
    $userr = $_POST['rmv'];
    $webname = $_POST['webn'];
    $whook = $_POST['whook'];
    $userr2 = $_POST['ban'];
global $mysqli;

    if ($webname != NULL) {
        $sql3 = "UPDATE settings SET name='$webname'";
        if($mysqli->query($sql3)){
          echo('<div class="container">
          <div class="con4" style="height: 120px;">
          <h3 style="color: white; margin-top: 16px;">Update Websitename to: '.$webname.'</h3><br>
          <a href="admin.php">Return</a>
          </div>
          </div>');
          header("refresh: 1"); 
      } else {
        die('<div class="container">
        <div class="con4" style="height: 120px;">
        <h3 style="color: white; margin-top: 16px;">An error occured.</h3><br>
        <a href="panel.php">Retry</a>
        </div>
        </div>');
      }
    }


    if ($userr2 != NULL) {
        $sql3 = "UPDATE users SET ban='yes' WHERE userid='$userr2'";
        if($mysqli->query($sql3)){
          echo('<div class="container">
          <div class="con4" style="height: 120px;">
          <h3 style="color: white; margin-top: 16px;">Banned user: '.$userr2.'</h3><br>
          <a href="admin.php">Return</a>
          </div>
          </div>');
          header("refresh: 1"); 
      } else {
        die('<div class="container">
        <div class="con4" style="height: 120px;">
        <h3 style="color: white; margin-top: 16px;">An error occured.</h3><br>
        <a href="panel.php">Retry</a>
        </div>
        </div>');
      }
    }

    if ($whook != NULL) {
      $sql3 = "UPDATE settings SET discwebhook='$whook'";
      if($mysqli->query($sql3)){
        echo('<div class="container">
        <div class="con4" style="height: 120px;">
        <h3 style="color: white; margin-top: 16px;">Set Webhook: '.$whook.'</h3><br>
        <a href="admin.php">Return</a>
        </div>
        </div>');
        header("refresh: 1"); 
    } else {
      die('<div class="container">
      <div class="con4" style="height: 120px;">
      <h3 style="color: white; margin-top: 16px;">An error occured.</h3><br>
      <a href="panel.php">Retry</a>
      </div>
      </div>');
    }
  }


    if ($userr != NULL) {
            $sql3 = "DELETE FROM aplans WHERE userid='$userr'";
            if($mysqli->query($sql3)){
              echo('<div class="container">
              <div class="con4" style="height: 120px;">
              <h3 style="color: white; margin-top: 16px;">Plan removed from user: '.$userr.'</h3><br>
              <a href="admin.php">Return</a>
              </div>
              </div>');
              header("refresh: 1"); 
          } else {
            die('<div class="container">
            <div class="con4" style="height: 120px;">
            <h3 style="color: white; margin-top: 16px;">An error occured.</h3><br>
            <a href="panel.php">Retry</a>
            </div>
            </div>');
          }
        }

$mysqli->close();
}
?>
<?php
function stop() {
    $user = $_SESSION['userid'];
    $stop = $_POST['button1'];
global $mysqli;
$query = "SELECT * FROM products WHERE id='$stop'";
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"]; 

            $sql3 = "DELETE FROM products WHERE id='$id'";
            if($mysqli->query($sql3)){
              echo('<div class="container">
              <div class="con4" style="height: 120px;">
              <h3 style="color: white; margin-top: 16px;">Product successfully deleted.</h3><br>
              <a href="panel.php">Return</a>
              </div>
              </div>');
          } else {
            die('<div class="container">
            <div class="con4" style="height: 120px; position: absolute; right: 100px;">
            <h3 style="color: white; margin-top: 16px;">Something went wrong...</h3><br>
            <a href="panel.php">Retry</a>
            </div>
            </div>');
          }
}

}
$mysqli->close();
}
?>
<?php
function del() {
    $user = $_SESSION['userid'];
    $stop = $_POST['button4'];
global $mysqli;
$query = "SELECT * FROM news WHERE id='$stop'";
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"]; 

            $sql3 = "DELETE FROM products WHERE id='$id'";
            if($mysqli->query($sql3)){
              echo('<div class="container">
              <div class="con4" style="height: 120px;">
              <h3 style="color: white; margin-top: 16px;">News successfully deleted.</h3><br>
              <a href="panel.php">Return</a>
              </div>
              </div>');
          } else {
            die('<div class="container">
            <div class="con4" style="height: 120px; position: absolute; right: 100px;">
            <h3 style="color: white; margin-top: 16px;">Something went wrong...</h3><br>
            <a href="panel.php">Retry</a>
            </div>
            </div>');
          }
}

}
$mysqli->close();
}
?>
<?php
function product() {
  $price = $_POST['price'];
  $pname = $_POST['pname'];
  $type = $_POST['slct'];
  $otid = $_POST['otid'];
  global $con;
  global $mysqli;

  $sql3 = "INSERT INTO products (name, price, otid, type) VALUES ('$pname', '$price', '$otid', '$type')";
  if($mysqli->query($sql3)){
    header("refresh: 1"); 
} else {
  die('<div class="container">
  <div class="con4" style="height: 120px;">
  <h3 style="color: white; margin-top: 16px;">An error occured.</h3><br>
  <a href="panel.php">Retry</a>
  </div>
  </div>');
}



}
?>
<?php
function news() {
  $title = $_POST['title'];
  $content = $_POST['content'];
  global $con;
  global $mysqli;

  $sql3 = "INSERT INTO news (title, content) VALUES ('$title', '$content')";
  if($mysqli->query($sql3)){
    header("refresh: 1"); 
} else {
  die('<div class="container">
  <div class="con4" style="height: 120px;">
  <h3 style="color: white; margin-top: 16px;">An error occured.</h3><br>
  <a href="panel.php">Retry</a>
  </div>
  </div>');
}



}
?>