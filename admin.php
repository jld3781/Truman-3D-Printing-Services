 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');

define( 'DEFINITION_FILENAME', 'admin.txt' );

/* Read a file of text, strip newlines
return the file as an array of lines */
function get_a_file( $filename )
{
  $lines = file( $filename, FILE_IGNORE_NEW_LINES );
  return $lines;
}

function out_to_file( $filename , $lines )
{
  asort($lines);
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
  <?php
    include('nav.html');
    if( isset( $_POST['password'])):
      $password = $_POST['password'];
      if ($password === "abc123"):
    $lines = get_a_file( DEFINITION_FILENAME );
    #Handles the delete button
    $line_count=0;
    foreach( $lines as $line):
      if(isset($_POST["del$line_count"])):
        unset($lines[$line_count]);
      endif;
      $line_count = $line_count + 1;
    endforeach;
    out_to_file( DEFINITION_FILENAME, $lines); 
  ?>

    <h1>Manage Printing Queue</h1>

    <form method="post" action="admin.php">
      <?php $lines = get_a_file( DEFINITION_FILENAME ); ?>
        <ul>

        <?php
          $line_count = 0;
          foreach( $lines as $line ):
          list( $firstname, $lastname, $studentid, $email, $phonenum,
            $projectname, $projectid, $projectlink, $status, $weight,
            $color, $comment ) =
             explode( "\t", $line ); ?>
            <li>
              <?= "$firstname $lastname ,  $email ,  $phonenum"?>
            </li>
            <li>
            <img src="http://products.boysstuff.co.uk/prod_zoom_right/tnt-plunger.jpg" alt="Picture of: <?=$projectname?>" width="250" height="200"/>
            </li>
            <li>
            <a href="<?=$projectlink?>"> Link to: <?=$projectname?> </a>
            </li>
            <li>
            <?="$projectid, $weight, $color, Current Status: $status" ?>
            </li>
            <li>
            Comment: <?=$comment?>
            </li>
            <li>
              <label for="status">Status:</label>
              <select name="status">
                <option value="current">Current:<?=$status?></option>
                <option value="waiting">Waiting</option>
                <option value="hold">On Hold</option>
                <option value="printing">Printing</option>
                <option value="completed">Completed</option>
              </select>
            <button type="submit" class="delbut" value="1"
                  name="del<?= $line_count ?>">
            Delete
            </button>
            </li>

          <hr></hr>
          <?php
          $line_count++;
          endforeach;
        ?>
        </ul>
    </form>
  <?php
  else:
  ?><h2>Sorry you cannot access this page.</h2><?php
  endif;
  else:
  ?><h2>Please click on "Admin" in the navigation bar to enter a password
    and gain access to this page. </h2><?php
  endif;
  ?>
  </body>
</html>

