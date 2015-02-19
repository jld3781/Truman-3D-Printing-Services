<DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Print Summary</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
  
    <?php
      session_start();
      include( 'nav.html' );
      define( 'PRINT_JOBS', 'printJobs.txt' );
    ?>
    <section class="maincontent">

      <h2>Print Summary</h2>
      
      <ul id="print-summary-list">
        <li>First Name: <?= $_SESSION['firstName'] ?></li>
        <li>Last Name: <?= $_SESSION['lastName'] ?></li>
        <li>Student ID: <?= $_SESSION['studentId'] ?></li>
        <li>Email: <?= $_SESSION['email'] ?></li>
        <li>Phone: <?= $_SESSION['phone'] ?></li>
        <li>Project Name: <?= $_SESSION['projectName'] ?></li>
        <li>Project Link: <?= $_SESSION['projectLink'] ?></li>
        <li>Weight: <?= $_SESSION['weight'] ?> grams</li>
        <li>Color: <?= $_SESSION['color'] ?></li>
        <li>Comments: <?= $_SESSION['comments'] ?></li>
      </ul>

      <form method="post" action="savePrintJob.php">
        <button type="submit">Submit Order</button>
      </form>
    </section>
  </body>
</html>
