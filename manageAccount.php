 <?php
//Samuel Livingston - Milestone 2
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

define( 'DEFINITION_FILENAME', 'users.txt' );
$error_msg = '';
$loggedin = true;
$alreadyTaken=false;
$accountCreateTried=false;
$username = null;
$filename = DEFINITION_FILENAME;

if( !( isset( $_SESSION['username']) && isset( $_SESSION['loggedin'] ))):
  if( isset( $_POST['submit'] )): #14-31 Handles account creation form
    if( isset( $_POST['firstname'] ) &&
        isset( $_POST['lastname'] ) && 
        isset( $_POST['sid'] ) && 
        isset( $_POST['email'] ) && 
        isset( $_POST['phoneNum'] ) &&  
        isset( $_POST['username'] ) && 
        preg_match( '|^\w+$|', $_POST['username'] ) &&
        isset( $_POST['password'] ) && 
        preg_match( '|^\S+$|', $_POST['password'] )):
      $fullname = $_POST['fullname'];
      $username = $_POST['username'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $lines = file( $filename, FILE_IGNORE_NEW_LINES );
      foreach( $lines as $line ):
        $oneline = explode( "\t", $line);
        $currentUserName = $oneline[0];
        if( $username === $currentUserName):
          $alreadyTaken=true;
        endif;
      endforeach;

      if($alreadyTaken==false):
      $newLine = "$username\t$password\t$fullname ";
      file_put_contents(DEFINITION_FILENAME,$newLine . PHP_EOL, FILE_APPEND);
      $_SESSION['username'] =  $username;
      $_SESSION['loggedin'] = true;
      $loggedin = true;
      else:
        $accountCreateTried = true;
      endif;
    else:
      $error_msg = 'You must enter a valid username-password pair';
    endif;
  endif;
else:
  if( isset( $_POST['submit'] )): #33-59 Handles profile edit form
    if( isset( $_POST['firstname'] ) &&
        isset( $_POST['lastname'] ) && 
        isset( $_POST['sid'] ) && 
        isset( $_POST['email'] ) && 
        isset( $_POST['phoneNum'] ) &&  
        isset( $_POST['password'] ) && 
        preg_match( '|^\S+$|', $_POST['password'] )):
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $sid = $_POST['sid'];
      $email = $_POST['email'];
      $phoneNum = $_POST['phoneNum'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $username = $_SESSION['username'];

      $lines = file( $filename, FILE_IGNORE_NEW_LINES );
      $lineCount = 0;
      foreach( $lines as $line ):
        $oneline = explode( "\t", $line);
        $currentUserName = $oneline[0];
        $currentPass = $oneline[1];
        if( $username === $currentUserName):
          $lines[$lineCount] = "$username\t$password\t$fullname";
        endif;
        $lineCount++;
      endforeach;

      file_put_contents(DEFINITION_FILENAME, "");
      foreach( $lines as $line ):
      file_put_contents(DEFINITION_FILENAME, trim($line) . PHP_EOL, 
        FILE_APPEND);
      endforeach;

      $_SESSION['username'] =  $username;
      $_SESSION['loggedin'] = true;
    endif;
  endif;
  $loggedin = true;
endif; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Jessica, Sam, Jimmy" />
    <link rel="stylesheet" href="style.css" />
    <title>Manage Account</title>
  </head>

  <body>
    <?php include( 'nav.php' ); ?>
    <section>
    <?php if( $loggedin ): ?>

      <form action="profile.php" method="post">
          <fieldset><legend>Edit Profile</legend>
            <p>
              <label for="firstName">First Name: </label>
              <input type="text" required="required" 
                     name="firstName" autofocus="autofocus" 
                     id="firstname"/>
            </p>

            <p>
              <label for="lastName">Last Name: </label>
              <input type="text" required="required" 
                     name="lastName" autofocus="autofocus" 
                     id="lastName"/>
            </p>

            <p>
              <label for="sid">Student ID: </label>
              <input type="text" required="required" 
                     name="sid" autofocus="autofocus" 
                     placeholder="0001234567" 
                     id="sid"/>
            </p>

            <p>
              <label for="email">Email: </label>
              <input type="text" required="required" 
                     name="email" autofocus="autofocus" 
                     placeholder="abc1234@truman.edu" 
                     id="email"/>
            </p>

            <p>
              <label for="phoneNum">Phone Number: </label>
              <input type="text" required="required" 
                     name="phoneNum" autofocus="autofocus" 
                     placeholder="5552225454" 
                     id="phoneNum"/>
            </p>

            <p>
              <label for="password">Password: </label>
              <input type="password" required="required" name="password"
                     placeholder="minimum length 5" pattern="[^ ]{5,}" 
                     id="password"/>
            </p>

            <p>
              <button type="submit" name="submit">Submit</button>
            </p>
          </fieldset>
        </form>

    <?php else:
        if(($alreadyTaken==true) && ($accountCreateTried==true)):?>
        <p>The username "<?= $username ?>" is already taken.</p>
        <?php endif; ?>

      <form action="profile.php" method="post">
          <fieldset><legend>Create Account</legend>
            <p>
              <label for="fullname">Fullname: </label>
              <input type="text" required="required" 
                     name="fullname" autofocus="autofocus" 
                     placeholder="First and Last Name" 
                     id="fullname"/>
            </p>

            <p>
              <label for="username">Username: </label>
              <input type="text" pattern="\w+" required="required" 
                     name="username"
                     placeholder="letters, digits, underscore" 
                     id="username"/>
            </p>

            <p>
              <label for="password">Password: </label>
              <input type="password" required="required" name="password"
                     placeholder="minimum length 5" pattern="[^ ]{5,}" 
                     id="password"/>
            </p>

            <p>
              <button type="submit" name="submit">Submit</button>
            </p>
          </fieldset>
        </form>
    <?php endif; ?>
    </section>
    <p>
      <a href="home.php">Back To Home Page</a>
    </p>
  </body>
</html>

