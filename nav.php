<?php
#Samuel Livingston
if(session_id() == '' || !isset($_SESSION)): 
    // session isn't started
    session_start();
endif;
?>


  <header>
  <div id="loginheader">
  <?php if( isset($_SESSION['loggedin'] )): ?>
    <p>
      You're logged in as: <?= $_SESSION['firstname']?> 
        <?=$_SESSION['lastname']?>
       <a href="viewAccount.php" class="loggedinheader">Profile</a>
       <a href="logout.php" class="loggedinheader">Logout</a>
     </p>
  <?php else:?>
    <form action="verifyLogin.php" method="post">
      <fieldset>
        <label for="username">Username</label>
        <input type="text" pattern="\w+" required="required" 
               name="username"
               placeholder="Username" 
               id="username"/>
        <a href="accountCreation.php" class="loginheader">Create Account</a>
       </fieldset>
       
       <fieldset>
        <label for="password">Password</label>
        <input type="password" required="required" name="password"
               placeholder="Password" pattern="[^ ]{5,}" 
               id="password"/>
        <a href="forgotpassword.php" class="loginheader">Forgot Password?</a>
       </fieldset>
       
        <button type="submit" name="submit">Sign In</button>
    </form>
 
      
      


  <?php endif; ?>
  </div>
    Truman 3D Printing Services
  </header>
    
  <nav>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="info.php">Info</a></li>
      <li><a href="print.php">Print</a></li>
      <li><a href="gallery.php">Gallery</a></li>
      <li><a href="admin.php">Admin</a></li>
      <li><a href="jbeck.php">For Dr.Beck</a></li>
    </ul>  
  </nav>  
