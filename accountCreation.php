<?php
  # Jimmy Sorsen
  session_start();
  
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  
  require_once('dbconnection.php');
  
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
        
          $sql = 'SELECT * FROM USER WHERE Email ="'. $_POST['email'] .'"';
          $statement = $db->prepare($sql);
          $statement->execute();
          $rows = $statement->fetchAll();
          
          $alreadytaken = false;
          if( empty($rows) ):
            $alreadytaken = true;
          endif;
        if(!$alreadytaken):
          if(preg_match( '|^\w+$|', $_POST['username']) &&
             preg_match( '|^\S+$|', $_POST['password']) &&
             preg_match( '|^\S+$|', $_POST['retypepassword']) ):
            if($_POST['password'] === $_POST['retypepassword']):
              #add new account and start session
              $hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
              
              $sql = "INSERT INTO USER ( Email, FirstName, LastName, 
                    PhoneNumber, StudentFlag, AdminFlag, PasswordHash) 
                    VALUES (':email', ':firstname', ':lastname', ':tel', '1', 
                    '0', ':password')";
              $stmt = $db->prepare($sql);
              $stmt->bindParam(':email' => $_POST['email'],
                ':firstname' => $_POST['firstname'],
                ':lastname' => $_POST['lastname'],
                ':tel' => $_POST['tel'],
                ':password' => $hashedpassword
              );
              $stmt->execute();
                             
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
    <?php include('nav.php'); ?>
    
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
