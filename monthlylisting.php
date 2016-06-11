<?php
include_once 'dbclass/dbset.php';
if(isset($_GET['month'])){
$month=$_GET['month'];
$mon=array('00'=>'January','01'=>'Febuary','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
}
$monthly=$art->getNewsByMonthLink();
$topcat=$cat->gettopcat(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($_GET['month'])) {echo $_GET['month']; }
else if(isset($_GET['q']) && $_GET['q']!=''){echo $_GET['q']."'s Search Result"; }
?>
</title>
<link href="css/yeyestyle.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include_once 'header.php' ?>
<div id='cssmenu'>
	<ul>
		<li class='active current'>
			<a href='index.php'><span>Home</span></a></li>
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

		<div id='cattit'>

		</div>
<div class="month_list">
<div id="achieve1">
<div id="ltitle">MONTHLY ACHIEVES</div>
<ul>
<?php
			foreach($monthly as $m){
				extract($m);
				echo "<li><a href='monthlylisting.php?month=".$mon."'>".$mon_year."</a></li>";
				}
			?>
</ul>
</div>
</div>

 <div class="mon_list_news" >
 <?php
 if(isset($_GET['month'])){
 $url="monthlylisting.php?month=$month&";
include_once 'paging.php';
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 2;
    	$start = ($page * $limit) - $limit;
	//	$result=$art->searchnews($kword,$start,$limit);
		echo $month;
		$total=$art->getNewsByMonthTotal($month);
		echo $total;
		$monly=$art->getNewsByMonth($month,$start,$limit);
		 echo pagination($limit,$page,$url,$total);
foreach($monly as $news){
				$img=$art->getNewsImage($news['id']);
			?>
<div id="newsbox">
	<div id="newspic">
    	<a href="index.php?month=<?=$month;?>&newsid=<?=$news['id'];?>">
    	<img src="<?=$img['url'];?>"  title="<?=$img['caption'];?>" class="newsimg"/>
        </a>
    </div>
	<div id="newspara">
    	<div id="newstit"><a href="index.php?month=<?=$month;?>&newsid=<?=$news['id'];?>"><?=$news['title'];?></a></div>
			<p><?=substr($news['content'],0,200);?>..... <a href="index.php?month=<?=$month;?>&newsid=<?=$news['idnews'];?>" id="rdm">
             &raquo;read more</a></p>
		<div id="author"><span class='date'>Date Time :<?=$news['c_date'];?></span><span class='auth'> Author: <?=$news['adminid'];?></span></div>
	</div>
</div>
<?php
	}
	 echo pagination($limit,$page,$url,$total);
 }
else //if(isset($_GET['q']) && $_GET['q']!=' '){
	{
	include_once 'searchlisting.php';
}
	 ?>
   
     </div>
	 
	 <div class='adslist'>
     	<img src="ads/gauchito.jpg" width="230px"  />
	 </div>
<footer>
<?php include_once 'footer.php'; ?>
</footer>
</body>
</html>