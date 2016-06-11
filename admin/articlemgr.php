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
<li ><a href='commentmgr.php'><span>Comment Manage</span></a></li>      
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
			include_once 'db/artmgr.php';
			include_once 'db/catmgr.php';
			include_once 'paging.php';
            $art=new articlemgr($db);
			$cat=new catmgr($db);
			$allcat=$cat->getAllCat();
		?>
            <?php if(!isset($_GET['action'])){ ?>
            			<a href="articlemgr.php?action=add" class="btn">ADD NEW ARTICLE</a>
            <div id="resetme"></div><p>
    
            <form action="" name="search" method="get">
            	<table>
                	<tr>
                    	<td><select name="cat">
                        			<option value="">--Choose Category---</option>
                        			<?php foreach($allcat as $allc) { ?>
                                    <option value="<?=$allc['id'];?>"><?=$allc['title'];?></option>
                                    <?php } ?>
                         		</select>
                         </td>
                    	<td><select name="status">
                        			<option value="">----Choose Status---</option>
                        			<option value="enable">enable</option>
                                    <option value="disable">disable</option>
                         		</select>
                         </td>                         	
                         <td>
                         		 <input type="text" name="keyword" placeholder="Search Keyword" />
                          </td>
                          <td>
                            	<input type="submit" name="search" value="search">
                                <input type="reset" name="reset" value="Clear">
                           </td>
                      </tr>
                </table>                  
            </form> 
			<?php if(isset($_GET['search'])){
				echo $category=isset($_GET['cat']) ? $_GET['cat'] : '';
				echo $status=isset($_GET['status']) ? $_GET['status'] : '';
				echo $keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
				if($category =='' && $status=='' && $keyword=='')
				{
					echo $erros="<div class='error'>Choose aleast one search Option</div>";
				}
				else{
					$limit=2;
					$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
					$start = ($page * $limit) - $limit;
					list($total,$allart)=$art->searchNews($category,$status,$keyword,$start,$limit);
					//$allart=$art->searchNews($category,$status,$keyword,$start,$limit);
					//$total=count($allart);
					//var_dump($total);
					$url="?search=".$_GET['search']."&keyword=".$keyword."&status=".$status."&cat=".$category."&";
					
					
					}
			}
			else{
			$total=$art->AllNewsCount();
			$url="articlemgr.php?";
			$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
			$limit = 4;
			$start = ($page * $limit) - $limit;
			$allart=$art->getAllNews($start,$limit);
			}
			?>
            
                    <?php
			
		
			echo pagination($limit,$page,$url,$total);
?>
            <?php foreach($allart as $news){ 
			$img=$art->getNewsImg($news['imgid']);
		//	var_dump($img);
			?>
			<div class="article_box">
				<img src="../<?=$img['thumb_url'];?>"  class="tooltip" title="<?=$img['caption'];?>"/>
                <a href="#view" class="tooltip" title="<?=$news['title'];?>"><?=substr($news['title'],0,10);?>...</a>
                <div class="action">
                	<a href="articlemgr.php?action=view&id=<?=$news['id'];  ?>" class='btn'>view</a>
					<a href="articlemgr.php?action=edit&id=<?=$news['id'];?>"  class='btn'>edit</a>
                	<a href='#' onclick='delete_news( {$id} );' class='btn'>delete</a>                    
                </div>
            </div>
            
            <?php } 
			?>
			<div id="resetme"></div>
			<?php
					echo pagination($limit,$page,$url,$total);
			}
			
			elseif(isset($_GET['action']) && !$_GET['action']=='')
			{
			include 'article.php';
			}
		

	
			?>
	</section>
   </div>
  
<script>
function delete_news( id ){
	
	var answer = confirm('Are you sure?');
	if ( answer ){
	
		//if user clicked ok, pass the id to delete.php and execute the delete query
		window.location = 'delete.php?id=' + id;
	} 
}
</script>
    <script src="js/tooltip.js"></script>
  <?php include_once 'htmlfooter.php' ?>