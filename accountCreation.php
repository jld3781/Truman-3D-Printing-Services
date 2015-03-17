<?php
  # Jimmy Sorsen
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  $loggedIn = false;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="author" content="Jessica, Sam, Jimmy" />
    <title>Create Account</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  
  <body>
    <?php
      include('nav.html');
      define( 'AVAILABLE_COLORS', 'colors.txt' );
    ?>
    
    <section class="maincontent">
    <?php if($loggedIn): ?>
    
      <p>
        You are already logged in.
      </p>
    
    <?php else: ?>
    
      <form method="post" action="accountCreation.php">
        <fieldset>
          <label for="firstName">First Name</label>
          <input type="text" pattern="\w+" id="firstName" name="firstName" required />
        </fieldset>
        
        <fieldset>
          <label for="lastName">Last Name</label>
          <input type="text" pattern="\w+" id="lastName" name="lastName" required />
        </fieldset>
        
        <fieldset>
          <label for="studentId">Student ID</label>
          <input type="text" id="studentId" name="studentId"
                 pattern="[0-9]{9}" required />
        </fieldset>
        
        <fieldset>
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />
        </fieldset>
        
        <fieldset>
          <label for="tel">Phone</label>
          <input type="tel" id="tel" name="phone"
                 pattern="[0-9]{10,11}" required />
        </fieldset>
        
        <fieldset>
          <label for="username">Username</label>
          <input type="text" id="username" name="username"
                 pattern="\w+" required />
        </fieldset>
        
        <fieldset>
          <label for="password">Password</label>
          <input type="password" id="password" name="password" 
                 placeholder="minimum length 5" pattern="[^ ]{5,}" required />
        </fieldset>
        
        <fieldset>
          <label for="retypePassword">Retype Password</label>
          <input type="password" id="retypePassword" name="retypePassword" 
                 pattern="[^ ]{5,}" required />
        </fieldset>
    
    <?php endif; ?>
    
    </section>
  </body>
</html>
