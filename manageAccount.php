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
      preg_match( '%^[0-9]{9}$%', $_POST['studentid'] ) &&
      isset($_POST['email']) &&  
      filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
      isset($_POST['tel']) &&
      preg_match( '%^[0-9]{10,11}$%', $_POST['tel'] ) &&
      isset($_POST['password']) ):
      
    require_once( 'dbconnection.php' );
    $query = "SELECT PasswordHash
              FROM USER
              WHERE Username = :username";
    $statement = $db->prepare( $query );
    $statement->bindParam( ':username', $_SESSION['username'], PDO::PARAM_STR );
    $statement->execute();
    $result = $statement->fetchAll();
    
    if(password_verify($_POST['password'], $result[0]['PasswordHash'])):
      $update = "UPDATE USER 
                 SET FirstName=:firstname, LastName=:lastname, StudentId=:studentid, Email=:email, PhoneNumber=:phonenumber
                 WHERE Username=:username";
      $statement = $db->prepare($update);
      $statement->bindParam( ':firstname', $_POST['firstname']);
      $statement->bindParam( ':lastname', $_POST['lastname']);
      $statement->bindParam( ':studentid', $_POST['studentid']);
      $statement->bindParam( ':email', $_POST['email']);
      $statement->bindParam( ':phonenumber', $_POST['tel']);
      $statement->bindParam( ':username', $_SESSION['username']);
      $statement->execute();
      $_SESSION['firstname'] = $_POST['firstname'];
      $_SESSION['lastname'] = $_POST['lastname'];
      header( 'Location: profilechangesuccess.php' );
      exit;
    else:
      $error_msg = "Incorrect password";
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
      require_once( 'dbconnection.php' );
      $query = "SELECT Username, FirstName, LastName, StudentId, Email, PhoneNumber, PasswordHash
                FROM USER
                WHERE Username = :username";
      $statement = $db->prepare( $query );
      $statement->bindParam( ':username', $_SESSION['username'], PDO::PARAM_STR );
      $statement->execute();
      $result = $statement->fetchAll();
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
                     value="<?= $result[0]['FirstName'] ?>" 
                     pattern="\w+" id="firstname"/>
            </p>

            <p>
              <label for="lastname">Last Name: </label>
              <input type="text" required="required" 
                     name="lastname" autofocus="autofocus"
                     value="<?= $result[0]['LastName'] ?>"  
                     pattern="\w+" id="lastname"/>
            </p>

            <p>
              <label for="studentid">Student ID: </label>
              <input type="text" required="required" 
                     name="studentid" autofocus="autofocus" 
                     value="<?= $result[0]['StudentId'] ?>"  
                     pattern="[0-9]{9}" id="studentid"/>
            </p>

            <p>
              <label for="email">Email: </label>
              <input type="email" required="required" 
                     name="email" autofocus="autofocus" 
                     value="<?= $result[0]['Email'] ?>" 
                     id="email"/>
            </p>

            <p>
              <label for="tel">Phone Number: </label>
              <input type="tel" required="required" 
                     name="tel" autofocus="autofocus" 
                     value="<?= $result[0]['PhoneNumber'] ?>"  
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

