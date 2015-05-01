 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admin Page2</title>
    <meta name="author" content="Samuel Livingston" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <?php include('nav.php');
    $_SESSION['history'] = "Admin2";
    if( isset( $_SESSION['loggedin'] ) && 
               $_SESSION['loggedin'] == true &&
               $_SESSION['aflag'] == 'T'):
    ?>
    <section class="maincontent">
      <h1>Completed/Rejected Projects</h1>
      <a href="admin.php">Goto the Printing Queue</a>
      <a href="editPrinters.php">Add/Edit Printers</a>
      <table id="jobsTable">
        <?php include('getPrintJobs.php') ?>
      </table>
    </section>
        <?php elseif( isset( $_SESSION['loggedin'] ) && 
                             $_SESSION['loggedin'] == true &&
                             !($_SESSION['aflag'] == 1)): ?>
    <section>
      <h1>Access Denied</h1>
      <p>Sorry, you must be an admin to access this page.</p>
    </section>
    <?php else:
      //$_SESSION['history'] = "Admin2";
      header('Location: login.php');
    endif; ?>
    <script src="admin.js"></script>
  </body>
</html>
