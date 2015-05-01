 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');
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
    $_SESSION['history'] = "Admin";
    if( isset( $_SESSION['loggedin'] ) && 
               $_SESSION['loggedin'] == true &&
               $_SESSION['aflag'] == 'T'):
    ?>
    <section class="maincontent">
      <h1>Printing Queue</h1>
      <a href="admin2.php">Goto Completed/Rejected Jobs</a>
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
    //$_SESSION['history'] = "Admin";
    header('Location: login.php');
    endif; ?>
    <script src="admin.js"></script>
  </body>
</html>
