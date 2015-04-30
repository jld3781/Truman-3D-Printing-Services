<?php $sort='';
  if(isset($_GET['sort']) &&
     $_GET['sort']=='byauthor'):
    $sort = 'CreatorUsername';
  else:
    $sort = 'ProjectName';
  endif; ?>
<h1>Gallery</h1>
      
      <?php
        require_once( 'dbconnection.php' );
        $query = "SELECT CreatorUsername, ProjectName, ProjectLink, Picture
                  FROM PROJECT as P
                     NATURAL JOIN PRINT_JOB as PJ
                  WHERE P.ProjectName = PJ.ProjectName AND 
                    PJ.Status = 'Completed'
                  ORDER BY $sort";
        $statement = $db->prepare( $query ); 
        $statement->execute();
        $result = $statement->fetchAll(); ?>
      
        <?php
        foreach( $result as $project ): 
          $link = 'http://bluesfest.no/site/bluesfest.no/design/layouts/images/no-image-placeholder.png?fh=250&fw=350'; 
          if($project['Picture']!=null):
            $link = $project['Picture'];
          endif;?>
            <ul class="galleryitems">
              <li>
                <img src="<?=$link?>" 
                alt="Picture of: <?=$project['ProjectName']?>" width="250" height="200"/>
              </li>
              <li>
                Link to: 
                <a href="<?=$project['ProjectLink']?>"><?=$project['ProjectName']?></a>
              </li>
              <li>Created by: <?=$project['CreatorUsername'] ?></li>
              <li>
                <form method="post" action="print.php">
                  <input type="text" id="projectname" hidden="hidden" name="projectname" value="<?=$project['ProjectName']?>" />
                  <input type="text" id="creatorusername" hidden="hidden" name="creatorusername" value="<?=$project['CreatorUsername']?>" />
                  <button type="submit" name="submit">Print Project</button>
                </form>
              </li>
            </ul>
        <?php endforeach; ?>
