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
	<li  class='active'><a href="articlemgr.php"><span>Article Manager</span></a></li>
   <li><a href='index.php?page=adsmanager'><span>Ads Manager</span></a></li>
   <li ><a href='subscribemgr.php'><span>Subscriber Manage</span></a></li>   
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
			include_once 'db/users.php';
		//	include_once 'db/catmgr.php';
		//	include_once 'paging.php';
           $allusr=$users->getAllUsers();
		?>
            <?php if(!isset($_GET['action'])){ ?>
            			<a href="adminmgr.php?action=add" class="btn">ADD NEW ADMIN ACCOUNT</a>
            <div id="resetme"></div><p>
  
            <?php } foreach($allusr as $usr){ 
			//$img=$art->getNewsImg($news['imgid']);
		//	var_dump($img);
			$tooltip=$usr['email']."<br/>".$usr['status']."<br/>".$usr['phone'];
			?>
			<div class="article_box">
				<img src="../"  class="tooltip" title="<?=$tooltip;?>"/>
                <a href="#view" class="tooltip" title="<?=$tooltip;?>">
				<?=$usr['pre_name']." ".$usr['name'];?>...</a>
                
				<div class="action">
                	<a href="articlemgr.php?action=edit&id=<?=$usr['id'];?>" class='btn'>edit</a>
                	<a href="articlemgr.php?action=view&id=<?=$usr['id'];?>" class='btn'>view</a>
                	<a href='#'  class='deleteBtn btn'>delete</a>                    
                </div>
            </div>
            
            <?php } 
			?>
			<div id="resetme"></div>
			
	</section>
   </div>
  
<script>
$(document).ready(function(){
$(document).on('click', '.deleteBtn', function(){ 
        if(confirm('Are you sure?')){
		
            // get the id
			var user_id = $(this).closest('td').find('.userId').text();
			
			// trigger the delete file
			$.post("delete.php", { id: user_id })
				.done(function(data) {
					// you can see your console to verify if record was deleted
					console.log(data);
					
					$('#loaderImage').show();
					
					// reload the list
					showUsers();
					
				});

        }
    });
	});
</script>
    <script src="js/tooltip.js"></script>
  <?php include_once 'htmlfooter.php'; ?>