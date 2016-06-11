<?php 
require 'db/init.php';
$general->logged_out_protect();
$username 	= htmlentities($user['name']); // storing the user's username after clearning for any html tags.
$usrid=$user['id'];
?>
<?php include_once 'htmlheader.php' ?>
<div id="wrap"> <!-- Wrapper -->
<div id="nav">
<table width="100%" align="left" border="1"><tr>
<td width="30%" height="20px;">Welcome : <?php echo $user['pre_name']." ".$user['name']; ?></td>
<td width="40%" align="center">
  
</td>
<td width="30%" align="right"><a href="updateprofile.php" id="updateprofile">My Profile</a> |<a href="logout.php"> Logout</a> </td>
</tr></table>
</div>
<div id="leftmenu">
<div id='cssmenu'>
<ul>
   <li class='active'><a href='index.php'><span>Home</span></a></li>
     <li><a href="categorymgr.php"><span>Category Manager</span></a></li>     
	<li><a href="articlemgr.php"><span>Article Manager</span></a></li>
   <li><a href='advertisemgr.php'><span>Ads Manager</span></a></li>   
     <li ><a href='subscribemgr.php'><span>Subscriber Manage</span></a></li>   
   <?php if($user['user_lvl']=='boss'){ // boss only see and  manage?> 
   <li class='last'><a href='adminmgr.php'><span>Admin Manager</span></a></li><!-- Just for user type=boss-->
	<?php } ?>
</ul>
</div>
</div>
<div id="content">
<?php
			include_once 'db/generalme.php';
			$mygen=new mygeneral($db);
			$totalns=$mygen->totalNews();
			$totalsur=$mygen->totalSubscriber();
			?>
<div id="homenoti" style="border:2px solid red;">
<div id="title">Total Article</div>
<h2><?=$totalns['totalnews']; ?></h2>
<div id="footer">today : 10 news</div>
</div>

<div id="homenoti">
<div id="title">Total Subscriber</div>
<h2><?=$totalsur['totalscriber'];?></h2>
<div id="footer">today : 10 new</div>
</div>

<div id="homenoti">
<div id="title">Total Visited</div>
<h2>234,2323</h2>
<div id="footer">today : 10 news</div>
</div>

<?php include_once 'htmlfooter.php' ?>
