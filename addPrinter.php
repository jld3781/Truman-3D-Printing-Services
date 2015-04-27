 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once( 'dbconnection.php' );

//Handles a change in job Status
if(isset($_POST['submit']) && isset($_POST['Location'])
  && isset($_POST['MaximumHeight']) && isset($_POST['MaximumLength'])
  && isset($_POST['MaximumWidth']) && isset($_POST['abscolor'])
  && isset($_POST['placolor'])):
    $absColors = $_POST['abscolor'];
    $plaColors = $_POST['placolor'];
    $Location = $_POST['Location'];
    $MaximumHeight = $_POST['MaximumHeight'];
    $MaximumLength = $_POST['MaximumLength'];
    $MaximumWidth = $_POST['MaximumWidth'];

    $sql = "insert into PRINTER(Location, MaximumLength, MaximumWidth, 
             MaximumHeight) VALUES(:Location, :MaximumLength, 
             :MaximumWidth, :MaximumHeight)";
    $statement = $db->prepare( $sql );
    $statement->bindParam( ':Location', $Location, PDO::PARAM_STR );
    $statement->bindParam( ':MaximumHeight', $MaximumHeight);
    $statement->bindParam( ':MaximumWidth', $MaximumWidth);
    $statement->bindParam( ':MaximumLength', $MaximumLength);
    $statement->execute();

    $sql = "SELECT PrinterId
            FROM PRINTER
            ORDER BY PrinterId DESC
            LIMIT 1";
    $statement = $db->prepare( $sql );
    $statement->execute();
    $result = $statement->fetchAll();

    $printerId = $result[0]["PrinterId"];
    echo($printerId);

    $sql = "insert into CAN_PRINT(Color, Type, PrinterId) 
            VALUES(:Color, :Type, :PrinterId)";
    $statement->bindParam( ':PrinterId', $printerId);
    $statement->bindValue( ':Type', 'ABS');
    if (!empty($absColors)):
      foreach($absColors as $value):
        $statement->bindParam( ':Color', $value);
        $statement->execute();
      endforeach;
    endif;

    $statement->bindValue( ':Type', "PLA");
    if (!empty($plaColors)):
      foreach($plaColors as $value):
        $statement->bindParam( ':Color', $value);
        $statement->execute();
      endforeach;
    endif;
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
      <h1>Add Printer</h1>
      <form action="addPrinter.php" method="post">
        <fieldset>
          <label for="Location" title="Enter the building the printer will be located in.">
            Printer Location
          </label>
          <input type="text"name="Location" pattern="\w+" required />

          <label for="MaximumLength" title="Enter the max length the machine is capable of.">
            Maximum Length
          </label>
          <input type="number"name="MaximumLength" min="0" max="50000" step="any" pattern="[0-9]{5}" required />

          <label for="MaximumWidth" title="Enter the max width the machine is capable of.">
            Maximum Width
          </label>
          <input type="number"name="MaximumWidth" min="0" max="50000" step="any" pattern="[0-9]{5}" required />

          <label for="MaximumHeight" title="Enter the max height the machine is capable of.">
            Maximum Height
          </label>
            <input type="number"name="MaximumHeight" min="0" max="50000" step="any" pattern="[0-9]{5}" required />
        </fieldset>

        <h2>Filament Type & Colors</h2>
        <h3>ABS</h3>
        <fieldset>
        <input type="checkbox" name="abscolor[]" value="Red" checked="checked">
          <img src="Colors/RedBox.png" alt="RedBox" width="40" height="40"/>
        <input type="checkbox" name="abscolor[]" value="Purple" checked="checked">
          <img src="Colors/PurpleBox.png" alt="PurpleBox" width="40" height="40"/>
        <input type="checkbox" name="abscolor[]" value="Green" checked="checked">
          <img src="Colors/GreenBox.png" alt="GreenBox" width="40" height="40"/>
        <input type="checkbox" name="abscolor[]" value="Orange" checked="checked">
          <img src="Colors/OrangeBox.png" alt="OrangeBox" width="40" height="40"/>
        <input type="checkbox" name="abscolor[]" value="Blue" checked="checked">
          <img src="Colors/BlueBox.png" alt="BlueBox" width="40" height="40"/>
        <input type="checkbox" name="abscolor[]" value="Gold" checked="checked">
          <img src="Colors/GoldBox.png" alt="GoldBox" width="40" height="40"/>
        <input type="checkbox" name="abscolor[]" value="Gray" checked="checked">
          <img src="Colors/GrayBox.png" alt="GrayBox" width="40" height="40"/>
        <input type="checkbox" name="abscolor[]" value="White" checked="checked">
          <img src="Colors/WhiteBox.png" alt="WhiteBox" width="40" height="40"/>
        <input type="checkbox" name="abscolor[]" value="Black" checked="checked">
          <img src="Colors/BlackBox.png" alt="BlackBox" width="40" height="40"/>
        </fieldset>

        <h3>PLA</h3>
        <fieldset>
        <input type="checkbox" name="placolor[]" value="Red" checked="checked">
          <img src="Colors/RedBox.png" alt="RedBox" width="40" height="40"/>
        <input type="checkbox" name="placolor[]" value="Purple" checked="checked">
          <img src="Colors/PurpleBox.png" alt="PurpleBox" width="40" height="40"/>
        <input type="checkbox" name="placolor[]" value="Green" checked="checked">
          <img src="Colors/GreenBox.png" alt="GreenBox" width="40" height="40"/>
        <input type="checkbox" name="placolor[]" value="Orange" checked="checked">
          <img src="Colors/OrangeBox.png" alt="OrangeBox" width="40" height="40"/>
        <input type="checkbox" name="placolor[]" value="Blue" checked="checked">
          <img src="Colors/BlueBox.png" alt="BlueBox" width="40" height="40"/>
        <input type="checkbox" name="placolor[]" value="Gold" checked="checked">
          <img src="Colors/GoldBox.png" alt="GoldBox" width="40" height="40"/>
        <input type="checkbox" name="placolo[]r" value="Gray" checked="checked">
          <img src="Colors/GrayBox.png" alt="GrayBox" width="40" height="40"/>
        <input type="checkbox" name="placolo[]r" value="White" checked="checked">
          <img src="Colors/WhiteBox.png" alt="WhiteBox" width="40" height="40"/>
        <input type="checkbox" name="placolo[]r" value="Black" checked="checked">
          <img src="Colors/BlackBox.png" alt="BlackBox" width="40" height="40"/>
        </fieldset>
        <fieldset>
          <input type="submit" name="submit">
        </fieldset>
      </form>
      <a href="editPrinters.php"> Go Back</a>
    
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

