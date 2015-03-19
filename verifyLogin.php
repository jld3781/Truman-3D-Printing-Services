<?php
  # Jessica DiMariano & Samuel Livingston
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  
  define('USER_DATABASE','users.txt');

  $error_msg = '';
  $filename = USER_DATABASE;
  $lines = file( $filename, FILE_IGNORE_NEW_LINES );
  array_shift($lines);

  if( !(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)):
    if( isset( $_POST['submit'] )):
      if( isset( $_POST['username'] ) && 
          preg_match( '|^\w+$|', $_POST['username'] ) &&
          isset( $_POST['password'] ) && 
          preg_match( '|^\S+$|', $_POST['password'] )):

        foreach( $lines as $line ):
          //$oneline = explode( "\t", $line);
          list( $username, $password, , , $firstname, $lastname, , $aflag) = explode( "\t", $line );
          //$currentUserName = $oneline[0];
          //$currentPass = $oneline[1];
          if( ($_POST['username'] == $username) && 
            (password_verify( $_POST['password'], $password ))):
            $_SESSION['username'] =  $currentUserName;
            $_SESSION['loggedin'] = true;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['aflag'] = $aflag;
            header( 'Location: home.php' );
          else:
            header( 'Location: login.php' );
            $error_msg = 'Username-password pair is invalid';
          endif;
        endforeach;
      else:
        $error_msg = 'You must enter a valid username-password pair';
      endif;
    else:
      header( 'Location: home.php' );
    endif;
  else:
    header( 'Location: login.php' );
  endif;
?>
