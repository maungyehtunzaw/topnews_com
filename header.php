<header>
<img src="admin/images/logooftopnew.png" width="256" height="117"/>
<div class='midhead'>
	<?php
	
	if($general->logged_in()){ ?>
	Hello :Someone | <a href='update'>Update Info</a> | <a href='logout.php'>Log Out</a>
	
	<?php
	//var_dump( $general->logged_in());
	}
	else{
		var_dump($general->logged_in());
	?>
			
			<?php }?>
			<form action="" method="get">
					<input type="search" name="q" value="<?php echo (isset($_GET['q']))? trim($_GET['q']):'';?>" class="stxt" placeholder="Search Here" required/>
					<input type="submit" name="search" class="sbtn" value="search"/><br />
				</form>
                <?php
				include_once 'dbclass/dbset.php';
				if(isset($_GET['q']) && !empty($_GET['q']))
				{
					$gen->saveSearch($_GET['q']);
				}
				?>
     </div>       
            
            	<div id="adshere">
	                <h3>ADS HERE, CONTACT 0931463155</h3>
                </div>
    </div>
</header>
