 <?php
//Samuel Livingston & Jimmy Sorsen
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

define( 'USERS_FILENAME', 'users.txt' );
$error_msg = '';
$loggedin = isset( $_SESSION['loggedin'] );

if( $loggedin && isset($_POST['submit'])):
  if( isset($_POST['firstname']) && 
      preg_match( '%^\w+$%', $_POST['firstname'] ) &&
      isset($_POST['lastname']) && 
      preg_match( '%^\w+$%', $_POST['lastname'] ) &&
      isset($_POST['studentid']) && 
      preg_match( '%^\w+$%', $_POST['lastname'] ) &&
      isset($_POST['email']) &&  
      filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
      isset($_POST['tel']) &&
      preg_match( '%^[0-9]{10,11}$%', $_POST['tel'] ) &&
      isset($_POST['password']) ):
    $lines = file( USERS_FILENAME, FILE_IGNORE_NEW_LINES );
    $passwordmatch = false;
    file_put_contents(USERS_FILENAME, '');
    foreach( $lines as $line ):
      $oneline = explode( "\t", $line);
      $currentUserName = $oneline[0];
      if( $_SESSION['username'] === $currentUserName):
        $passwordmatch = password_verify($_POST['password'], $oneline[1]);
        if($passwordmatch):
          $newline = $oneline[0]."\t".$oneline[1]."\t".htmlspecialchars($_POST['email'])."\t".htmlspecialchars($_POST['studentid'])."\t".htmlspecialchars($_POST['firstname'])."\t".htmlspecialchars($_POST['lastname'])."\t".htmlspecialchars($_POST['tel'])."\t".$oneline[7];
          $_SESSION['firstname']=htmlspecialchars($_POST['firstname']);
          $_SESSION['lastname']=htmlspecialchars($_POST['lastname']);
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
      header( 'Location: profilechangesuccess.php' ); //Success
      //header( 'Location: viewAccount.php' );
      exit; 
    endif;
  else:
    $error_msg = 'You must put valid data in all fields';
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
    <?php if( $loggedin ): 
      $lines = file( USERS_FILENAME, FILE_IGNORE_NEW_LINES );
      $accountDetails = null;
      foreach( $lines as $line ):
        $oneline = explode( "\t", $line);
        $currentUserName = $oneline[0];
        if( $_SESSION['username'] === $currentUserName):
          $accountDetails = $oneline;
        endif;
      endforeach;
      ?>
      <p>
        <?= $error_msg ?>
      </p>

      <h2>Edit Profile</h2>
      <form action="manageAccount.php" method="post">
          <fieldset>
            <p>
              <label for="firstname">First Name: </label>
              <input type="text" required="required" 
                     name="firstname" autofocus="autofocus"
                     value="<?= $accountDetails[4] ?>" 
                     pattern="\w+" id="firstname"/>
            </p>

            <p>
              <label for="lastname">Last Name: </label>
              <input type="text" required="required" 
                     name="lastname" autofocus="autofocus"
                     value="<?= $accountDetails[5] ?>"  
                     pattern="\w+" id="lastname"/>
            </p>

            <p>
              <label for="studentid">Student ID: </label>
              <input type="text" required="required" 
                     name="studentid" autofocus="autofocus" 
                     value="<?= $accountDetails[3] ?>"  
                     pattern="[0-9]{9}" id="studentid"/>
            </p>

            <p>
              <label for="email">Email: </label>
              <input type="email" required="required" 
                     name="email" autofocus="autofocus" 
                     value="<?= $accountDetails[2] ?>" 
                     id="email"/>
            </p>

            <p>
              <label for="tel">Phone Number: </label>
              <input type="tel" required="required" 
                     name="tel" autofocus="autofocus" 
                     value="<?= $accountDetails[6] ?>"  
                     id="tel"/>
            </p>

            <p>
              <label for="password">Password: </label>
              <input type="password" required="required" 
                     name="password" pattern="[^ ]{5,}" 
                     placeholder="Enter password to submit" 
                     id="password"/>
            </p>

            <p>
              <button type="submit" name="submit">Submit Changes</button>
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

