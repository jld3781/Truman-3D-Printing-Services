<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Jessica, Sam, Jimmy" />
    <link rel="stylesheet" href="style.css" />

    <title>Verification</title>
  </head>
  <body>
    <?php include( 'nav.html' ); ?>
    <form method="post" action="admin.php">

      <p>
        <label for="password">Provide admin password:</label>
        <input type="password" id="password" name="password" />
      </p>
  
      <p>
        <input type="submit" value="Enter" name="submit" />
      </p>
  
    </form>
  </body>
</html>
