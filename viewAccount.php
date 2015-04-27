 <?php
//Jimmy Sorsen & Samuel Livingston
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
    <section class="maincontent">
    <?php if($loggedin):
      require_once( 'dbconnection.php' );
      $query = "SELECT Username, FirstName, LastName, StudentId, Email, PhoneNumber, PasswordHash
                FROM USER
                WHERE Username = :username";
      $statement = $db->prepare( $query );
      $statement->bindParam( ':username', $_SESSION['username'], PDO::PARAM_STR );
      $statement->execute();
      $result = $statement->fetchAll();
      ?>
      <h2>Your Profile</h2>
      <p>
        Username: <?= $result[0]['Username'] ?>
      <p>
        <label>First name:</label> <?= $result[0]['FirstName'] ?>
      </p>
      <p>
        <label>Last name:</label> <?= $result[0]['LastName'] ?>
      </p>
      <p>
        <label>Student ID:</label> <?= $result[0]['StudentId'] ?>
      </p>
      <p>
        <label>Email:</label> <?= $result[0]['Email'] ?>
      </p>
      <p>
        <label>Phone Number:</label> <?= $result[0]['PhoneNumber'] ?>
      </p>
      <p>
        <a href="manageAccount.php">Edit Profile</a>
        <a href="editPassword.php">Change Password</a>
      </p>

    <?php else:?>
      <p>
        You need to <a href="login.php">log in</a> to view your profile.
      </p>
    <?php endif; ?>
     <p>
       <a href="home.php">Back To Home Page</a>
     </p>
   </section>
  </body>
</html>

