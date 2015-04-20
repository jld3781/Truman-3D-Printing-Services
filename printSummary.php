<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  
  $badchar = ["\n" , "\r" , "\n\r", "\r\n"];
  $comments = str_replace($badchar, " ", $_POST['comments']);


  $_SESSION['projectName'] = htmlspecialchars($_POST['projectName']);
  $_SESSION['projectLink'] = htmlspecialchars($_POST['projectLink']);
  $_SESSION['weight'] = $_POST['weight'];
  $_SESSION['material'] = $_POST['material'];
  $_SESSION['color'] = $_POST['color'];
  $_SESSION['comments'] = $comments;
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
    <?php include( 'nav.php' ); ?>
    
    <section class="maincontent">
    
      <h1>Print Summary</h1>
      
      <ul id="print-summary-list">
        <li>Project Name: <?= $_SESSION['projectName'] ?></li>
        <li>Project Link: <?= $_SESSION['projectLink'] ?></li>
        <li>Weight: <?= $_SESSION['weight'] ?> grams</li>
	<li>Material: <?= $_SESSION['material'] ?></li>
        <li>Color: <?= $_SESSION['color'] ?></li>
        <li>Comments: <?= $comments ?></li>
      </ul>

      <form method="post" action="orderConfirmation.php">
        <button type="submit">Submit Order</button>
      </form>
    </section>
  </body>
</html>
