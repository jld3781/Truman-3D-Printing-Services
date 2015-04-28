 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once( 'dbconnection.php' );

$isEditing = false;
$PrinterId;

//Handles a simple edit to a printer
if(isset($_POST['PrinterId']) && isset($_POST['submit'])
        && isset($_POST['Location']) && isset($_POST['MaximumHeight'])
        && isset($_POST['MaximumWidth']) && isset($_POST['MaximumLength'])):
  $PrinterId = htmlSpecialChars($_POST['PrinterId']);
  $Location = htmlSpecialChars($_POST['Location']);
  $MaximumHeight = htmlSpecialChars($_POST['MaximumHeight']);
  $MaximumWidth = htmlSpecialChars($_POST['MaximumWidth']);
  $MaximumLength = htmlSpecialChars($_POST['MaximumLength']);

  $sql = "UPDATE PRINTER
          SET Location = :Location, MaximumHeight = :MaximumHeight, 
            MaximumWidth = :MaximumWidth, MaximumLength = :MaximumLength
          WHERE PrinterId = :PrinterId";
  $statement = $db->prepare( $sql );
  $statement->bindParam( ':PrinterId', $PrinterId);
  $statement->bindParam( ':Location', $Location, PDO::PARAM_STR );
  $statement->bindParam( ':MaximumHeight', $MaximumHeight);
  $statement->bindParam( ':MaximumWidth', $MaximumWidth);
  $statement->bindParam( ':MaximumLength', $MaximumLength);
  $statement->execute();
elseif(isset($_POST['PrinterId']) && isset($_POST['edButton'])):
  $PrinterId = htmlspecialchars($_POST['PrinterId']);
  $isEditing = true;
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admin Page</title>
    <meta name="author" content="Samuel Livingston" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <?php include('nav.php');
      if( isset( $_SESSION['loggedin'] ) && 
                 $_SESSION['loggedin'] == true &&
                 $_SESSION['aflag'] == 'T'):
    ?>
    <section class="maincontent">
      <h1>Printer Menu</h1>
      <a href="admin1.php">Goto the Printing Queue</a>
      <a href="admin2.php">Goto Completed/Rejected Jobs</a>
      <table>
        <?php
          $sql = "SELECT PrinterId, Location, MaximumLength, 
                         MaximumWidth, MaximumHeight
                  FROM PRINTER";
          $statement = $db->prepare( $sql );
          $statement->execute();
          $result = $statement->fetchAll();

          ?><tr><?php
            ?><th>Printer ID</th>
              <th>Location</th>
              <th>MaximumLength</th>
              <th>MaximumWidth</th>
              <th>MaximumHeight</th>
              <th>
                <form action="addPrinter.php" method="post">
                  <button type="submit" name="addButton"> Add Printer </button>
                </form> 
              </th>
            </tr><?php

          //Display the printers
          $linecounter=0;
          foreach($result as $tuples):
          $linecounter++;
          ?><tr><?php
            $count = 1;
              if($isEditing == true && $PrinterId == $tuples['PrinterId']):
                ?><form action="editPrinters.php" method="post"><?php
                ?><td><?=$tuples['PrinterId']?></td><?php
                ?><td><input type="text"name="Location" value="<?=$tuples['Location']?>"
                  pattern="\w+" required /></td><?php
                ?><td><input type="number"name="MaximumLength" min="0" max="50000" step="any" value="<?=$tuples['MaximumLength']?>"
                  pattern="[0-9]{5}" required /></td><?php
                ?><td><input type="number"name="MaximumWidth" min="0" max="50000" step="any" value="<?=$tuples['MaximumWidth']?>"
                  pattern="[0-9]{5}" required /></td><?php
                ?><td><input type="number"name="MaximumHeight" min="0" max="50000" step="any" value="<?=$tuples['MaximumHeight']?>"
                  pattern="[0-9]{5}" required /></td><?php
                ?><td>
                  <input type="hidden" name="PrinterId" value="<?=$tuples['PrinterId']?>">
                  <button type="submit" name="submit"> Submit Change </button>
                </td>
              </form><?php
              else:
              ?><td><?=$tuples['PrinterId']?></td><?php
              ?><td><?=$tuples['Location']?></td><?php
              ?><td><?=$tuples['MaximumLength']?></td><?php
              ?><td><?=$tuples['MaximumWidth']?></td><?php
              ?><td><?=$tuples['MaximumHeight']?></td><?php
              ?><td>
                  <form action="editPrinters.php" method="post">
                    <input type="hidden" name="PrinterId" value="<?=$tuples['PrinterId']?>">
                    <button type="submit" name="edButton"> Edit </button>
                  </form>
                </td><?php
              endif;  
              $count++;
          ?></tr><?php
          endforeach;
          ?>
        </table>
    

        <?php elseif( isset( $_SESSION['loggedin'] ) && 
                 $_SESSION['loggedin'] == true &&
                 !($_SESSION['aflag'] == 1)):
        ?>
          <section>
            <h1>Access Denied</h1>
            <p>Sorry, you must be an admin to access this page.</p>
          </section>
        <?php else:
            $_SESSION['history'] = "Admin";
            header('Location: login.php');
          endif; 
        ?>
      </section>
  </body>
</html>

