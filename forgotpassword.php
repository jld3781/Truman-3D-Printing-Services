<?php
  # Samuel Livingston  IN PROGRESS
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
          $oneline = explode( "\t", $line );
          $currentUserName = $oneline[0];
          if( $username === $currentUserName):
            $email = $oneline[2];
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
        You are already logged in as <?=$_SESSION['username']?>. <a href="home.php">Home</a>
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
