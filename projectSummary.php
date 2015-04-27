<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  if(!isset($_POST['submit'])):
    header('Location: login.php');
  endif;
  $target_dir = "pictures/";
  $target_file = $target_dir . basename($_FILES["picture"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["picture"]["tmp_name"]);
  if($check !== false):
    if (!file_exists($target_file)):
      move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
    endif;
  else:
    $error_msg = "Not a file";
    header('Location: projectCreation.php');
  endif;
  $_SESSION['projectname'] = htmlspecialchars($_POST['projectName']);
  $_SESSION['projectlink'] = htmlspecialchars($_POST['projectLink']);
  $_SESSION['picture'] = $target_file;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="author" content="Jessica DiMariano" />
    <title>Project Summary</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  
  <body>
    <?php include( 'nav.php' ); ?>
    
    <section class="maincontent">
    
      <h1>Print Summary</h1>
      
      <ul id="print-summary-list">
        <li>Project Name: <?= $_SESSION['projectName'] ?></li>
        <li>Project Link: <?= $_SESSION['projectLink'] ?></li>
        <li>
          Project Picture: <img src="<?= $_SESSION['picture'] ?>" alt="Picture of: <?=$_SESSION['projectName']?>" width="250" height="200"/>
        </li>

      <form method="post" action="projectConfirmation.php">
        <button type="submit" name="submit">Submit Project</button>
      </form>
    </section>
  </body>
</html>
