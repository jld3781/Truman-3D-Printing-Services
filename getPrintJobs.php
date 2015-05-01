<?php
if(session_id() == '' || !isset($_SESSION)): 
    // session isn't started
    session_start();
endif;

//Handles status changes
if( isset( $_SESSION['loggedin'] ) && 
           $_SESSION['loggedin'] == true &&
           $_SESSION['aflag'] == 'T'):
  require_once( 'dbconnection.php' );
  if(isset($_GET['status']) && isset($_GET['jobId'])):
    $jobId = htmlspecialchars($_GET['jobId']);
    $status = htmlspecialchars($_GET['status']);

    if($status == 'Completed' || $status == 'Rejected'):
      $sql = "UPDATE PRINT_JOB
              SET Status = :status, StopTime = NOW() 
              WHERE JobId = :jobId";
    elseif($status == 'Printing'):
      $sql = "UPDATE PRINT_JOB
              SET Status = :status, StartTime = NOW() 
              WHERE JobId = :jobId";
    else:
      $sql = "UPDATE PRINT_JOB
              SET Status = :status
              WHERE JobId = :jobId";
    endif;
    $statement = $db->prepare( $sql );
    $statement->bindParam( ':status', $status, PDO::PARAM_STR );
    $statement->bindParam( ':jobId', $jobId, PDO::PARAM_STR );
    $statement->execute();
  
    $sql = "DELETE FROM PRINT_JOB
            WHERE Status = 'Rejected'";
    $statement = $db->prepare( $sql );
    $statement->execute();
  endif;
  
  //Print Table Header
  define('PRINTJOB_HEADERS_FILE', 'printQueueHeaders.txt' );
  $lines = file( PRINTJOB_HEADERS_FILE );
  $firstLine = array_shift($lines);
  $words = explode( "\t", $firstLine ); ?>
  <tr>
  <?php foreach($words as $word): ?>
    <th><?=$word?></th>
  <?php endforeach;?>
  </tr>
  
  <?php //Pulls in all print jobs that aren't completed or rejected
  $query = "SELECT JobId, PrinterUsername, PJ.ProjectName, Status,
            StartTime, StopTime, SubmittedTime, Length, Width, Height,
            Color, MaterialType, Weight, ChargedPrice, Comment,
            P.ProjectLink
            FROM PRINT_JOB as PJ NATURAL JOIN PROJECT as P
            WHERE Status <> 'Rejected' AND Status <> 'Completed'
            ORDER BY SubmittedTime";
  $statement = $db->prepare( $query );
  $statement->execute();
  $result = $statement->fetchAll();

  //Print Table Contents
  foreach($result as $tuples): ?>
  <tr>
    <td><?=$tuples['JobId']?></td>
    <td><?=$tuples['PrinterUsername']?></td>
    <td><a href="<?=$tuples['ProjectLink']?>"><?=$tuples['ProjectName']?></td>
    <td>
      <select name="status" id="<?=$tuples['JobId']?>" class="status">
        <option value="<?=$tuples['Status']?>">
          Current: <?=$tuples['Status']?>
        </option>
        <option value="Waiting">Waiting</option>
        <option value="Printing">Printing</option>
        <option value="On Hold">On Hold</option>
        <option value="Completed">Completed</option>
        <option value="Rejected">Rejected</option>
      </select>
    </td>
    <td><?=$tuples['Weight']?></td>
    <td>
      <?=$tuples['Length']?>x<?=$tuples['Width']?>x<?=$tuples['Height']?>
    </td>
    <td><?=$tuples['Color']?></td>
    <td><?=$tuples['Comment']?></td>
    <td><?=$tuples['SubmittedTime']?></td>
  </tr>
<?php endforeach;
endif; ?>
