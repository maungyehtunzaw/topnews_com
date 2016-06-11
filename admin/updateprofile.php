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
<td width="30%" align="right"><a href="index.php?page=updateprofile" id="updateprofile">My Profile</a> |<a href="logout.php"> Logout</a> </td>
</tr></table>
</div>
<div id="leftmenu">
<div id='cssmenu'>
<ul>
   <li><a href='index.php'><span>Home</span></a></li>
     <li class='active'><a href="categorymgr.php"><span>Category Manager</span></a></li>     
	<li><a href="articlemgr.php"><span>Article Manager</span></a></li>
   <li><a href='advertisemgr.php'><span>Ads Manager</span></a></li>  
     <li ><a href='subscribemgr.php'><span>Subscriber Manage</span></a></li>   
   <?php if($user['user_lvl']=='boss'){ // boss only see and  manage?> 
   <li class='last'><a href='index.php'><span>Admin Manager</span></a></li><!-- Just for user type=boss-->
	<?php } ?>
</ul>
</div>
</div>
<div id="content">

	<div class="container">
	<section>

			
             <a href='editpro' class='btn'>Edit Profile</a> 
			 <a href='changepass' class='btn'>Change Password</a>
			 <hr>
           
        <div id="profile_picture">                
                        <div id="userpic"><?php
			   //$img=$user->getAdminAvator($usrid);
			   // header("Content-type: " . $user['mime']);
        echo $user['avator']; ?>
			</div>
			     </div>
        <div id="personal_info">
                <table>
                <caption>User Information</caption>
                <tr><td width='200px'>
	                Name</td><td>
	                        <?php echo $user['pre_name']." ".$user['name']; ?></td></tr>
						
	               <tr><td>Username</td><td>
	                        <?php echo $user['username'];?></td></tr>
	             
				 <tr><td>Contact Phone</td><td>
	                       <?php echo $user['phone']; ?></td></tr>
	                
                   <tr><td>Email </td><td>
	                       <?php echo $user['email']; ?></td></tr>
	                  
	               <tr><td>Gender:</td><td>
	                        <?php echo $user['gender'];?></td></tr>
	                 
	                <tr><td>Address</td><td>
	                       <?php echo $user['address']; ?></td></tr>
                    
                   </table>
		</div>

</section>
     </div>
  
  <?php include_once 'htmlfooter.php' ?>