<?php
//Samuel Livingston & Jimmy Sorsen
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

define( 'USERS_FILENAME', 'users.txt' );
$error_msg = '';
$loggedin = isset( $_SESSION['loggedin'] );

if( $loggedin && isset($_POST['submit'])):
  if( isset($_POST['oldpassword']) &&
      isset($_POST['newpassword']) &&
      preg_match( '%^\S{5,}$%', $_POST['newpassword'] ) &&
      isset($_POST['retypepassword']) ):
    if( $_POST['newpassword'] === $_POST['retypepassword'] ):
      if( preg_match( '|^\S+$|', $_POST['newpassword'])):
        require_once( 'dbconnection.php' );
        $query = "SELECT PasswordHash
                  FROM USER
                  WHERE Username = :username";
        $statement = $db->prepare( $query );
        $statement->bindParam( ':username', $_SESSION['username'], PDO::PARAM_STR );
        $statement->execute();
        $result = $statement->fetchAll();
    
        if(password_verify($_POST['oldpassword'], $result[0]['PasswordHash'])):
          $update = "UPDATE USER
                     SET PasswordHash=:passwordhash
                     WHERE Username=:username";
          $newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
          $statement = $db->prepare( $update );
          $statement->bindParam( ':username', $_SESSION['username']);
          $statement->bindParam( ':passwordhash', $newpassword);
          $statement->execute();
          header( 'Location: passchangesuccess.php' );
          exit;
        else:
          $error_msg = 'Password incorrect';
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
    <section class="maincontent">
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
    <script src="inputValidation.js"></script>
  </body>
</html>

