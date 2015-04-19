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
                  WHERE Email = :username;"

        $statement = $db->prepare( $query );
        $statement->bindParam( ':email', $email, PDO::PARAM_STR );
        $statement->execute();
        
        $result = $statement->fetchAll();
        
        if( !empty($result) &&
            password_verify($_POST['password'], $result[0]['PasswordHash']):
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
          $error_msg = 'Username-password pair is invalid';
        endif;


        foreach( $lines as $line ):
          list( $username, $password, , , $firstname, $lastname, , $aflag) = 
                  explode( "\t", $line );
                  
          if( ($_POST['username'] == $username) && 
            (password_verify( $_POST['password'], $password ))):
            $_SESSION['username'] =  $username;
            $_SESSION['loggedin'] = true;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['aflag'] = $aflag;
            
            if( $_SESSION['history'] == "Print" ):
              header( 'Location: print.php' );
            elseif($_SESSION['history'] == "Admin" ):
              header( 'Location: admin.php' );
            else:
              header( 'Location: home.php' );
            endif;
            
          else:
            $error_msg = 'Username-password pair is invalid';
          endif;
          
        endforeach;
        
        
        
        
        
      else:
        $error_msg = 'You must enter a valid username-password pair';
      endif;
      
    endif;
    $_SESSION['error_msg'] = $error_msg;
    if( !($_SESSION['loggedin'] == true) ):
    header( 'Location: login.php' );
    endif;
  else:
    $_SESSION['error_msg'] = $error_msg;    
    header( 'Location: login.php' );
  endif;
?>
  
