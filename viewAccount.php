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
?>

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
    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedIn'] == true):?>
      <p>
        First name: <?=$_SESSION['firstname'];?>
      </p>
      <p>
        Last name: <?=$_SESSION['lastname'];?>
      </p>
      <p>
        Student ID: <?=$_SESSION['lastname'];?>
      </p>
      <p>
        Email: <?=$_SESSION['lastname'];?>
      </p>
      <p>
        Phone Number: <?=$_SESSION['lastname'];?>
      </p>

    <?php else:?>
      <p>
        You need to login to view your profile.
      </p>
    <?php endif; ?>
    </section>
    <p>
      <a href="home.php">Back To Home Page</a>
    </p>
  </body>
</html>

