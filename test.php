<?php
$NID=isset($_GET['newsid'])? $_GET['newsid']:3;
include_once 'dbclass/dbset.php';
$news=$art->getarticlebyid($NID);
echo $NID;
//$nxt=$art->getNextIdNTit($NID);
//$prv=$art->getPrvIdNTit($NID);
foreach($news as $dtil){

	extract($dtil);
		?>
		
	<div>
    <div class="detailtit"><?=$title;?></div>
    <div class="mainpic">
    </div>
    <div class="sumr">
    	<table align="center"; border="2">
        	<tr>
            	<td width="100px">writed by</td>
                <td><?=$adminid;?></td>
            </tr>
            <tr>
            	<td>Created Date</td>
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
     	<a href="">&lt;&lt;Previous</a>
    </td>
	<td width="50%" align="right">
    	<a href="">Next&gt;&gt;</a>
    </td>    
</tr>
</table>