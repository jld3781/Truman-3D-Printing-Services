<?php
session_start();
$loggedin = isset($_SESSION['loggedin']);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="author" content="Jessica, Sam, Jimmy" />
    <title>Account Created</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php include('nav.php'); ?>
    
    <section class="maincontent">
    <?php if($loggedin): ?>
      <p>
        Successfully created account <a href="manageAccount.php"><?= $_SESSION['username'] ?></a>. 
        <a href="home.php">Home</a>
      </p>
    <?php else: ?>
      <p>
        You are not <a href="login.php">logged in</a>.
      </p>
    <?php endif; ?>
    </section>
  </body>
</html>
