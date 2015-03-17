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
    <title>Home</title>
  </head>
  <body>
    <?php include( 'nav.html' ); ?>
    <section class="maincontent">
      <h1>Sign In</h1>
      
      <form method="post" action="verifyLogin.php">
        <fieldset>
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required />
        </fieldset>
        
        <fieldset>
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
        </fieldset>
        
        <button type="submit" name="login">Sign In</button>
      </form>
      
     </section>
  </body>
</html>
