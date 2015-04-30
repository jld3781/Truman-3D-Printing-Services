 <?php
  # Samuel Livingston
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  define( 'DEFINITION_FILENAME', 'gallery.txt' );

  
  $sort='';
  if(isset($_GET['sort']) &&
     $_GET['sort']=='byauthor'):
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
      <select id="sort" name="sort">
        <option id="byname" value="byname">By Name</option>
        <option id="byauthor" value="byauthor">By Author</option>
      </select>
    </aside>
    
    <section id="gallery">

      <?php include('getOrderedGallery.php'); ?>
      
    </section>
    
    <script src="gallery.js"></script>
  </body>
</html>
