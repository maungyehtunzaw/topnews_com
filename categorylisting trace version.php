<h2>Areticle Category Listing</h2>
<?php
include_once 'dbclass/dbset.php';
$ID=$_GET['cat'];
echo $ID."catID <br />";
//$hassub=$cat->subcat_exist($ID); //check have sub category

echo "<br>";

	$carr[]=$ID;
	echo 'have sub true<br />';
	foreach($cat->gettopcat($ID) as $sub)
	{
		echo $sub['name'].'---';
		echo $sub['idcat'];
		$carr[]=$sub['idcat'];
		foreach($cat->gettopcat($sub['idcat']) as $catsub){
			$carr[]=$catsub['idcat'];
		}
	}
	echo "<br/>";
	echo var_dump($carr);
	echo "<br/>";
	foreach($carr as $ca=>$value){
		echo $value."<br />";
	}
foreach($carr as $ca=>$pid){
		foreach($id=$art->getnewsidfromcat($pid) as $newsid)
		{
			//echo $newsid['news_idnews']."||";
			foreach($art->getarticlebyid($newsid['news_idnews']) as $news){
				$img=$art->getNewsImage($news['image_idimage']);
			?>
              <div id="newsbox">
<div id="newspic"><img src="<?=$img['url'];?>" width="100%" height="100%" title="<?=$img['caption'];?>"/></div>
<div id="newspara"><div id="newstit"><?=$news['title'];?></div>
<p><?=substr($news['content'],0,300);?><a href="#" id="rdm"> &raquo;read more</a></p>
<div id="author">Cedit or Author <?=$news['author'];?></div>
</div>
</div>
            <?php
			}
		}
	}
?>