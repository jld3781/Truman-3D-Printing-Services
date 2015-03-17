<?php
  # Jessica DiMariano
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
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
      include('nav.html');
      define( 'AVAILABLE_COLORS', 'colors.txt' );
    ?>
    
    <section class="maincontent">
    
      <h1>Print a Project</h1>
        
      <form method="post" action="printSummary.php">
      
        <fieldset>
          <label for="projectName" title="Create a name for your project.">
            Project Name
          </label>
          <input type="text" id="projectName" name="projectName" required />
        </fieldset>
       
       <fieldset>
          <label for="projectLink" title="Provide a link to your project file.">
            Project Link
          </label>
          <input type="text" id="projectLink" name="projectLink" required />
        </fieldset>
        
        <fieldset>
          <label for="weight" 
          title="Enter the weight(in grams) for your project to be printed at.">
            Weight (g)
          </label>
          <input type="number" id="weight" name="weight" required />
        </fieldset>
        
        <fieldset>
          <label for="color">Color</label>
          <select name="color" id="color" required>
            
            <?php 
              $availableColors = file(AVAILABLE_COLORS);
              $placeholder = array_shift($availableColors);
              
              echo "<option value=\"\" selected=\"selected\" 
                      disabled=\"disabled\">$placeholder</option>";
              foreach($availableColors as $color):
                $color = trim($color);
                echo "<option value=\"$color\">$color</option>";
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
