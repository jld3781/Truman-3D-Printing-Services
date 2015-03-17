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
    <?php include('nav.php'); ?>
    
    <aside>
      <h2>Filter</h2>
      <button type="submit" value="1">Most Recent</button>
      <button type="submit" value="1">Most Popular</button>
      <button type="submit" value="1">Featured</button>
      <button type="submit" value="1">Alphabetical</button>
      <p>Buttons have no functionality until javascript implementation</p>
    </aside>
    
    <section id="gallery">

      <h1>Gallery</h1>
      
      <?php
        $lines = get_a_file( DEFINITION_FILENAME );
        #Handles the delete button
        $line_count = 0;
        foreach( $lines as $line):
          if(isset($_POST["del$line_count"])):
            unset($lines[$line_count]);
          endif;
          $line_count = $line_count + 1;
        endforeach;
        out_to_file( DEFINITION_FILENAME, $lines); 
      ?>

      <form method="post" action="gallery.php">
        <?php $lines = get_a_file( DEFINITION_FILENAME ); 
          $line_count = 0;
          foreach( $lines as $line ):
            list($projectname, $projectlink, $weight, $color, $dateadded) =
             explode( "\t", $line ); ?>
            <ul class="galleryitems">
              <li>
                <img src="http://products.boysstuff.co.uk/prod_zoom_right/tnt-plunger.jpg" 
                alt="Picture of: <?=$projectname?>" width="250" height="200"/>
              </li>
              <li>
                Link to: 
                <a href="<?=$projectlink?>"><?=$projectname?></a>
              </li>
              <li><?="Weight: $weight" ?></li>
              <li><?="Color: $color" ?></li>
              <li><?="Date Added: $dateadded" ?></li>
            </ul>
        <?php
          $line_count++;
          endforeach;
        ?>
      </form>
    </section>
    
    
  </body>
</html>

