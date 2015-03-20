<?php
  # Samuel Livingston
  session_start();
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  define('USERS_FILENAME', 'users.txt');
  $loggedin = isset( $_SESSION['loggedin']);
  $msg = "An email has been sent to the email account attached to the username
         you provided. Please enter the 5 digit code given in that email in the
         space below.";
  $resetcode = 0;

  if(!$loggedin):
    if(isset($_POST['submit'])):
      if(isset($_POST['resetcode'])): //Handle reset code
        $resetcode = $_POST['resetcode'];
        $msg = "Now please enter your new password.";

      elseif(isset($_POST['newpassword']) && //Handle new passwords
             isset($_POST['retypepassword'])):
        if( $_POST['newpassword'] === $_POST['retypepassword'] ):
          if( preg_match( '|^\S+$|', $_POST['newpassword'])):
            $lines = file( USERS_FILENAME, FILE_IGNORE_NEW_LINES );
            //$passwordmatch = false;
            $newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
            file_put_contents(USERS_FILENAME, '');
            foreach( $lines as $line ):
              $oneline = explode( "\t", $line);
              $currentUserName = $oneline[0];
              if( $_SESSION['username'] === $currentUserName):
                $newline = $oneline[0]."\t".$newpassword."\t".$oneline[2]."\t".$oneline[3]."\t".$oneline[4]."\t".$oneline[5]."\t".$oneline    [6]."\t".$oneline[7];
                file_put_contents(USERS_FILENAME, $newline . PHP_EOL, FILE_APPEND);
              else:
                file_put_contents(USERS_FILENAME, $line . PHP_EOL, FILE_APPEND);
              endif;
            endforeach;
            header('Location: passchangesuccess.php');
          else:
            $msg = 'New password contains illegal characters';
          endif;
        else:
          $msg = 'New passwords did not match, please re-enter the 5 digit code to try again.';
        endif;


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
    <?= $msg?>
    <?php if($loggedin): ?>
    
      <p>
        You are already logged in as <?=$_SESSION['username']?>. 
          <a href="home.php">Home</a>
      </p>

    <?php elseif($resetcode == $_SESSION['code']): ?>
      <form action="passresetconfirm.php" method="post">
        <fieldset>
            <p>
              <label for="newpassword">New Password: </label>
              <input type="password" required="required" name="newpassword"
                     pattern="[^ ]{5,}" 
                     id="newpassword"/>
            </p>
            
            <p>
              <label for="retypepassword">Retype New Password: </label>
              <input type="password" required="required" name="retypepassword"
                     pattern="[^ ]{5,}" 
                     id="retypepassword"/>
            </p>

            <p>
              <button type="submit" name="submit">Submit Change</button>
            </p>
          </fieldset>
        </form>

    <?php else: ?>
    
      <form method="post" action="passresetconfirm.php">
        <fieldset>
          <label for="resetcode">5 Digit Code</label>
          <input type="text" id="username" name="resetcode"
                 pattern="\w+" required />
        </fieldset>
        <button type="submit" name="submit">Reset Password</button>
      </form>
    
    <?php endif; ?>
    
    </section>
  </body>
</html>
