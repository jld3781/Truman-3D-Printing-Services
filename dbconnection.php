<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once( '../../cs315/dblogin.php' );
  $db = new PDO(
  "mysql:host=$db_hostname;dbname=$db_username;charset=utf8",
  $db_username, $db_password,
  array(PDO::ATTR_EMULATE_PREPARES => false,
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>
