<?php
$kword=trim(mysql_real_escape_string($_GET['q']));
include_once 'dbclass/dbset.php';
$total=$art->searchResultCount($kword);
$res=$art->searchResultNewsID($kword);
foreach($res as $nid){
$newsids[]=$nid['id'];
}

$url="?q=".$kword."&search=SEARCH&";
include_once 'paging.php';
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 2;
    	$start = ($page * $limit) - $limit;
		$result=$art->searchnews($kword,$start,$limit);
		

?>
<div id="cattit"><?=$total;?> Restults For Searching "<?=$_GET['q'];?>"</div><p>
<?php echo pagination($limit,$page,$url,$total);
foreach($result as $news){
$img=$art->getNewsImage($news['id']);

?>
<div id="newsbox">
	<div id="newspic">
    	<img src="<?=$img['url'];?>" width="100%" height="100%" title="<?=$img['caption'];?>"/>
    </div>
	<div id="newspara">
    	<div id="newstit"><a href="index.php?newsid=<?=$news['id'];?>"><?=$news['title'];?></a></div>
			<p><?=strip_tags(substr($news['content'],0,200));?>..... <a href="index.php?newsid=<?=$news['id'];?>" id="rdm">
             &raquo;read more</a></p>
		<div id="author"><span class='date'>Date Time :<?=$news['c_date'];?></span><span class='auth'> Author: <?=$news['adminid'];?></span></div>
	</div>
</div>
<?php
}
echo pagination($limit,$page,$url,$total);?>
