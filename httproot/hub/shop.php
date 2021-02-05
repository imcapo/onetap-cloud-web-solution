<?php
require('../db.php');
include("../auth_session.php");
include("header.php");
session_start();
?>
<?php
    if(array_key_exists('button2', $_POST)) { 
            buy(); 
        } 
    if(array_key_exists('button1', $_POST)) { 
            price(); 
        } 
        ?>
<head>
<link rel="stylesheet/less" type="text/css" href="styles2.less" />
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
  background: rgba(255, 255, 255, 0.314);
  overflow: hidden;
  border-radius: .25em;
}
select {
  flex: 1;
  padding: 0 .5em;
  color: white;
  cursor: pointer;
  background-color: rgb( 33, 41, 66 );
  border-top: 3px solid rgb( 33, 41, 66 );
}
/* Arrow */
.select::after {
  content: '\25BC';
  position: absolute;
  top: 0;
  right: 0;
  padding: 0 1em;
  background: rgba(255, 255, 255, 0.08);
  cursor: pointer;
  pointer-events: none;
  -webkit-transition: .25s all ease;
  -o-transition: .25s all ease;
  transition: .25s all ease;
}
/* Transition */
.select:hover::after {
    background: rgba(255, 255, 255, 0.08);
}
        </style>
</head>

<div class="con6" style="height: 470px;">
<form method="post">
<h3 style="color: white; margin-top: 20px;">Shop</h3>
<p class="hi" style="margin-top: 20px;">Available Credits: <strong><?php echo htmlspecialchars($credits); ?></strong></p>

<center>	<div class="length range__slider" data-min="1" data-max="12">
		<div class="length__title field-title" data-length='1'>Months: </div>
		<input id="slider1" type="range" name="time" min="1" max="12" value="1" onchange="price()" />
    </div></center>
    <center>     <div class="select">
													<select style="background: ;" onchange="price()" class="" id="slct" name="slct" size="1">
														<optgroup label="Products">
                            <?php
                            $query = "SELECT * FROM products ORDER BY `id` DESC";
 
 
 if ($result = $mysqli->query($query)) {
     while ($row = $result->fetch_assoc()) {
         $field1name = $row["name"];
         $field2name = $row["price"];
         
         echo '
         <option value="' . $field1name . '">' . $field1name . ' [' . $field2name . ' Credits]</option>';
     }
     $result->free();
 } 
 ?>

														</optgroup>

													</select></div></center>
<button type="submit" name="button2" id="nigger" style="background: #79a6fe; border-color: #79a6fe;" class="myButton">Purchase</button>	
<!--  <button type="submit" name="button1" id="nigger" style="background: transparent;" class="myButton">Check Price</button>--> 
<div style="font-weight: 600; font-size: 21px;" id="totalPrice"></div>
    </form>  
    <button style="background: transparent; border: transparent; color: #79a6fe; margin-top: 20px;" class="js-textareacopybtn" style="font-size: 14px;"> No refunds given.</button>
</div>
<div class="footer">
      <span>Made with <i class="fa fa-heart pulse"></i><a href="https://www.youtube.com/c/capomodding"> By capo</a></span>
    </div>
<script type="text/javascript" src="script.js"></script>
<?php
function buy() {
			global $credits;
      global $con;
      global $mysqli;
      global $odb;
      global $webhook;
      global $domain;
      global $XApiId;
      global $XApiKey;
      global $XApiSecret;
      
			$user = $_SESSION['userid'];
            $time = $_POST['time'];
            $net = $_POST['slct'];

            $query2 = "SELECT * FROM products WHERE name = '$net'";
 
 
if ($result = $mysqli->query($query2)) {
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $price1 = $row["price"];
        $otid = $row["otid"];
        $type = $row["type"];
    }
    $result->free();
} 
            $price = $time * $price1;

            if ($user != "nigger") {
                $SQL = $odb->prepare("SELECT COUNT(*) FROM `aplans` WHERE `userid` = '$user' AND type = '$name'");
                $SQL -> execute(array());
                $countRunningH = $SQL -> fetchColumn(0);
                if ($countRunningH > 0) {
                  die('<div class="container">
                  <div class="con4" style="height: 120px;">
                  <h3 style="color: white; margin-top: 12px;">You already own this product!</h3><br>
                  <a href="shop.php">Retry</a>
                  </div>
                  </div>');
                }
                }


            if ($credits >= $price) {
                    
            $credst = $credits - $price;
                    
					$sql = "UPDATE users SET credits='$credst' WHERE userid='$user'";
					if(mysqli_query($con, $sql)) {   				        
                    }	
                    
                    $lenght = 2628000 * $time;
                    $end = time() + $lenght;
					$sql2 = "INSERT INTO aplans (userid, sub, type, expiry) VALUES ('$user', '1', '$name', '$end')";
					if(mysqli_query($con, $sql2)) {   
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
          "title" => "Purchase Log",

          // Embed Type
         // "type" => "rich",

          // Embed Description
          "description" => $user . " just purchased " . $name,

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

if ($type == "config") {
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.onetap.com/cloud/configs/'.$otid.'/invites/?max_age=5&max_uses=1',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'application%2Fx-www-form-urlencoded=&',
  CURLOPT_HTTPHEADER => array(
    'X-Api-Id: ee7afc2b23d14fac42d4f70d7b0d0712',
    'X-Api-Secret: 262bb53c99b81fd8921029df4e602dcf2e9a26ae8211d9e730be94412521cc4c',
    'X-Api-Key: wiZnN48EjUatI9L_ByX0nPOYNJ6sgoS_',
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);
$data = json_decode($response);

$invitecode = $data->invite->code;
$invite = "https://www.onetap.com/account/configs/invites/" . $invitecode . "/accept";
curl_close($curl); 

die('<div class="container">
<div class="con4" style="height: 120px; width: 1000px;">
<h3 style="color: white; margin-top: 16px;">ATTENTION! Use it now or it expires: </h3> <input type="text" value="'.$invite.'" id="myInput">
<button onclick="myFunction()">Copy text</button><br>
<a href="index.php">Home</a>
</div>
</div> <script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>');
									        
					} else {


            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.onetap.com/cloud/scripts/'.$otid.'/invites/?max_age=5&max_uses=1',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => 'application%2Fx-www-form-urlencoded=&',
              CURLOPT_HTTPHEADER => array(
                'X-Api-Id: ' . $XApiId,
                'X-Api-Secret: ' . $XApiSecret,
                'X-Api-Key: ' . $XApiKey,
                'Content-Type: application/x-www-form-urlencoded'
              ),
            ));
            
            $response = curl_exec($curl);
            $data = json_decode($response);
            
            $invitecode = $data->invite->code;
            $invite = "https://www.onetap.com/account/scripts/invites/" . $invitecode . "/accept";
            curl_close($curl);
            
            die('<div class="container">
            <div class="con4" style="height: 120px; width: 1000px;">
            <h3 style="color: white; margin-top: 16px;">ATTENTION! Use it now or it expires: </h3> <input type="text" value="'.$invite.'" id="myInput">
            <button onclick="myFunction()">Copy text</button><br>
            <a href="index.php">Home</a>
            </div>
            </div> <script>
            function myFunction() {
              var copyText = document.getElementById("myInput");
              copyText.select();
              copyText.setSelectionRange(0, 99999)
              document.execCommand("copy");
              alert("Copied the text: " + copyText.value);
            }
            </script>');

          }
        }	

            } else {
                die('<div class="container">
                <div class="con4" style="height: 120px;">
                <h3 style="color: white; margin-top: 16px;">Insufficient Funds! Price: '.$price.'</h3><br>
                <a href="shop.php">Retry</a>
                </div>
                </div>');
            }

			
}

    ?>
<?php
    function price() {
        global $credits;
        $user = $_SESSION['userid'];
        $time = $_POST['time'];
        $net = $_POST['slct'];

        $price = $time * $net;

            die('<div class="container">
            <div class="con4" style="height: 120px;">
            <h3 style="color: white; margin-top: 16px;">Insufficient Funds! Price: '.$price.'</h3><br>
            <a href="shop.php">Retry</a>
            </div>
            </div>');
        

        
}

?>
<script type="text/javascript" src="script2.js"></script>
