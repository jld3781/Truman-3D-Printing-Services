<?php
#Samuel Livingston
if(session_id() == '' || !isset($_SESSION)): 
    // session isn't started
    session_start();
endif;
?>

<header>Truman 3D Printing Services</header>

  <div id="loginheader">
  <?php if( isset($_SESSION['loggedin'] )): ?>
    <p>
      You're logged in as: <?= $_SESSION['firstname']?> 
        <?=$_SESSION['lastname']?>
     </p>
     <p>
       <a href="viewAccount.php" class="loginheader">Profile</a>
       <a href="logout.php" class="loginheader">Logout</a>
     </p>
  <?php else:?>
    <form action="verifyLogin.php" method="post">
      <p>
        Login
        <label for="username"></label>
        <input type="text" pattern="\w+" required="required" 
               name="username"
               placeholder="Username" 
               id="username"/>

        <label for="password"></label>
        <input type="password" required="required" name="password"
               placeholder="Password" pattern="[^ ]{5,}" 
               id="password"/>
        <button type="submit" name="submit">Submit</button>
      </p>
    </form>
    <p class="loginheader">
      <a href="accountCreation.php" class="loginheader">Create Account</a>
      <a href="forgotpassword.php" class="loginheader">Forgot Password?</a>
    </p>

  <?php endif; ?>
  </div>
    
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
