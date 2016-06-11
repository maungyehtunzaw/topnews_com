
 <div id='cssmenu'>
<ul>
	<li class='active current'><a href='index.php'><span>Home</span></a></li>
    <?php foreach ($topcat as $top) { ?>
	
    <li class='has-sub'><a href='categorylisting.php?cat=<?=$top['id'];?>'><span><?=$top['title'];?></span></a>
	<ul>
    <?php
	foreach($cat->gettopcat($top['id']) as $sub){
	extract($sub)
?><?php
		echo "<li><a href='categorylisting.php?cat=$id'><span>";
		echo $title;
		echo "</span></a>";
		echo "<ul>";
		foreach($cat->gettopcat($id) as $msub){
			extract($msub);
			echo "<li><a href='categorylisting.php?cat=$id'><span>";
		echo $title;
		echo "</span></a></li>";
			}
			echo "</ul>";
		echo "</li>";
	}
	?>   
</ul>
</li>
<?php 
	
	}?>
		
</ul>
</div>