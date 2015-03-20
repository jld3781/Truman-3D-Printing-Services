 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('PRINTJOB_DATABASE', 'printJobs.txt' );
define('USER_DATABASE','users.txt');

/* Read a file of text, strip newlines
return the file as an array of lines */
function get_a_file( $filename )
{
  $lines = file( $filename, FILE_IGNORE_NEW_LINES );
  return $lines;
}

function out_to_file( $filename , $lines )
{
  file_put_contents($filename, "");
  foreach( $lines as $line ):
    file_put_contents($filename, trim($line) . PHP_EOL, FILE_APPEND);
  endforeach;
}

if(isset($_POST['status']) && isset($_POST['linenum'])):
  $linenum = $_POST['linenum'];
  $status = $_POST['status'];
  $lines = get_a_file(PRINTJOB_DATABASE);
  $linecount = 0;
  foreach($lines as $line):
    if( $linenum == $linecount):
      $oneline = explode( "\t", $line );
      $oneline[4] = $status;
      $lines[$linecount] = "$oneline[0]\t$oneline[1]\t$oneline[2]\t$oneline[3]\t$oneline[4]\t$oneline[5]\t$oneline[6]\t$oneline[7]";
    endif;
    $linecount++;
  endforeach;
  out_to_file(PRINTJOB_DATABASE, $lines);
endif;
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
    <?php include('nav.php');
      if( isset( $_SESSION['loggedin'] ) && 
                 $_SESSION['loggedin'] == true &&
                 $_SESSION['aflag'] == 1):
    ?>
    <section class="maincontent">
      <h1>Printing Queue</h1>
      <table>
        <?php
          $lines = file( PRINTJOB_DATABASE );
          $firstLine = array_shift($lines);
            
          //Print Table Header
          $words = explode( "\t", $firstLine );
          echo "<tr>";
          foreach($words as $word):
            echo "<th>$word</th>";
          endforeach;
          echo "</tr>";
            
          //Print Table Contents
          $linecounter=0;
          foreach($lines as $line):
          $linecounter++;
          echo "<tr>";
            $words = explode( "\t", $line );
            $count = 1;
            foreach($words as $word):
              if($count == 5):
                ?> <td>
                  <form action="admin.php" method="post">
                    <select name="status">
                      <option value="<?=$word?>">Current: <?=$word?></option>
                      <option value="Waiting">Waiting</option>
                      <option value="Printing">Printing</option>
                      <option value="Completed">Completed</option>
                      <option value="On Hold">On Hold</option>
                    </select>
                    <input type="hidden" name="linenum" value="<?=$linecounter?>">
                    <button type="submit" name="submit">Submit</button>
                  </form>
                  </td>
                <?php
              else:  
                echo "<td>$word</td>";
              endif;
                $count++;
              endforeach;
            echo "</tr>";
            endforeach;
          ?>
        </table>
    
        <?php elseif( isset( $_SESSION['loggedin'] ) && 
                 $_SESSION['loggedin'] == true &&
                 !($_SESSION['aflag'] == 1)):
        ?>
          <section>
            <h1>Access Denied</h1>
            <p>Sorry, you must be an admin to access this page.</p>
          </section>
        <?php else:
            $_SESSION['history'] = "Admin";
            header('Location: login.php');
          endif; 
        ?>
        
      </section>
  </body>
</html>

