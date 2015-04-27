<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  require_once('dbconnection.php');
  if(!isset($_POST['submit']) ||
     !isset($_SESSION['username'])):
    header("Location: login.php");
  endif;
  
  //CREATE THE PRINT JOB
  $sql = "INSERT INTO PRINT_JOB (PrinterUsername, CreatorUsername, ProjectName, 
            Status, Length, Width, Height, Weight, Color, Comment, 
            MaterialType, SubmittedTime) 
          VALUES(:printerusername,:creatorusername, :projectname, :status, :length, 
            :width, :height, :weight, :color, :comment, :materialtype, NOW())";
  $stmt = $db -> prepare($sql);
  $stmt->bindParam(':printerusername', $_SESSION['username'], PDO::PARAM_STR);
  $stmt->bindParam(':creatorusername', $_SESSION['creatorusername'], PDO::PARAM_STR);
  $stmt->bindParam(':projectname', $_SESSION['projectname'], PDO::PARAM_STR);
  $stmt->bindValue(':status', 'Waiting');
  $stmt->bindParam(':length', $_SESSION['length'], PDO::PARAM_STR);
  $stmt->bindParam(':width', $_SESSION['width'], PDO::PARAM_STR);
  $stmt->bindParam(':height', $_SESSION['height'], PDO::PARAM_STR);
  $stmt->bindParam(':weight', $_SESSION['weight'], PDO::PARAM_STR);
  $stmt->bindParam(':color', $_SESSION['color'], PDO::PARAM_STR);
  $stmt->bindParam(':comment', $_SESSION['comments'], PDO::PARAM_STR);
  $stmt->bindParam(':materialtype', $_SESSION['material'],PDO::PARAM_STR);
  $stmt->execute();
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
    <?php include( 'nav.php' ); ?>
    
    <section class="maincontent">
      <h1>Success!</h1>
      <p>Your order has been submitted for printing.</p>
    </section>
  </body>
</html>
