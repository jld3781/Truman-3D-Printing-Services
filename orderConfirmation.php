<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  
  define( 'PRINT_JOBS', 'printJobs.txt' );
  $_SESSION['username'] = "test_username";
  $printJob = "Project ID" . "\t" .
             $_SESSION['username'] . "\t" .
             $_SESSION['projectName'] . "\t" .
             $_SESSION['projectLink'] . "\t" .
             "Waiting" . "\t" .
             $_SESSION['weight'] . "\t" .
             $_SESSION['color'] . "\t" .
             $_SESSION['comments'] . PHP_EOL;
             
  file_put_contents(PRINT_JOBS, $printJob, FILE_APPEND);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="author" content="Jessica DiMariano" />
    <title>Order Confirmation</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  
  <body>
    <?php include( 'nav.html' ); ?>
    
    <section class="maincontent">
      <h1>Success!</h1>
      <p>Your order has been submitted for printing.</p>
    </section>
  </body>
</html>
