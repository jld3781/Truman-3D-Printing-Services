<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  
  $_SESSION['projectName'] = htmlspecialchars($_POST['projectName']);
  $_SESSION['projectLink'] = htmlspecialchars($_POST['projectLink']);
  $_SESSION['picture'] = htmlspecialchars($_POST['picture']);
  $_SESSION['length'] = htmlspecialchars($_POST['length']);
  $_SESSION['width'] = htmlspecialchars($_POST['width']);
  $_SESSION['height'] = htmlspecialchars($_POST['height']);
  $_SESSION['weight'] = htmlspecialchars($_POST['weight']);
  $_SESSION['material'] = htmlspecialchars($_POST['material']);
  $_SESSION['color'] = htmlspecialchars($_POST['color']);
  $badchar = ["\n" , "\r" , "\n\r", "\r\n"];
  $comments = str_replace($badchar, " ", $_POST['comments']);
  $_SESSION['comments'] = htmlspecialchars($comments);
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
        <li>Project Picture URL: <?= $_SESSION['picture'] ?></li>
        <li>Length: <?= $_SESSION['length'] ?> inches</li>
        <li>Width: <?= $_SESSION['width'] ?> inches</li>
        <li>Height: <?= $_SESSION['height'] ?> inches</li>
        <li>Weight: <?= $_SESSION['weight'] ?> pounds</li>
	      <li>Material: <?= $_SESSION['material'] ?></li>
        <li>Color: <?= $_SESSION['color'] ?></li>
        <li>Comments: <?= $_SESSION['comments'] ?></li>
      </ul>

      <form method="post" action="orderConfirmation.php">
        <button type="submit">Submit Order</button>
      </form>
    </section>
  </body>
</html>
