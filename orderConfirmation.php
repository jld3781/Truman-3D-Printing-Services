<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  require_once('dbconnection.php');
  $_SESSION['username'] = "jbeck1";
  
  // GET THE USER'S EMAIL
  $sql = "SELECT Email FROM USER WHERE Username = :username";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':username', $_SESSION['username']);
  $stmt->execute();
  $rows = $stmt->fetchAll();
  $_SESSION['email'] = $rows[0]['Email'];

  //CHECK TO SEE IF THE PROJECT ALREADY EXISTS
  $sql = "SELECT * FROM PROJECT WHERE ProjectName = " . $_SESSION['projectName']
          . " AND CreatorUsername = " . $_SESSION['username'];
  $stmt = $db -> prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll();

  if(empty($rows)): //IF PROJECT DOES NOT ALREADY EXIST
    //CREATE THE PROJECT
    $sql = "INSERT INTO PROJECT (CreatorUsername, ProjectName, ProjectLink, Picture) 
            VALUES(:creatorusername, :projectname, :projectlink, :picture)";
    $stmt = $db-> prepare($sql);
    $stmt->bindParam(':creatorusername', $_SESSION['username'], PDO::PARAM_STR);
    $stmt->bindParam(':projectname', $_SESSION['projectName'], PDO::PARAM_STR);
    $stmt->bindParam(':projectlink', $_SESSION['projectLink']);
    $stmt->bindParam(':picture', $_SESSION['picture']);
    $stmt->execute();
  endif;

  //CREATE THE PRINT JOB
  $sql = "INSERT INTO PRINT_JOB (PrinterUsername, CreatorUsername, ProjectName, 
            Status, Length, Width, Height, Weight, Color, Comment, 
            MaterialType, SubmittedTime) 
          VALUES(:printerusername,:creatorusername, :projectname, :status, :length, 
            :width, :height, :weight, :color, :comment, :materialtype, NOW())";
  $stmt = $db -> prepare($sql);
  $stmt->bindParam(':printerusername', $_SESSION['username'], PDO::PARAM_STR);
  $stmt->bindParam(':creatorusername', $_SESSION['username'], PDO::PARAM_STR);
  $stmt->bindParam(':projectname', $_SESSION['projectName'], PDO::PARAM_STR);
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
