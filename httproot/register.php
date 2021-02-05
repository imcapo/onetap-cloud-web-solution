<?php
    require_once('environment.php');
    include('db.php');
    $site_key = $_ENV['SITE_KEY'];
     $secret_key = $_ENV['SECRET_KEY'];
     session_start();
     ?>
<?php
            
            $user = $_SESSION['userid'];
            $query = "SELECT * FROM `settings`";
      
      if ($result = $con->query($query)) {
    if ($row = $result->fetch_assoc()) {
        $webname = $row["name"];      
        $domain = $row["domain"];  
    }  
} 
if(isset($_SESSION["userid"])) {
  header('Location: https://'. $domain . '/hub');
  }
?>
<head>
<script src="https://www.google.com/recaptcha/api.js"></script>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<title>
<?php echo htmlspecialchars($webname); ?> | Register
</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<body id="particles-js"></body>
<?php
      if (isset($_POST['submit'])) {
      
          $response = $_POST['g-recaptcha-response'];
      
          $payload = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$response);
     
          $res = json_decode($payload, true);
   
          if ($res['success'] != 1) {
         
              $error = 'Sorry. Missing validation!!!';
          } else {
       
              $success = 'Thank you!';
          }
      }
    ?>
<?php
$n=30; 
function getName($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 

        $user2 = getName($n);
    require('db.php');

    if (isset($_REQUEST['password'])) {

        $password = stripslashes($_REQUEST['password']);
        $password = htmlspecialchars($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        
        if (strlen($_POST["password"]) <= '6') {
            die("Your Password Must Contain At Least 6 Characters!");
        }
        elseif (strlen($_POST["password"]) >= '15') {
            die("Max lenght of a password is 15.");
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            die("Your Password Must Contain At Least 1 Number!");
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            die("Your Password Must Contain At Least 1 Capital Letter!");
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            die("Your Password Must Contain At Least 1 Lowercase Letter!");
        } else {
        echo "";
        }

    
        
  	$sql_u = "SELECT * FROM users WHERE userid='$user2'";
  	$res_u = mysqli_query($con, $sql_u);

  	if (mysqli_num_rows($res_u) > 0) {
  	  die("<center><div class='form'>
                  <h3>Username already in use.</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
                  </div></center>"); 	
  	} else {

        $query    = "INSERT into `users` (userid, password)
                     VALUES ('$user2', '" . md5($password) . "')";
        $result   = mysqli_query($con, $query);

        if ($result) {
            echo '<center><div class="form">
            <h3 style="margin-top: 300px; color: white;">You are registered successfully. <3</h3><br/>
            <h3 style="color: white;><strong>USERID: '.$user2.'</strong></h3><br/>
            <p style="color: white; class="link">Click here to <a href="index.php">Login</a></p>
            </div></center>';
        } else {
            echo "<center><div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
                  </div></center>";
        }

    } 
    }else {
?>
<div class="animated bounceInDown">
  <div style="height: 500px;" class="container">
    <span class="error animated tada" id="msg"></span><br>
    <form name="form1" class="box" onsubmit="return checkStuff()" method="post">
      <h4 style="font-size: 25px;">ONETAP<span>API</span></h4>
      <h5>Create an account.</h5>
        <i class="typcn typcn-eye" id="eye"></i>
        <input type="password" style="margin-bottom: 5px;" name="password" placeholder="Passsword" id="pwd" autocomplete="off">
        <a href="#" style="margin-bottom: 5px;">Don't Forget to save you're UserID after Registration!</a>
        <center><div class="g-recaptcha" style="margin-top: 15px;" data-theme="dark" data-callback="captchaVerified" data-expired-callback="captchaExpired" data-sitekey=<?php echo $site_key; ?>></div></center><br>
        <button class="btn1" type="submit" value="Sign in" id="submit" disabled> Sign up</button>
      </form>
        <a href="index.php" class="dnthave">Already have an account? Sign in</a>
  </div> 
  <?php
    }
?>
  <?php if (isset($_POST["submit"])): ?>

          <?php if (!empty($success)): ?>
  
          <div class="alert alert-success" role="alert">
            <strong>
              <?php echo $success; ?></strong>
          </div>
          <?php else: ?>
     
          <div class="alert alert-danger" role="alert">
            <strong>
              <?php echo $error; ?></strong>
          </div>
          <?php endif; ?>
          <?php endif; ?>
       <div class="footer">
      <span>Made with <i class="fa fa-heart pulse"></i><a href="https://www.youtube.com/c/capomodding"> By capo</a></span>
    </div>
</div>
<script type="text/javascript" src="script2.js"></script>
<script>
  
      function captchaVerified() {
        var submitBtn = document.getElementById('submit');
        submitBtn.removeAttribute('disabled');
      }
  
      function captchaExpired() {
        window.location.reload();
      }

    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script>
  function copyToClipboard(text) {
    window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
  }
</script>
