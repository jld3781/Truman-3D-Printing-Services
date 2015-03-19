 <?php
//Samuel Livingston - Milestone 2
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

define( 'USER_FILENAME', 'users.txt' );
$error_msg = '';
$loggedin = isset($_SESSION['loggedin']);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Jessica, Sam, Jimmy" />
    <link rel="stylesheet" href="style.css" />
    <title>View Account Details</title>
  </head>

  <body>
    <?php include( 'nav.php' ); ?>
    <section>
    <?php if($loggedin):
      $lines = file( USER_FILENAME, FILE_IGNORE_NEW_LINES );
      $accountDetails = null;
      foreach( $lines as $line ):
        $oneline = explode( "\t", $line);
        $currentUserName = $oneline[0];
        if( $_SESSION['username'] === $currentUserName):
          $accountDetails = $oneline;
        endif;
      endforeach;
      ?>
      <h2>Your Profile</h2>
      <p>
        Username: <?= $accountDetails[0] ?>
      <p>
        First name: <?= $accountDetails[4] ?>
      </p>
      <p>
        Last name: <?= $accountDetails[5] ?>
      </p>
      <p>
        Student ID: <?= $accountDetails[3] ?>
      </p>
      <p>
        Email: <?= $accountDetails[2] ?>
      </p>
      <p>
        Phone Number: <?= $accountDetails[6] ?>
      </p>
      <p>
        <a href="manageAccount.php">Edit Profile</a>
        <a href="editPassword.php">Change Password</a>
      </p>

    <?php else:?>
      <p>
        You need to log in to view your profile.
      </p>
    <?php endif; ?>
     <p>
       <a href="home.php">Back To Home Page</a>
     </p>
   </section>
  </body>
</html>

