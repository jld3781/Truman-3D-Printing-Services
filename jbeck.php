<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Jessica, Sam, Jimmy" />
    <link rel="stylesheet" href="style.css" />
    <title>For Jbeck</title>
  </head>
  <body>
    <?php include( 'nav.php' ); ?>
    <section class="maincontent">
      <h1>Hi, Dr. Beck!</h1>
      <p>
        You can login as an <em>admin</em> with
        <label>Username:</label> jbeck1
        <label>Password:</label> pass5
      </p>
    
      <p>
        You can login as a <em>regular user</em> with
        <label>Username:</label> jbeck2
        <label>Password:</label> pass5
        Enjoy!
      </p>
    </section>
  </body>
</html>
