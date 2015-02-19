 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');

define( 'DEFINITION_FILENAME', 'gallery.txt' );

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
    <title>Gallery Page</title>
    <meta name="author" content="Samuel Livingston" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
  <?php
    include('nav.html');
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

    <h1>Gallery</h1>

    <form method="post" action="admin.php">
      <?php $lines = get_a_file( DEFINITION_FILENAME ); ?>
        <ul>
        <?php
          $line_count = 0;
          foreach( $lines as $line ):
          list($projectname, $projectlink, $weight,
            $color, $dateadded) =
             explode( "\t", $line ); ?>
            <li>
            <a href="<?=$projectlink?>"> Link to: <?=$projectname?> </a>
            </li>
            <li>
            <img src="http://products.boysstuff.co.uk/prod_zoom_right/tnt-plunger.jpg" alt="Picture of: <?=$projectname?>" width="250" height="200"/>
            </li>
            <li>
            <?="Weight: $weight" ?>
            </li>
            <li>
            <?="Color: $color" ?>
            </li>
            <li>
            <?="Date Added: $dateadded" ?>
            </li>
          <hr></hr>
          <?php
          $line_count++;
          endforeach;
        ?>
        </ul>
    </form>

    <aside>
      <ul>
        <li>
          Most Recent
        </li>
        <li>
          Most Popular
        </li>
        <li>
          Featured
        </li>
        <li>
          Alphabetical
        </li>
      </ul>
    </aside>
  </body>
</html>

