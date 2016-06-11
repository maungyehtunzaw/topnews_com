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
   <li><a href='advertisemgr.php'><span>Ads Manager</span></a></li>  
     <li ><a href='subscribemgr.php'><span>Subscriber Manage</span></a></li>   
	 <li class='active' ><a href=''><span>Comment Manage</span></a></li>   
   <?php if($user['user_lvl']=='boss'){ // boss only see and  manage?> 
   <li class='last'><a href='adminmgr.php'><span>Admin Manager</span></a></li><!-- Just for user type=boss-->
	<?php } ?>
</ul>
</div>
</div>
<div id="content">

	<div class="container">
		<section>
           <?php
			include_once 'db/commentmgr.php';
			$cat=new catmgr($db);
			$allcat=$cat->getallcat();

			?>
			<a href="categorymgr.php?action=addcat" class="btn">Add New Category</a>
            <?php if(isset($_GET['action'])) 
			{
			include_once 'addcat.php';
				}
				else
{
			?>
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Sub Category</th>
						<th>Top Category</th>
                        <th>Keyword</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th>ID</th>
						<th>Sub Category</th>
						<th>Top Category</th>
                        <th>Keyword</th>                        
						<th>Created Date</th>
						<th>Action</th>
					</tr>
				</tfoot>

				<tbody>
					
                    <?php
					foreach($allcat as $p){
						extract($p);
						echo "<tr>";
						echo "<td><a href='categorymgr.php?action=view&id=$id'>".$id."</a></td>";
						echo "<td><a href='categorymgr.php?action=view&id=$id'>".$title."</a></td>";
						echo "<td>";
						$topcat=$cat->getparentcat($parent_id);
						echo $topcat['title'];
						echo "</td>";
						echo "<td>".$keyword_."</td>";
						echo "<td>".$c_date."</td>";
						echo "<td><a href='categorymgr.php?action=edit&id=$id' class='btn'>Edit</a>";
						echo "<a href='categorymgr.php?action=edit&id=$id' class='btn'> Delete </a></td>";
						echo "</tr>";
					}
					?>
					
				</tbody>
			</table>

<?php } //is not set action close ?>
		</section>
     </div>
  
  <?php include_once 'htmlfooter.php' ?>