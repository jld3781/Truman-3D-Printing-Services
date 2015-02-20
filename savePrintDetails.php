<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  session_start();

  $_SESSION['firstName'] = $_POST['firstName'];
  $_SESSION['lastName'] = $_POST['lastName'];
  $_SESSION['studentId'] = $_POST['studentId'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['phone'] = $_POST['phone'];
  $_SESSION['projectName'] = $_POST['projectName'];
  $_SESSION['projectLink'] = $_POST['projectLink'];
  $_SESSION['weight'] = $_POST['weight'];
  $_SESSION['color'] = $_POST['color'];
  $_SESSION['comments'] = $_POST['comments'];

  header( 'Location: printSummary.php' ) ;
  exit;
?>