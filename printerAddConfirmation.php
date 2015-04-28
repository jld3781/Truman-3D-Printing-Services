 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once( 'dbconnection.php' );

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admin Page</title>
    <meta name="author" content="Samuel Livingston" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <?php include('nav.php');
      if( isset( $_SESSION['loggedin'] ) && 
                 $_SESSION['loggedin'] == true &&
                 $_SESSION['aflag'] == 'T'):
    ?>
    <section class="maincontent">
      <h1>Printer Successfully Added!</h1>

      <a href="editPrinters.php"> Back to Printer Menu</a>
    
        <?php elseif( isset( $_SESSION['loggedin'] ) && 
                 $_SESSION['loggedin'] == true &&
                 !($_SESSION['aflag'] == 1)):
        ?>
          <section>
            <h1>Access Denied</h1>
            <p>Sorry, you must be an admin to access this page.</p>
          </section>
        <?php else:
            $_SESSION['history'] = "Admin";
            header('Location: login.php');
          endif; 
        ?>
      </section>
  </body>
</html>

