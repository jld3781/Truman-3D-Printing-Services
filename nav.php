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
    <p class="loggedinheader">
       You're logged in as: <?= $_SESSION['firstname']?> 
        <?=$_SESSION['lastname']?>
    </p>
    <p class="loggedinheader">
      <?php if(isset($_SESSION['aflag'])):
        if ($_SESSION['aflag'] == 'T'):?>
      <a href="admin.php" class="loggedinheader">Admin</a>
        <?php endif; endif;?>
      <a href="viewAccount.php" class="loggedinheader">Profile</a>
      <a href="logout.php" class="loggedinheader">Logout</a>
    </p>
  <?php else:?>
    <form action="verifyLogin.php" method="post">
      <fieldset>
        <label for="navusername">Username</label>
        <input type="text" pattern="\w+" required="required" 
               name="username"
               placeholder="Username" 
               id="navusername"
               tabindex="1"/>
        <a href="accountCreation.php" class="loginheader">Create Account</a>
       </fieldset>
       
       <fieldset>
        <label for="navpassword">Password</label>
        <input type="password" required="required" name="password"
               placeholder="Password" pattern="[^ ]{5,}" 
               id="navpassword"
               tabindex="2"/>
        <a href="forgotpassword.php" class="loginheader">Forgot Password?</a>
       </fieldset>

       <button type="submit" id="signinbutton" name="submit" tabindex="3">Sign In</button>
    </form>

  <?php endif; ?>
  </div>
    <h1 id="mainHeader">
    Truman 3D Printing Services
    </h1>
  </header>
    
  <nav>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="info.php">Info</a></li>
      <li><a href="print.php">Print</a></li>
      <li><a href="gallery.php">Gallery</a></li>
      <li><a href="jbeck.php">For Dr.Beck</a></li>
    </ul>  
  </nav>  
