<?php
//Samuel Livingston - Milestone 2
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

define( 'USERS_FILENAME', 'users.txt' );
$error_msg = '';
$loggedin = isset( $_SESSION['loggedin'] );

if( $loggedin && isset($_POST['submit'])):
  if( isset($_POST['oldpassword']) &&
      isset($_POST['newpassword']) &&
      preg_match( '%$\S{5,}^%', $_POST['newpassword'] ) &&
      isset($_POST['retypepassword']) ):
    if( $_POST['newpassword'] === $_POST['retypepassword'] ):
      if( preg_match( '|^\S+$|', $_POST['newpassword'])):
        $lines = file( USERS_FILENAME, FILE_IGNORE_NEW_LINES );
        $passwordmatch = false;
        $newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
        file_put_contents(USERS_FILENAME, '');
        foreach( $lines as $line ):
          $oneline = explode( "\t", $line);
          $currentUserName = $oneline[0];
          if( $_SESSION['username'] === $currentUserName):
            $passwordmatch = password_verify($_POST['oldpassword'], $oneline[1]);
            if($passwordmatch):
              $newline = $oneline[0]."\t".$newpassword."\t".$oneline[2]."\t".$oneline[3]."\t".$oneline[4]."\t".$oneline[5]."\t".$oneline[6]."\t".$oneline[7];
              file_put_contents(USERS_FILENAME, $newline . PHP_EOL, FILE_APPEND);
            else:
              file_put_contents(USERS_FILENAME, $line . PHP_EOL, FILE_APPEND);
              $error_msg = 'Incorrect password';
            endif;
          else:
            file_put_contents(USERS_FILENAME, $line . PHP_EOL, FILE_APPEND);
          endif;
        endforeach;
        if($passwordmatch):
          header( 'Location: passchangesuccess.php' );
          exit; 
        endif;
      else:
        $error_msg = 'New password contains illegal characters';
      endif;
    else:
      $error_msg = 'New passwords did not match';
    endif;
  else:
    $error_msg = 'All fields must be filled';
  endif;
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Jessica, Sam, Jimmy" />
    <link rel="stylesheet" href="style.css" />
    <title>Manage Account Info</title>
  </head>

  <body>
    <?php include( 'nav.php' ); ?>
    <section>
    <?php if( $loggedin ): ?>
      <p>
        <?= $error_msg ?>
      </p>

      <form action="editPassword.php" method="post">
            <p>
              <label for="oldpassword">Old Password: </label>
              <input type="password" required="required" name="oldpassword"
                     pattern="[^ ]{5,}" 
                     id="oldpassword"/>
            </p>
            
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
        You are not <a href="login.php">logged in</a>.
    <?php endif; ?>
      <p>
        <a href="home.php">Back To Home Page</a>
      </p>
    </section>
  </body>
</html>

