<?php 
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  $loggedin = false;
?>

  <header>Truman 3D Printing Services</header>

  <div id="loginheader">
  <?php if( $loggedin ): ?>
    <p>
      You're logged in as: <?= $_SESSION['firstname']?>
     </p>
     <p>
       <a href="logout.php">Logout</a>
     </p>
  <?php else:?>
    <form action="profile.php" method="post">
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
      <a href="accountCreate.php" class="loginheader">Create Account</a>
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
    </ul>  
  </nav>  
