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
        
      <form method="post" action="savePrintDetails.php">
      
        <fieldset>
          <label for="firstName">First Name</label>
          <input type="text" name="firstName" required />
        </fieldset>
        
        <fieldset>
          <label for="lastName">Last Name</label>
          <input type="text" name="lastName" required />
        </fieldset>
        
        <fieldset>
          <label for="studentId">Student ID</label>
          <input type="number" name="studentId" required />
        </fieldset>
        
        <fieldset>
          <label for="email">Email</label>
          <input type="email" name="email" required />
        </fieldset>
        
        <fieldset>
          <label for="tel">Phone</label>
          <input type="text" name="phone" required />
        </fieldset>
        
        <fieldset>
          <label for="projectName" title="Create a name for your project.">
            Project Name
          </label>
          <input type="text" name="projectName" required />
        </fieldset>
       
       <fieldset>
          <label for="projectLink" title="Provide a link to your project file.">
            Project Link
          </label>
          <input type="text" name="projectLink" required />
        </fieldset>
        
        <fieldset>
          <label for="weight" 
          title="Enter the weight(in grams) for your project to be printed at.">
            Weight
          </label>
          <input type="number" name="weight" required />
          grams
        </fieldset>
        
        <fieldset>
          <label for="color">Color</label>
          <select name="color" required>
            
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
          <textarea type="text" name="comments"></textarea>
        </fieldset>
        
        <button type="submit" name="printDetails">Next</button>
        
      </form>
    </section>
  </body>
</html>
