 <?php
# Samuel Livingston
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once( 'dbconnection.php' );
define('PRINTJOB_HEADERS_FILE', 'printQueueHeaders.txt' );

//Handles a change in job Status
if(isset($_POST['status']) && isset($_POST['jobId'])):
  $jobId = htmlspecialchars($_POST['jobId']);
  $status = htmlspecialchars($_POST['status']);

  if($_POST['status'] == 'Completed' || $_POST['status'] == 'Rejected'):
  $sql = "UPDATE PRINT_JOB
            SET Status = :status, StopTime = NOW() 
            WHERE JobId = :jobId";
  elseif($_POST['status'] == 'Printing'):
  $sql = "UPDATE PRINT_JOB
            SET Status = :status, StartTime = NOW() 
            WHERE JobId = :jobId";
  endif;
  $statement = $db->prepare( $sql );
  $statement->bindParam( ':status', $status, PDO::PARAM_STR );
  $statement->bindParam( ':jobId', $jobId, PDO::PARAM_STR );
  $statement->execute();
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
      <h1>Printing Queue</h1>
      <a href="admin2.php">Goto Completed/Rejected Jobs</a>
      <a href="editPrinters.php">Add/Edit Printers</a>
      <table>
        <?php
          $lines = file( PRINTJOB_HEADERS_FILE );
          $firstLine = array_shift($lines);
            
          //Print Table Header
          $words = explode( "\t", $firstLine );
          ?><tr><?php
          foreach($words as $word):
            ?><th><?=$word?></th><?php
          endforeach;
          ?></tr><?php
          
          //Pulls in all print jobs that aren't completed or rejected
          $query = "SELECT JobId, PrinterEmail, PJ.ProjectName, Status,
                      StartTime, StopTime, SubmittedTime, Length, Width, Height,
                      Color, MaterialType, Weight, ChargedPrice, Comment,
                      P.ProjectLink
                    FROM PRINT_JOB as PJ 
                      NATURAL JOIN PROJECT as P
                    WHERE Status <> 'Rejected' AND Status <> 'Completed'
                    ORDER BY SubmittedTime";
          $statement = $db->prepare( $query );
          $statement->execute();
          $result = $statement->fetchAll();

          //Print Table Contents
          $linecounter=0;
          foreach($result as $tuples):
          $linecounter++;
          ?><tr><?php
            $count = 1;
              ?><td><?=$tuples['JobId']?></td><?php
              ?><td><?=$tuples['PrinterEmail']?></td><?php
              ?><td><a href="<?=$tuples['ProjectLink']?>"><?=$tuples['ProjectName']?></td>
                <td>
                  <form action="admin.php" method="post">
                    <select name="status">
                      <option value="<?=$tuples['Status']?>">
                          Current: <?=$tuples['Status']?></option>
                      <option value="Waiting">Waiting</option>
                      <option value="Printing">Printing</option>
                      <option value="On Hold">On Hold</option>
                      <option value="Completed">Completed</option>
                      <option value="Rejected">Rejected</option>
                    </select>
                    <input type="hidden" name="jobId" value="<?=$tuples['JobId']?>">
                    <button type="submit" name="submit">Submit</button>
                  </form>
                  </td>
                  <td><?=$tuples['Weight']?></td><?php
                ?><td><?=$tuples['Length']?>x<?=$tuples['Width']
                      ?>x<?=$tuples['Height']?></td><?php
                ?><td><?=$tuples['Color']?></td><?php
                ?><td><?=$tuples['Comment']?></td><?php
                ?><td><?=$tuples['SubmittedTime']?></td><?php
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

