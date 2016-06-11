<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>The Devil's Dictionary</title>

    <link rel="stylesheet" href="06.css" type="text/css" />

    <script src="js/jquery.js"></script>
    <script src="complete.js"></script>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <h2>The Devil's Dictionary</h2>
        <div class="author">by Ambrose Bierce</div>
      </div>

      <div class="letters">
        
        <div class="letter" id="letter-e">
          <h3>E</h3>
          <ul>
            <li><a href="e.php?term=Eavesdrop">Eavesdrop</a></li>
            <li><a href="e.php?term=Edible">Edible</a></li>
            <li><a href="e.php?term=Education">Education</a></li>
            <li><a href="e.php?term=Eloquence">Eloquence</a></li>
            <li><a href="e.php?term=Elysium">Elysium</a></li>
            <li><a href="e.php?term=Emancipation">Emancipation</a></li>
            <li><a href="e.php?term=Emotion">Emotion</a></li>
            <li><a href="e.php?term=Envelope">Envelope</a></li>
            <li><a href="e.php?term=Envy">Envy</a></li>
            <li><a href="e.php?term=Epitaph">Epitaph</a></li>
            <li><a href="e.php?term=Evangelist">Evangelist</a></li>
          </ul>
        </div>
        <?php
include_once 'db/catmgr.php';
			$cat=new catmgr($db);
			$alltopcat=$cat->gettopcat(0);
			?>

      </div>
      <div id="first">
      <select id="dropdown1">
      <option value="addtop">Add Top Category</option>
              <?php  foreach($alltopcat as $tc){ ?>
              <option value="<?php echo $tc["id"]; ?>"><?php echo $tc["title"]; ?></option>
              <?php } ?>
      </select>
    
      </div>
      </div>
	  <hr>
      <div id="second">
      </div>
	  <hr>
      <div id="third">
      </div>
      <div id="dictionary">
      </div>

    </div>
  </body>
</html>
