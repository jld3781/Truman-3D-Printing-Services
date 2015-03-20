 <?php
//Samuel Livingston
session_start();

$_SESSION = array();
setcookie( session_name(), '', time() - 3600 );
session_destroy();

header( 'Location: home.php' );
?>

