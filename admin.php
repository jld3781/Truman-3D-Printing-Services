 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');

define( 'DEFINITION_FILENAME', 'printJobs.txt' );

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
        if( isset( $_POST['password'])):
          $password = $_POST['password'];
          if ($password === "abc123"):
        $lines = get_a_file( DEFINITION_FILENAME );
        #Handles the delete button
        $line_count=0;
        foreach( $lines as $line):
          if(isset($_POST["del$line_count"])):
            unset($lines[$line_count]);
            out_to_file( DEFINITION_FILENAME, $lines); 
          endif;
          $line_count = $line_count + 1;
        endforeach;
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
    
        <?php
        else:
        ?>
        <h2>Sorry you cannot access this page.</h2>
        <?php
        endif;
        else:
        ?>
        <h2>Please click on "Admin" in the navigation bar to enter a password
          and gain access to this page. </h2>
        <?php
        endif;
        ?>
      </section>
  </body>
</html>

