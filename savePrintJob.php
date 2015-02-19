<?php
session_start();
define( 'PRINT_JOBS', 'printJobs.txt' );

$printJob = $_SESSION['firstName'] . "\t" . 
           $_SESSION['lastName'] . "\t" . 
           $_SESSION['studentId'] . "\t" . 
           $_SESSION['email'] . "\t" . 
           $_SESSION['phone'] . "\t" .
           $_SESSION['projectName'] . "\t" .
           "Project ID" . "\t" .
           $_SESSION['projectLink'] . "\t" .
           "Waiting" . "\t" .
           $_SESSION['weight'] . "\t" .
           $_SESSION['color'] . "\t" .
           $_SESSION['comments'] . PHP_EOL;
           
file_put_contents(PRINT_JOBS, $printJob, FILE_APPEND);

header( 'Location: orderConfirmation.php' ) ;
exit;

?>
