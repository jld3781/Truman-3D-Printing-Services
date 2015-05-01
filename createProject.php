<?php
  # Jimmy Sorsen
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();
  require_once('dbconnection.php');
  if( isset( $_SESSION['loggedin'] ) && 
             $_SESSION['loggedin'] == true):
      
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="author" content="Jessica, Sam, Jimmy" />
    <title>Create a Project</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php include('nav.php'); ?>
    
    <section class="maincontent">
    
      <h1>Create a Project</h1>
        
      <form method="post" action="projectSummary.php" enctype="multipart/form-data">
      
        <fieldset>
          <label for="projectName" title="Create a name for your project.">
            Project Name
          </label>
          <input type="text" id="projectname" name="projectname" 
                   pattern="^[a-zA-Z0-9][a-z A-Z0-9_-]+$" required="required" />
        </fieldset>
       
       <fieldset>
          <label for="projectlink" title="Provide a link to your project file.">
            Project Link
          </label>
          <input type="text" id="projectlink" name="projectlink" 
                   pattern="A-Za-z0-9!#$%&'()*+,\-./:;<=>?@_~" required="required" />
        </fieldset>

        <fieldset>
          <label for="picture" title="Provide a picture for your project.">
            Project Picture
          </label>
          <input type="file" name="picture" id="picture">
        </fieldset>
        
        <button type="submit" id="submit" name="submit">Next</button>
        
      </form>
    </section>
    <script src="inputValidation.js"></script>
  </body>
</html>
<?php
  else:
    $_SESSION['history'] = "Project";
    header('Location: login.php');
  endif;
?>
