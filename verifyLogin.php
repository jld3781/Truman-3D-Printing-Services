<?php
  # Jessica DiMariano & Samuel Livingston
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  
  $error_msg = '';
  
  if( !(isset($_SESSION['loggedin']))):
  
    if( isset( $_POST['submit'] )):
    
      if( isset( $_POST['username'] ) && 
          preg_match( '|^\w+$|', $_POST['username'] ) &&
          isset( $_POST['password'] ) && 
          preg_match( '|^\S+$|', $_POST['password'] )):

        require_once( 'dbconnection.php' );
        
        $username = $_POST['username'];
        $query = "SELECT Username, FirstName, LastName, AdminFlag, PasswordHash
                  FROM USER
                  WHERE Username = :username";

        $statement = $db->prepare( $query );
        $statement->bindParam( ':username', $username, PDO::PARAM_STR );
        $statement->execute();
        $result = $statement->fetchAll();
        
        if( !empty($result) &&
            password_verify($_POST['password'], $result[0]['PasswordHash'])):
          $_SESSION['username'] =  $username;
          $_SESSION['loggedin'] = true;
          $_SESSION['firstname'] = $result[0]['FirstName'];
          $_SESSION['lastname'] = $result[0]['LastName'];
          $_SESSION['aflag'] = $result[0]['AdminFlag'];
          
          
          if( $_SESSION['history'] == "Print" ):
            header( 'Location: print.php' );
          elseif($_SESSION['history'] == "Admin" ):
            header( 'Location: admin.php' );
          else:
            header( 'Location: home.php' );
          endif;
        else:
          if( empty($result) ):
            $error_msg = 'Username not found';
          else:
            $error_msg = 'Password does not match';
          endif;
        endif;
      else:
        $error_msg = 'You must enter a valid username-password pair';
      endif;
      
    endif;
    $_SESSION['error_msg'] = $error_msg;
    if( !isset($_SESSION['loggedin']) ||
        !($_SESSION['loggedin'] == true) ):
      header( 'Location: login.php' );
    endif;
  else:
    $_SESSION['error_msg'] = $error_msg;    
    header( 'Location: login.php' );
  endif;
?>
  
