<?php 
require 'db/init.php';
$general->logged_out_protect();
$username 	= htmlentities($user['name']); // storing the user's username after clearning for any html tags.
$usrid=$user['id'];
?>
<?php include_once 'htmlheader.php' ?>
<div id="wrap"> <!-- Wrapper -->
<div id="nav">
<table width="100%" align="left"><tr>
<td width="30%">Welcome : <?php echo $user['pre_name']." ".$user['name']; ?></td>
<td width="40%" align="center"><?php echo date("l jS \of F Y h:i:s A"); ?></td>
<td width="30%" align="right"><a href="updateprofile.php" id="updateprofile">My Profile</a> |<a href="logout.php"> Logout</a> </td>
</tr></table>
</div>
<div id="leftmenu">
<div id='cssmenu'>
<ul>
   <li><a href='index.php'><span>Home</span></a></li>
     <li><a href="categorymgr.php"><span>Category Manager</span></a></li>     
	<li><a href="articlemgr.php"><span>Article Manager</span></a></li>
   <li  class='active'><a href='advertisemgr.php'><span>Ads Manager</span></a></li>  
     <li ><a href='subscribemgr.php'><span>Subscriber Manage</span></a></li>   
	 <li ><a href='commentmgr.php'><span>Comment Manage</span></a></li>   
   <?php if($user['user_lvl']=='boss'){ // boss only see and  manage?> 
   <li class='last'><a href='index.php'><span>Admin Manager</span></a></li><!-- Just for user type=boss-->
	<?php } ?>
</ul>
</div>
</div>
<div id="content">



	<div class="container">
		<section>
        <a href="index.php?page=addnewads&action=add" id="addnew">Add New Advertisement</a>
		 <?php
			include_once 'db/adsmgr.php';
			$ads=new adsmgr($db);
			$adslist=$ads->getallads();

			?>

			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Ads Name</th>
						<th>Description</th>
						<th>Price</th>
                        <th>Link</th>
						<th>Ads Exp Date</th>
						<th>Action</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th>ID</th>
						<th>Ads Name</th>
						<th>Description</th>
						<th>Price</th>
                        <th>Link</th>
						<th>Ads Exp Date</th>
						<th>Action</th>
					</tr>
				</tfoot>

				<tbody>
					
                    <?php
					foreach($adslist as $adsl){
						echo "<tr>";
						echo "<td>".$adsl['idads']."</td>";
						echo "<td>".$adsl['name']."</td>";
						echo "<td>".$adsl['description']."</td>";
						echo "<td>".$adsl['price']."</td>";						
						echo "<td>".$adsl['link']."</td>";												
						echo "<td>".$adsl['expire_date']."</td>";												
						echo "<td><a href='index.php?page=addnewads&action=view&id=$adsl[idads]'> View </a> | 
								  <a href='index.php?page=addnewads&action=edit&id=$adsl[idads]'> Edit </a> | 
								  <a href=''> Delete </a></td>";
						echo "</tr>";
					}
					?>
					
				</tbody>
			</table>

		</section>
       </div>
        
  <?php include_once 'htmlfooter.php' ?>