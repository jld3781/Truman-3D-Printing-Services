<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
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
    <?php include( 'nav.php' ); ?>
    <section class="maincontent">
    
    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true):?>
      <h1>Already Logged In</h1>
      
    <?php else:?>
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
        
        <button type="submit" name="submit">Sign In</button>
      </form>
      
      <a href="accountCreation.php">Create a new account</a>

     </section>
  </body>
</html>
<?php endif; ?>
