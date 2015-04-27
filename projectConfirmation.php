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
  $sql = "INSERT INTO PROJECT (CreatorUsername, ProjectName, ProjectLink, Picture) 
            VALUES(:creatorusername, :projectname, :projectlink, :picture)";
  $stmt = $db-> prepare($sql);
  $stmt->bindParam(':creatorusername', $_SESSION['username'], PDO::PARAM_STR);
  $stmt->bindParam(':projectname', $_SESSION['projectname'], PDO::PARAM_STR);
  $stmt->bindParam(':projectlink', $_SESSION['projectlink']);
  $stmt->bindParam(':picture', $_SESSION['picture']);
  $stmt->execute();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="author" content="Jessica DiMariano" />
    <title>Project Confirmation</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  
  <body>
    <?php include( 'nav.php' ); ?>
    
    <section class="maincontent">
      <h1>Success!</h1>
      <p>Your project has been created.</p>
      <form method="post" action="print.php">
        <input type="text" id="projectname" hidden="hidden" name="projectname" value="<?=$_SESSION['projectname']?>" />
        <input type="text" id="creatorusername" hidden="hidden" name="creatorusername" value="<?=$_SESSION['username']?>" />
        <button type="submit" name="submit">Print Project</button>
      </form>
    </section>
  </body>
</html>

