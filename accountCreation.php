<?php
  # Jimmy Sorsen
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  define('USERS_FILENAME', 'users.txt');
  $loggedin = false; #isset( $_SESSION['loggedin'])
  $error_msg = '';
  if(!$loggedin):
    if(isset($_POST['submit'])):
      if(isset($_POST['firstname']) && 
         isset($_POST['lastname']) && 
         isset($_POST['studentid']) && 
         isset($_POST['email']) && 
         isset($_POST['lastname']) && 
         isset($_POST['tel']) &&
         isset($_POST['username']) &&
         isset($_POST['password']) &&
         isset($_POST['retypepassword']) ):
        $lines = file( $filename, FILE_IGNORE_NEW_LINES );
        $alreadytaken = false;
        foreach( $lines as $line ):
          $oneline = explode( "\t", $line );
          $currentUserName = $oneline[0];
          if( $_POST['username'] === $currentUserName):
            $alreadytaken=true;
          endif;
        endforeach;
        if(!$alreadytaken):
          if(preg_match( '|^\w+$|', $_POST['username']) &&
             preg_match( '|^\S+$|', $_POST['password']) &&
             preg_match( '|^\S+$|', $_POST['retypepassword']) ):
            if($_POST['password'] === $_POST['retypepassword']):
              #add new account and start session
            else:
              $error_msg = 'Passwords did not match';
            endif;
          else:
            $error_msg = 'You must enter a valid username-password pair';
          endif;
        else:
          $error_msg = 'Username already taken';
        endif;
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
    <title>Create Account</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  
  <body>
    <?php
      include('nav.php');
      define( 'AVAILABLE_COLORS', 'colors.txt' );
    ?>
    
    <section class="maincontent">
    <?php if($loggedin): ?>
    
      <p>
        You are already logged in.
      </p>
    
    <?php else: ?>
    
      <form method="post" action="accountCreation.php">
        <fieldset>
          <label for="firstname">First Name</label>
          <input type="text" pattern="\w+" id="firstname" name="firstName" required />
        </fieldset>
        
        <fieldset>
          <label for="lastname">Last Name</label>
          <input type="text" pattern="\w+" id="lastname" name="lastname" required />
        </fieldset>
        
        <fieldset>
          <label for="studentid">Student ID</label>
          <input type="text" id="studentid" name="studentid"
                 pattern="[0-9]{9}" required />
        </fieldset>
        
        <fieldset>
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />
        </fieldset>
        
        <fieldset>
          <label for="tel">Phone</label>
          <input type="tel" id="tel" name="tel"
                 pattern="[0-9]{10,11}" required />
        </fieldset>
        
        <fieldset>
          <label for="username">Username</label>
          <input type="text" id="username" name="username"
                 pattern="\w+" required />
        </fieldset>
        
        <fieldset>
          <label for="password">Password</label>
          <input type="password" id="password" name="password" 
                 placeholder="minimum length 5" pattern="[^ ]{5,}" required />
        </fieldset>
        
        <fieldset>
          <label for="retypepassword">Retype Password</label>
          <input type="password" id="retypepassword" name="retypePassword" 
                 pattern="[^ ]{5,}" required />
        </fieldset>
        
        <button type="submit" name="submit">Log In</button>
      </form>
    
    <?php endif; ?>
    
    </section>
  </body>
</html>
