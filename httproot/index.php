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
<?php echo htmlspecialchars($webname); ?> | Login
</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<body id="particles-js"></body>
<?php
      if (isset($_POST['submit'])) {
          // reCAPTCHA response on submitting the form
          $response = $_POST['g-recaptcha-response'];
          // remoteip param is optional
          $payload = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$response);
          // Decoding JSON response from Google. TRUE param for assoc. array
          $res = json_decode($payload, true);
          // Checking payload response
          if ($res['success'] != 1) {
              // Failure case
              $error = 'Sorry. Missing validation!!!';
          } else {
              // Success case
              $success = 'Thank you!';
          }
      }
    ?>
 <?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['email'])) {
        $user = stripslashes($_REQUEST['email']);    // removes backslashes
        $user = mysqli_real_escape_string($con, $user);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        
            
            $query2 = "SELECT * FROM `users` WHERE ban='yes' AND userid='$user'";
      
      if ($result = $con->query($query2)) {
    if ($row = $result->fetch_assoc()) {
        $ban = $row["userid"];
        $id = $row["id"];
        

        
    }
    
} 
 if($ban == $user) {
  die("<h1>YOU ARE BANNED</h1>");
 }

        $query    = "SELECT * FROM `users` WHERE userid='$user'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['userid'] = $user;
            // Redirect to user dashboard page
            header('Location: https://' . $domain . '/hub');
        } else {
            echo "<center><div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='index.php'>Login</a> again.</p>
                  </div></center>";
        }
    } else {
?>
<div class="animated bounceInDown">
  <div class="container">
    <span class="error animated tada" id="msg"></span><br>
    <form name="form1" class="box" onsubmit="return checkStuff()" method="post">
      <h4 style="font-size: 25px;">ONETAP<span>API</span></h4>
      <h5>Sign in to your account.</h5>
        <input type="text" name="email" placeholder="User-ID" autocomplete="off">
        <i class="typcn typcn-eye" id="eye"></i>
        <input type="password" name="password" placeholder="Passsword" id="pwd" autocomplete="off">
        <center><div class="g-recaptcha" data-theme="dark" data-callback="captchaVerified" data-expired-callback="captchaExpired" data-sitekey=<?php echo $site_key; ?>></div></center><br>
        <label>
          <input type="checkbox" required>
          <span></span>
          <small class="rmb">Accept ToS</small>
        </label>
        <a href="#" class="forgetpass">Forget Password?</a>
        <br>
        <br>
        <button class="btn1" type="submit" value="Sign in" id="submit" disabled> Sign in</button>
      </form>
        <a href="register.php" class="dnthave">Don’t have an account? Sign up</a>
  </div> 
  <?php
    }
?>
  <?php if (isset($_POST["submit"])): ?>
          <!-- Displaying validation status -->
          <?php if (!empty($success)): ?>
          <!-- Success case -->
          <div class="alert alert-success" role="alert">
            <strong>
              <?php echo $success; ?></strong>
          </div>
          <?php else: ?>
          <!-- Failure case -->
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
<script type="text/javascript" src="script.js"></script>
<script>
      // Verification function
      function captchaVerified() {
        var submitBtn = document.getElementById('submit');
        submitBtn.removeAttribute('disabled');
      }
      // reCAPTCHA Expired callback function
      function captchaExpired() {
        window.location.reload();
      }

    </script>
    <script src="assets/js/jquery.min.js"></script>