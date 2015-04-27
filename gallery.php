 <?php
  # Samuel Livingston
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  define( 'DEFINITION_FILENAME', 'gallery.txt' );

  
  $sort='';
  if(isset($_POST['sort']) &&
     $_POST['sort']=='By Author'):
    $sort = 'CreatorUsername';
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
        $query = "SELECT CreatorUsername, ProjectName, ProjectLink, Picture
                  FROM PROJECT as P
                     NATURAL JOIN PRINT_JOB as PJ
                  WHERE P.ProjectName = PJ.ProjectName AND 
                    PJ.Status = 'Completed'
                  ORDER BY $sort";
        $statement = $db->prepare( $query ); 
        $statement->execute();
        $result = $statement->fetchAll(); ?>
      <form method="post" action="gallery.php">
        <?php
        foreach( $result as $project ): 
          $link = 'http://bluesfest.no/site/bluesfest.no/design/layouts/images/no-image-placeholder.png?fh=250&fw=350'; 
          if($project['Picture']!=null):
            $link = $project['Picture'];
          endif;?>
            <ul class="galleryitems">
              <li>
                <img src="<?=$link?>" 
                alt="Picture of: <?=$project['ProjectName']?>" width="250" height="200"/>
              </li>
              <li>
                Link to: 
                <a href="<?=$project['ProjectLink']?>"><?=$project['ProjectName']?></a>
              </li>
              <li>Created by: <?=$project['CreatorUsername'] ?></li>
            </ul>
        <?php endforeach; ?>
      </form>
    </section>
    
    
  </body>
</html>
