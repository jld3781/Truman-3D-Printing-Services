<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  
  define('USER_DATABASE','users.txt');
  
  $lines = file( USER_DATABASE, FILE_IGNORE_NEW_LINES );
  array_shift($lines);

  foreach( $lines as $line ):
    list( $username, , , , $firstname, $lastname, , ) = explode( "\t", $line );
    if( $_POST['username'] == trim( $username ) ):
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['loggedIn'] = true;
      $_SESSION['firstname'] = $firstname;
      $_SESSION['lastname'] = $lastname;
      header( 'Location: home.php' );
    else:
      header( 'Location: login.php' );
    endif;
  endforeach;
  
/*
  if( $existingUser ):
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['loggedIn'] = true;
    header( 'Location: home.php' );
  else:
    header( 'Location: login.php' );
  endif;
    */
?>
