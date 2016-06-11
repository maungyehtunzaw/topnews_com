<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Top News - Home Page</title>
<link rel="shortcut icon" href="img/favicon.png" type="image/png" />
<link href="css/yeyestyle.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/tabcontent.css" />
<script type="text/javascript" src="js/tabcontent.js"></script>
</head>
<body>
<?php
include_once 'dbclass/dbset.php';
$topcat=$cat->gettopcat(0);
			?> 
<?php include_once 'header.php' ?>
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
			echo "<li><a href='categorylisting.php??cat=$id'><span>";
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

<div id="lstnewsort">
<?php
if(isset($_GET['subscr_successful'])){
	echo "thank you for your email subscribe<br />";
	echo "your email subscribtion is successful, please verfify your email between 24 hour, let update with news ";
}
 ?>
</div>
<section>
<?php include_once 'leftads.php'; ?>
<div id="contents"> 
<?php 
 if(isset($_GET['q']) && $_GET['q']!=' '){
	include_once 'searchlisting.php';
}
else if(isset($_GET['newsid'])){
	include_once 'news.php';
}
else if(isset($_GET['usersubcribe'])){
	include_once 'usersubscribe.php';
}
else if(isset($_GET['signin'])){
	include_once 'signin.php';
}
else if(isset($_GET['signup'])){
	include_once 'signup.php';
}
else if(isset($_GET['info'])){
	include_once 'infomation.php';
}
else{
include_once 'home_content.php';
 }
 ?>
 </div>
 
<div id="mostviews">
<?php include_once 'rightcolum.php'; ?>
</div>
</section>

<footer>
<?php include_once 'footer.php'; ?>
</footer>

</body>
</html>