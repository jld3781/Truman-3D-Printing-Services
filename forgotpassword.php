<?php
  # Samuel Livingston
  session_start();
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  define('USERS_FILENAME', 'users.txt');
  $loggedin = isset( $_SESSION['loggedin']);
  $error_msg = '';

  if(!$loggedin):
    if(isset($_POST['submit'])):
      if(isset($_POST['username'])):
        $username = $_POST['username'];
        $email="";
        $lines = file( USERS_FILENAME, FILE_IGNORE_NEW_LINES );

        foreach( $lines as $line ):
          list( $currentUserName, ,$email, , , , ,) = explode( "\t", $line );
          if( $username === $currentUserName):
            $to = "$email";
            $subject = "Password Reset for Truman 3D Printing Services";
            $min = 10000;
            $max = 99999;
            $code = rand ($min,$max);
            $message = "Your password reset code is: $code";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            //$headers = 'From: <Truman3DPrinting@gmail.com>' . "\r\n";
            mail( $to, $subject, $message, $headers );
            $_SESSION['code'] = $code;
            $_SESSION['username'] = $username;
            header('Location: passresetconfirm.php');
          endif;
        endforeach;
      
      else:
        $error_msg = 'All fields must be filled out';
      endif;
    endif;
  endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="author" content="Jessica, Sam, Jimmy" />
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  
  <body>
    <?php
      include('nav.php');
      define( 'AVAILABLE_COLORS', 'colors.txt' );
    ?>
    
    <section class="maincontent">
    <?= $error_msg ?>
    <?php if($loggedin): ?>
    
      <p>
        You are already logged in as <?=$_SESSION['username']?>.
        <a href="home.php">Home</a>
      </p>
    
    <?php else: ?>
    
      <form method="post" action="forgotpassword.php">
        <fieldset>
          <label for="username">Please enter your Username</label>
          <input type="text" id="username" name="username"
                 pattern="\w+" required />
        </fieldset>
        <button type="submit" name="submit">Reset Password</button>
      </form>
    
    <?php endif; ?>
    
    </section>
  </body>
</html>
