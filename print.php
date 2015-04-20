<?php
  # Jessica DiMariano
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
    <title>Print a Project</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  
  <body>
    <?php
      include('nav.php');
    ?>
    
    <section class="maincontent">
    
      <h1>Print a Project</h1>
        
      <form method="post" action="printSummary.php">
      
        <fieldset>
          <label for="projectName" title="Create a name for your project.">
            Project Name
          </label>
          <input type="text" id="projectName" name="projectName" 
                   pattern="^[a-zA-Z][a-zA-Z0-9_-]+$" required />
        </fieldset>
       
       <fieldset>
          <label for="projectLink" title="Provide a link to your project file.">
            Project Link
          </label>
          <input type="text" id="projectLink" name="projectLink" 
                   pattern="A-Za-z0-9!#$%&'()*+,\-./:;<=>?@_~" required />
        </fieldset>
        
        <fieldset>
          <label for="weight" 
          title="Enter the weight(in grams) for your project to be printed at.">
            Weight (g)
          </label>
          <input type="number" id="weight" name="weight" min="0" max="50000" 
                  required />
        </fieldset>

        <fieldset>
          <label for="material">Material</label>
          <select name="material" id="material" required>
            <option value="" selected="selected" 
                      disabled="disabled">Choose a Material</option>
            <?php
              $sql = "SELECT Type FROM FILAMENT GROUP BY Type;";
              $stmt = $db -> prepare($sql);
              $stmt->execute();
              $rows = $stmt->fetchAll();
              foreach($rows as $row):
                $material = $row['Type'];
            ?>
                <option value="<?=$material?>"><?=$material?></option>
            <?php 
              endforeach;
            ?>
              
          </select>
        </fieldset>


        
        <fieldset>
          <label for="color">Color</label>
          <select name="color" id="color" required>
            <option value="" selected="selected" 
                      disabled="disabled">Choose a Color</option>
            <?php
              $sql = "SELECT Color FROM FILAMENT GROUP BY Color;";
              $stmt = $db -> prepare($sql);
              $stmt->execute();
              $rows = $stmt->fetchAll();
              foreach($rows as $row):
                $color = $row['Color'];
            ?>
                <option value="<?=$color?>"><?=$color?></option>
            <?php 
              endforeach;
            ?>
              
          </select>
        </fieldset>
        
        <fieldset>
          <label for="comments">Comments</label>
          <textarea name="comments" id="comments"></textarea>
        </fieldset>
        
        <button type="submit" name="printDetails">Next</button>
        
      </form>
    </section>
  </body>
</html>
<?php
  else:
    $_SESSION['history'] = "Print";
    header('Location: login.php');
  endif;
?>
