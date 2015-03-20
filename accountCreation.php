<?php
  # Jimmy Sorsen
  session_start();
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  define('USERS_FILENAME', 'users.txt');
  $loggedin = isset( $_SESSION['loggedin']);
  $error_msg = '';
  if(!$loggedin):
    if(isset($_POST['submit'])):
      if(isset($_POST['firstname']) && 
         preg_match( '|^\w+$|', $_POST['firstname'] ) &&
         isset($_POST['lastname']) && 
         preg_match( '|^\w+$|', $_POST['lastname'] ) &&
         isset($_POST['studentid']) && 
         preg_match( '%^[0-9]{9}$%', $_POST['studentid'] ) &&
         isset($_POST['email']) && 
         filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
         isset($_POST['tel']) &&
         preg_match( '%^[0-9]{10,11}$%', $_POST['tel'] ) &&
         isset($_POST['username']) &&
         preg_match( '%^\w+$%', $_POST['username'] ) &&
         isset($_POST['password']) &&
         preg_match( '%^\S{5,}$%', $_POST['password'] ) &&
         isset($_POST['retypepassword']) ):
        $lines = file( USERS_FILENAME, FILE_IGNORE_NEW_LINES );
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
              $hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
              $newline = $_POST['username']."\t".$hashedpassword."\t".$_POST['email']."\t".$_POST['studentid']."\t".$_POST['firstname']."\t".$_POST['lastname']."\t".$_POST['tel']."\t".'0';
              file_put_contents(USERS_FILENAME, $newline . PHP_EOL, FILE_APPEND);
              $_SESSION['username'] = $_POST['username'];
              $_SESSION['loggedin'] = true;
              $_SESSION['firstname'] = $_POST['firstname'];
              $_SESSION['lastname'] = $_POST['firstname'];
              $_SESSION['aflag'] = 0;
              header( 'Location: accountCreated.php' );
              exit;
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
        $error_msg = 'All fields must be filled out with valid data';
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
    <?= $error_msg ?>
    <?php if($loggedin): ?>
    
      <p>
        You are already logged in as <?=$_SESSION['username']?>. <a href="home.php">Home</a>
      </p>
    
    <?php else: ?>
      <h2>
        Create An Account
      </h2>
    
      <form method="post" action="accountCreation.php">
        <fieldset>
          <label for="firstname">First Name</label>
          <input type="text" pattern="\w+" id="firstname" name="firstname" required />
        </fieldset>
        
        <fieldset>
          <label for="lastname">Last Name</label>
          <input type="text" pattern="\w+" id="lastname" name="lastname" required />
        </fieldset>
        
        <fieldset>
          <label for="studentid">Student ID</label>
          <input type="text" id="studentid" name="studentid"
                 placeholder="000000000"
                 pattern="[0-9]{9}" required />
        </fieldset>
        
        <fieldset>
          <label for="email">Email</label>
          <input type="email" id="email" name="email"
                 placeholder="example@example.com" required />
        </fieldset>
        
        <fieldset>
          <label for="tel">Phone</label>
          <input type="tel" id="tel" name="tel"
                 placeholder="Just numbers"
                 pattern="[0-9]{10,11}" required />
        </fieldset>
        
        <fieldset>
          <label for="username">Username</label>
          <input type="text" id="username" name="username"
                 placeholder="Letters, numbers, and _"
                 pattern="\w+" required />
        </fieldset>
        
        <fieldset>
          <label for="password">Password</label>
          <input type="password" id="password" name="password" 
                 placeholder="minimum length 5" pattern="[^ ]{5,}" required />
        </fieldset>
        
        <fieldset>
          <label for="retypepassword">Retype Password</label>
          <input type="password" id="retypepassword" name="retypepassword" 
                 pattern="[^ ]{5,}" required />
        </fieldset>
        
        <button type="submit" name="submit">Submit</button>
      </form>
    
    <?php endif; ?>
    
    </section>
  </body>
</html>
