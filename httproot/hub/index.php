<?php
require('../db.php');
include("../auth_session.php");
include("header.php");
session_start();
?>
<?php
    if(array_key_exists('button2', $_POST)) { 
            redeem(); 
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
select::-ms-expand {
  display: none;
}

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

.select:hover::after {
  color: #8cd17c77;
}
        </style>
</head>
<div class="container">
<div class="con4" style="">
<h3 style="color: white; margin-top: 20px;">Profile</h3>
<p class="hi" style="margin-top: 20px;">UserID: <strong><?php echo htmlspecialchars($userid); ?></strong></p>
<?php
if ($rank == "100") {
  echo('<p class="hi" style="margin-top: 20px;">Rank: <strong style="color: red;">Admin</strong></p>');
}
?>
<?php
if ($sub == NULL) {
  echo('<p class="hi" style="margin-top: 20px;">Subscription: <strong>Unsubscribed</strong></p>');
}
?>
                            <?php
                            $query = "SELECT * FROM aplans WHERE userid = '$userid' ORDER BY `id` DESC";
 
 
 if ($result = $mysqli->query($query)) {
     while ($row = $result->fetch_assoc()) {
         $field1name = $row["type"];
         
         echo '<p class="hi" style="margin-top: 20px;">'. $field1name .': <strong>Active</strong></p>';
     }
     $result->free();
 } 
 ?>
<p class="hi" style="margin-top: 20px;">Credits: <strong><?php echo htmlspecialchars($credits); ?></strong></p>
<form class="form-style-9" method="post">
<center><div class="form-group" style="margin: 20px;">
    <span>Redeem Credits</span>
    <input class="form-field" id="redeem" name="redeem" type="text" placeholder="Credit Code">
</div></center>
<button type="submit" style="border: transparent;" name="button2" onclick="redeem()" id="nigger" class="myButton">Redeem</button>	
</div>
	</form>
<div class="con1" style="">
<form method="post">
				<ul>
				<li>
<?php 
$query = "SELECT * FROM news ORDER BY `id` DESC LIMIT 4";
 
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["title"];
        $field2name = $row["content"];
        
        echo '
                <div class="con">
				<h3 style="color: white;">' . $field1name . '</h3>
                <p style="color: #dfdeee;">' . $field2name . '</p>
                </div>';
    }
    $result->free();
} 
?>
</ul>
				</li>
				</form>
				</div>
</div>
</div>
<script type="text/javascript" src="script.js"></script>
<?php
function redeem() {
			global $credits;
      global $con;
      global $mysqli;
      global $webhook;
      global $domain;
			$user = $_SESSION['userid'];
			$code2 = $_POST['redeem'];
            $result = $mysqli->query("SELECT id FROM codes WHERE code = '$code2'");
            if($result->num_rows == 0) {
				die('<div class="container">
				<div class="con4" style="height: 120px;">
				<h3 style="color: white; margin-top: 16px;">Inavlid Credit Code.</h3><br>
				<a href="index.php">Retry</a>
				</div>
				</div>');
            } else {
				$query = "SELECT * FROM codes WHERE code = '$code2'";
				if ($result2 = $mysqli->query($query)) {
					while ($row = $result2->fetch_assoc()) {
						$creds = $row["credits"];

					$sql3 = "DELETE FROM codes WHERE code = '$code2'";
				    if(mysqli_query($con, $sql3)){
						}
					$credst = $credits + $creds;
					$sql = "UPDATE users SET credits='$credst' WHERE userid='$user'";
					if(mysqli_query($con, $sql)) {   	
            $timestamp = date("c", strtotime("now"));
$q = $rows + 1;
$json_data = json_encode([
  // Message
  //"content" => $username2 . " just joined the queue!",
  
  // Username
  //"username" => "COD Rank Division",

  // Avatar URL.
  // Uncoment to replace image set in webhook
  //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

  // Text-to-speech
  "tts" => false,

  // File upload
  // "file" => "",

  // Embeds Array
  "embeds" => [
      [
          // Embed Title
          "title" => "Credits Log",

          // Embed Type
         // "type" => "rich",

          // Embed Description
          "description" => $user . " just redeemed " . $creds . " Credits!",

          // URL of title link
          "url" => "https://" . $domain,

          // Timestamp of embed must be formatted as ISO8601
          "timestamp" => $timestamp,

          // Embed left border color in HEX
          "color" => hexdec( "3366ff" ),

          // Footer
          "footer" => [
              "text" => "Coded by capo",
              //"icon_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=375"
          ],

          // Image to send
          //"image" => [
           //   "url" => "https://cdn.discordapp.com/attachments/786072348830334988/786271495705329704/image0.png"
        //  ],

          // Thumbnail
          //"thumbnail" => [
          //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
          //],

          // Author
          //"author" => [
              //"name" => "capo",
            //  "url" => "https://verumanity.net"
          //],

          // Additional Fields array
          /*"fields" => [
               //Field 1
              [
                  "name" => $user,
                  "value" => "UserID",
                  "inline" => true
              ],
               //Field 2
              [
                  "name" => "  |",
                  "value" => "  |",
                  "inline" => true
              ],
              [
                  "name" => "Purchased " . $net,
                  "value" => $credits . " - " . $price . " = " . $credst,
                  "inline" => true
              ]
          ]*/
      ]
  ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );         


$ch = curl_init( $webhook );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$res = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close( $ch );	
						header("refresh: 1"); 			        
					}	
					}
					$result->free();
				} 


			}
}

    ?>