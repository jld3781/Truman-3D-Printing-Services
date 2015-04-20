 <?php
  # Samuel Livingston
  # Still waiting for javascript on this one
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
  
  
  if(isset($_POST['sort']) &&
     $_POST['sort']=='By Author'):
    $sort = 'CreatorEmail';
  else:
    $sort = 'ProjectName';
  endif;
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
      <form method="post" action="gallery.php">
        <!--
        <button type="submit" value="1" name="Recent">
          Most Recent
        </button>
       
        <button type="submit" value="1" name="Popular">
          Most Popular
        </button>
        <button type="submit" value="1" name="Featured">
          Featured
        </button>
        -->
        <select name="sort">
          <option value="By Name">By Name</option>
          <option value="By Author">By Author</option>
        </select>
        <button type="submit" name="submit">
          Sort
        </button>
      </form>
    </aside>
    
    <section id="gallery">

      <h1>Gallery</h1>
      
      <?php
        require_once( 'dbconnection.php' );
        $query = "SELECT CreatorEmail, ProjectName, ProjectLink, Picture
                  FROM PROJECT
                  ORDER BY $sort";
        $statement = $db->prepare( $query );
        $statement->execute();
        $result = $statement->fetchAll(); ?>
      <form method="post" action="gallery.php">
        <?php
        foreach( $result as $project ): ?>
            <ul class="galleryitems">
              <li>
                <img src="<?=$project['Picture']?>" 
                alt="Picture of: <?=$project['ProjectName']?>" width="250" height="200"/>
              </li>
              <li>
                Link to: 
                <a href="<?=$project['ProjectLink']?>"><?=$project['ProjectName']?></a>
              </li>
              <li>Created by: <?=$project['CreatorEmail'] ?></li>
            </ul>
        <?php endforeach; ?>
      </form>
    </section>
    
    
  </body>
</html>
