
<?php
if(!isset($_GET['newsid']) || $_GET['newsid']=='' || $_GET['newsid']=='null')
{
	header('Location : index.php');
}
$NID=$_GET['newsid'];
include_once 'dbclass/dbset.php';
$news=$art->getarticlebyid($NID);
$prev=$art->getPreviousID($NID);
$next=$art->getNextID($NID);
foreach($news as $dtil){
	$newspic=$art->getNewsImageId($dtil['id']);
	extract($dtil);
		?>
		
	<div>
    <div class="detailtit"><?=$title;?></div>
    <div class="mainpic">
    <img src="<?=$newspic['url'];?>" width="100%" height="100%" title="<?=$newspic['caption'];?>">
    </div>
    <div class="sumr">
    	<table align="center"; border="2">
        	<tr>
            	<td width="100px">Writed by</td>
                <td><?=$pre_name." ".$name;?></td>
            </tr>
            <tr>
            	<td>Published Date</td>
                <td><?=$c_date;?></td>
            </tr>
            <tr>
            	<td valign="top">Tags :</td>
                <td> <?php  
				//ECHO $NID;
				$getcat=$cat->getTagsOfNews($NID);
				//var_dump($getcat);
				
				foreach($getcat as $catID){
					extract($catID);
					$catname=$cat->getCatTitlebyID($catid);
					echo "<a href='categorylisting.php?cat=$id'>";
					echo $catname['title']."</a> | ";
					
				}; ?></td>
            </tr>
            <tr>
            	<td valign="middle" width="60px;">
                Total Views 
                </td>
                <td><b>
                <?=$view_count;?></b> views
                </td>
           </tr>
           
        </table>
    </div>
    <div id="reset1"></div>
    <div class="newscontent">
    <?=$content;?>
    </div>
    <?php
}
?>



<table width="100%" border="2">
<tr>
	<td width="50%" align="left">
     	<a href="?newsid=<?=$prev['id'];?>">&lt;&lt;Previous:<?=$prev['title'];?>....</a>
    </td>
	<td width="50%" align="right">
    	<a href="?newsid=<?=$next['id'];?>">&gt;&gt;Next: <?=$next['title'];?>....</a>
    </td>    
</tr>
</table>
<hr><!-- comment start show-->
<form name='comment' method='post' action=''>
		<input type=text placeholder='your name' class="comtxt" name='name' value="<?=isset($_POST['name'])? trim($_POST['name']):'';?>">
		<input type='email' placeholder='enter your email:already subscribed' class="comtxt" name='email' value="<?=isset($_POST['email'])? trim($_POST['email']):'';?>"><br>
or
		<button>facebook</button> | <button>facebook</button> | <button>facebook</button><br>
		<textarea name='msg' cols=85 rows=10><?=isset($_POST['msg'])? $_POST['msg']:'';?></textarea><br>
        <input type="checkbox" name="noti" value='on'/>get notification
		<input type='submit' value="Send" name='comment'>
	</form>

<?php

if(isset($_POST['comment'])){
$nid=$_GET['newsid'];
$name=trim($_POST['name']);
$email=trim($_POST['email']);
$msg=trim($_POST['msg']);
$chkmail=$usr->checkStatus($email);
$noti=isset($_POST['noti'])? $_POST['noti']:'off';
$replyid=isset($_GET['postid'])? $_GET['postid']:'';

if(!$usr->email_exist($email) && $chkmail['status']=='active'){
echo 'user can comment ';
$usr->commentNews($nid,$msg,$name,$email,$noti,$replyid);

	}
else{
echo 'your mail must be subscribe ..comfirm...';
}
}

?>

<hr>

<?php
$hostname = "localhost";
$db_username = "root";
$db_password = "";
$nid=$_GET['newsid'];
$link = mysql_connect($hostname, $db_username, $db_password) or die("Cannot connect to the database");
mysql_select_db("topnew2") or die("Cannot select the database");
?>
<ul>
<?php

$q = "SELECT * FROM comment WHERE nid = $nid";
$r = mysql_query($q);
var_dump($r);
while($row = mysql_fetch_assoc($r)):
	$usr->getComments($row);
endwhile;
?>
</ul>
</hr>
<div class="detailads">
<h2>ADVERTISE HERE</h2>
</div>

<?php
$relat=$art->getRelatedNews($keyword_);
?>


 
    
<div id="relatenews">
<h3>Relatest News</h3>
<?php foreach($relat as $new){ ?>
 <div id="relnews">
	<img src="newsimg/css3.jpg" width="100%" height="100%" />
    <a href=""><?=$new['title'];?></a>
  </div>
 <?php } ?>

</div>
<div id="reset1"></div>  
</div><!-- End of relatenews -->