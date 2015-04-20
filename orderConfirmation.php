<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  require_once('dbconnection.php');
  $_SESSION['username'] = "jbeck1";

  $sql = "SELECT Email FROM USER WHERE Username = '" . $_SESSION['username'] . "';";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll();
 
  $_SESSION['email'] = $rows[0]['Email'];
echo $_SESSION['email'];
  $sql = "SELECT * FROM PROJECT WHERE ProjectName = '" . $_SESSION['projectName']
          . "' AND CreatorEmail = '" . $_SESSION['email']."';";
  $stmt = $db -> prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll();

  if(empty($rows)):
echo 'test1';
    $sql = "INSERT INTO PROJECT (CreatorEmail, ProjectName, ProjectLink) 
            VALUES(':creatoremail', ':projectname', ':projectlink');";
    $stmt = $db-> prepare($sql);
    $stmt->bindParam(':creatoremail', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->bindParam(':projectname', $_SESSION['projectName'], PDO::PARAM_STR);
    $stmt->bindParam(':projectlink', $_SESSION['projectLink']);
    $stmt->execute();
echo 'test2';
    $sql = "INSERT INTO PROJECT (PrinterEmail, CreatorEmail, ProjectName,
             Status, Weight, Color, Comment, MaterialType) 
            VALUES(':printeremail',':creatoremail', ':projectname',   
              ':status', ':weight', ':color', ':comment', ':materialtype');";
    $stmt = $db -> prepare($sql);
    $stmt->bindParam(':printeremail', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->bindParam(':creatoremail', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->bindParam(':projectname', $_SESSION['projectName'], PDO::PARAM_STR);
    $stmt->bindValue(':status', 'Waiting');
    $stmt->bindParam(':weight', $_SESSION['weight'], PDO::PARAM_INT);
    $stmt->bindParam(':color', $_SESSION['color'], PDO::PARAM_STR);
    $stmt->bindParam(':comment', $_SESSION['comment'], PDO::PARAM_STR);
    $stmt->bindParam(':materialtype', $_SESSION['materialType'],PDO::PARAM_STR);
    $stmt->execute();
  endif;
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
