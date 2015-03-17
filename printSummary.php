<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  
  $_SESSION['projectName'] = $_POST['projectName'];
  $_SESSION['projectLink'] = $_POST['projectLink'];
  $_SESSION['weight'] = $_POST['weight'];
  $_SESSION['color'] = $_POST['color'];
  $_SESSION['comments'] = $_POST['comments'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="author" content="Jessica DiMariano" />
    <title>Print Summary</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  
  <body>
    <?php
      session_start();
      $_SESSION['projectName'] = $_POST['projectName'];
      $_SESSION['projectLink'] = $_POST['projectLink'];
      $_SESSION['weight'] = $_POST['weight'];
      $_SESSION['color'] = $_POST['color'];
      $_SESSION['comments'] = $_POST['comments'];
      include( 'nav.html' );
    ?>
    
    <section class="maincontent">
    
      <h1>Print Summary</h1>
      
      <ul id="print-summary-list">
        <li>Project Name: <?= $_SESSION['projectName'] ?></li>
        <li>Project Link: <?= $_SESSION['projectLink'] ?></li>
        <li>Weight: <?= $_SESSION['weight'] ?> grams</li>
        <li>Color: <?= $_SESSION['color'] ?></li>
        <li>Comments: <?= $_SESSION['comments'] ?></li>
      </ul>

      <form method="post" action="orderConfirmation.php">
        <button type="submit">Submit Order</button>
      </form>
    </section>
  </body>
</html>
