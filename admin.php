 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');

define( 'DEFINITION_FILENAME', 'printJobs.txt' );
define('USER_DATABASE','users.txt');

/* Read a file of text, strip newlines
return the file as an array of lines */
function get_a_file( $filename )
{
  $lines = file( $filename, FILE_IGNORE_NEW_LINES );
  $firstLine = array_shift($lines);
  return $lines;
}

function out_to_file( $filename , $lines )
{
  file_put_contents(DEFINITION_FILENAME, "");
  foreach( $lines as $line ):
    file_put_contents(DEFINITION_FILENAME, trim($line) . PHP_EOL, FILE_APPEND);
  endforeach;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admin Page</title>
    <meta name="author" content="Samuel Livingston" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <?php include('nav.php'); ?>
      <section class="maincontent">
        <?php
        
        $lines = file( USER_DATABASE, FILE_IGNORE_NEW_LINES );
        array_shift( $lines );

        foreach( $lines as $line ):
          list( $username, , , , , , , $admin) = explode( "\t", $line );
          if( !($_SESSION['username'] == trim( $username ) ) ):
            $admin = false;
          endif;
        endforeach;
               
        $admin = true; #for testing purposes
        
        if( isset( $_SESSION['loggedIn'] ) && 
                  $_SESSION['loggedIn'] == true &&
                  $admin == true):
        ?>

        <h1>Printing Queue</h1>
        <table>
          <?php
            $lines = file( DEFINITION_FILENAME );
            $firstLine = array_shift($lines);
            
            $words = explode( "\t", $firstLine );
            echo "<tr>";
            foreach($words as $word):
              echo "<th>$word</th>";
            endforeach;
            echo "</tr>";
            
            foreach($lines as $line):
            echo "<tr>";
              $words = explode( "\t", $line );
              $count = 1;
              foreach($words as $word):
                if($count == 9):
                  echo "<td><select name=\"status\">
  -                  <option value=\"current\">$word</option>
  -                  <option value=\"waiting\">Waiting</option>
  -                  <option value=\"hold\">On Hold</option>
  -                  <option value=\"printing\">Printing</option>
  -                  <option value=\"completed\">Completed</option>
  -                </select></td>";
                else:  
                  echo "<td>$word</td>";
                endif;
                $count++;
              endforeach;
            echo "</tr>";
            endforeach;
          ?>
        </table>
    
        <?php else: ?>
          <h2>Sorry you cannot access this page.</h2>
        <?php endif; ?>
        
      </section>
  </body>
</html>

