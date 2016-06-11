<?php
include_once 'dbclass/dbset.php';
$topcat=$cat->gettopcat(0);
if(isset($_GET['cat'])){
	$ID=$_GET['cat'];
	$carr[]=$ID;
	$catname=$cat->getCatTitlebyID($ID);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<script src="js/jquery.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/yeyestyle.css" rel="stylesheet" type="text/css" />
		<link href="css/menu.css" rel="stylesheet" type="text/css" />
	</head>
	<title>
		<?php if(isset($_GET['cat'])) {echo $catname['title']; }
		else if(isset($_GET['q']) && $_GET['q']!=' '){echo $_GET['q']."'s Search Result"; }
		?>
	</title>

<body>
 <?php include_once 'header.php' ?>
 <?php require 'menu.php' ?>
 <div id='cattit'>
  sitemap
 </div>
 <div style='clear:both;'>
 
<div class='listnewscontainer' >
	<div class="newslist">
		  <?php
        	  if(isset($_GET['newsid']) && isset($_GET['cat'])){
          include_once 'news.php';
          }
          else if(isset($_GET['cat'])){
              
              foreach($cat->gettopcat($ID) as $sub)
              {
                  $carr[]=$sub['id'];
                  foreach($cat->gettopcat($sub['id']) as $catsub){
                      $carr[]=$catsub['id'];
                  }
              }
          foreach($carr as $ca=>$pid){
                  foreach($id=$art->getnewsidfromcat($pid) as $newsid)
                  {
          $arr1[]=$newsid['newsid'];
                  }
              }
              if(isset($arr1)){
              $uniarr=array_unique($arr1); //make unique array for duplicate newsid
              $total=count($uniarr);
          //	print_r($uniarr); //debug
              $url="categorylisting.php?cat=".$ID."&";
              include_once 'paging.php';
              $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
                  $limit = 2;
                  $start = ($page * $limit) - $limit;
              //	echo "start".$start; //debug
                      echo pagination($limit,$page,$url,$total);
                      $catlist=array_slice($uniarr,$start,$limit);
                  ?>
                  <?php
              foreach($catlist as $x=>$id) {
                  foreach($art->getarticlebyid($id) as $news){
                          $img=$art->getNewsImage($news['imgid']);
                          //var_dump($img);
                      ?>
          <div id="newsbox">
              <div id="newspic">
              <a href="categorylisting.php?cat=<?=$ID;?>&newsid=<?=$news['id'];?>">
                  <img src="<?=$img['thumb_url'];?>" title="<?=$img['caption'];?>" class="newsimg"/>
                 </a>
              </div>
              <div id="newspara">
                  <div id="newstit"><a href="categorylisting.php?cat=<?=$ID;?>&newsid=<?=$news['id'];?>" id='newcount'><?=$news['title'];?></a>
             <!--     <br /><small><?php
                  $getcat=$art->getCatTabByNsID($news['id']);
                   foreach($getcat as $catID){
                              extract($catID);
                              $catname=$cat->getCatTitlebyID($id);
                              echo "<a href='index.php?cat=$id'>";
                              echo $catname['name']."</a> | ";
                              
                          }; 
                          ?>//don't delet for category tags--> 
                  </small>
                  </div>
                      <p><?=strip_tags(substr($news['content'],0,200));?>..... <a href="categorylisting.php?cat=<?=$ID;?>&newsid=<?=$news['id'];?>" id="rdm">
                       &raquo;read more</a></p>
                  <div id="author"><span class='date'>Date Time :<?=$news['c_date'];?></span><span class='auth'> Author: <?=$news['adminid'];?></span></div>
              </div>
          </div>
                      <?php
                      }
          }
              echo "<div class='clr_btn'></div>";
              echo pagination($limit,$page,$url,$total);
              }
              else{
              echo "<h2>NO NEWS FOUND@ ".strtoupper($catname['title'])." </h2>";
              }
          } //isset get cat
          
          else if(isset($_GET['q']) && $_GET['q']!=' '){
              include_once 'searchlisting.php';
          }
          ?>
              </div> <!-- close of listnew-->
    <div class="adslist">
    	<img src="ads/futebal.jpg" width="350px" height="150px" />
    </div>
</div><!-- close of listnewscontainer-->

<footer>
<?php include_once 'footer.php'; ?>
</footer>
</body>
</html>