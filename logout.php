 <?php
//Samuel Livingston - Assignment 304
session_start();

$_SESSION = array();
setcookie( session_name(), '', time() - 3600 );
session_destroy();

header( 'Location: home.php' );
?>

