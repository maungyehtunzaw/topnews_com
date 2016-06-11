<?php
$lastart=$art->lastnews();
$lsimg=$art->getNewsImage($lastart['imgid']);
//var_dump($lsimg);
extract($lastart);
?>
	<div id="columone">
    	<div id="lastnews" class="clr_btn">
        	 <div id="img1"><img src="<?=$lsimg['url'];?>" width="420" height="300" title="<?=$lsimg['caption'];?>" /></div>
   	      		<span id="tit1"><?=$title;?></span>
       	  			<p id="cont1"><?=strip_tags(substr($content,0,200));?>... <a href="index.php?newsid=<?=$id;?>">full story</a></p>
    	</div><!-- lastnews close -->
        <div class="piclib">
        Picture Libaray
        </div>
      
    </div>
  
  <div id="contentbody">  
    <div id="columtwo">
		<?php 
				//	$lstid=1; 
			$toptwo=$cat->getTopViewTwoCatId();
				foreach($toptwo as $tops){
						$catIdData=$cat->getSelectedIdData($tops['id']);
						?>
		<div class="newsbox">
      		<div class="title"><?=$catIdData['title'];?></div>
            	<?php
					$lasnew1=$art->getLatesteNewFromCat($tops['id']);//catid parameter
					$lasimg1=$art->getNewsImage($lasnew1['imgid']);?>
     			<div class="lastnewrow">
        			<img src="<?=$lasimg1['thumb_url'];?>" width="180px" height="150px" />
	        			<div class="shtart">
    		    			<span><?=$lasnew1['title'];?></span>
		        <p><?=strip_tags($lasnew1['content']);?>... <a href="index.php?newsid=<?=$lasnew1['id'];?>">full story</a></p>
        </div>
      </div>
     
    <div class="newslist1">
      <ul>
	  <?php 
			$latest=$art->getLatestListFromCat($tops['id']);
			if($latest!=''){
			foreach($latest as $late){
		?>
      	<li><a href="index.php?newsid=<?=$late['id'];?>"><?=$late['title'];?></a></li>
		<?php 
				}
			}
		?>
        <a href="categorylisting.php?cat=<?=$tops['id'];?>">see all <?=$catIdData['title'];?></a>
      </ul>
   </div>
  </div><!-- close of newsbox-->
  <?php
					}
					?>
  <!-- Tab Content-->
  
  
  </div><!-- close of columtwo-->

</div><!-- end class="contentbody"-->
