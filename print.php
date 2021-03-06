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
    <?php include('nav.php'); ?>
    
    <section class="maincontent">
    
      <h1>Print a Project</h1>
        
      <form method="post" action="printSummary.php">
      
        <fieldset>
          <label for="project">Project</label>
          <?php if(isset($_POST['projectname'])): 
            $project = "".$_POST['projectname']." by ".$_POST['creatorusername'];
            $projectdetails = $_POST['projectname']."\t".$_POST['creatorusername'];?>
          <select name="project" id="project" required="required">
            <option value="<?= $projectdetails ?>" selected="selected">
              <?=$project?>
            </option>
          <?php else: ?>
          <select name="project" id="project" required="required">
            <option value="" selected="selected" 
                      disabled="disabled">Choose a Project</option>
            <?php
              $sql = "SELECT ProjectName, CreatorUsername FROM PROJECT ORDER BY ProjectName";
              $stmt = $db -> prepare($sql);
              $stmt->execute();
              $rows = $stmt->fetchAll();
              foreach($rows as $row):
                $project = "".$row['ProjectName']." by ".$row['CreatorUsername'];
                $projectdetails = $row['ProjectName']."\t".$row['CreatorUsername'];
            ?>
                <option value="<?=$projectdetails?>"><?=$project?></option>
            <?php 
              endforeach;
            ?>
          <?php endif; ?>
              
          </select>
        </fieldset>
     
        <fieldset>
          <label for="length" 
          title="Enter the length(in inches) for your project to be printed at.">
            Length (inches)
          </label>
          <input type="number" id="length" name="length" min="0" max="50000" 
                  step="any"/>
        </fieldset>

        <fieldset>
          <label for="width" 
          title="Enter the width(in inches) for your project to be printed at.">
            Width (inches)
          </label>
          <input type="number" id="width" name="width" min="0" max="50000" 
                  step="any"/>
        </fieldset>

        <fieldset>
          <label for="height" 
          title="Enter the height(in inches) for your project to be printed at.">
            Height (inches)
          </label>
          <input type="number" id="height" name="height" min="0" max="50000" 
                  step="any" />
        </fieldset>
        
        <fieldset>
          <label for="weight" 
          title="Enter the weight(in pounds) for your project to be printed at.">
            Weight (lbs)
          </label>
          <input type="number" id="weight" name="weight" min="0" max="50000" 
                  step="any" />
        </fieldset>

        <fieldset>
          <label for="material">Material</label>
          <select name="material" id="material" required="required">
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
          <select name="color" id="color" required="required">
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
        
        <button type="submit" name="submit">Next</button>
        
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
