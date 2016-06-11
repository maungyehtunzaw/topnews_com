    <?php
			include_once 'db/artmgr.php';
			include_once 'db/catmgr.php';
			$art=new articlemgr($db);
			$cat=new catmgr($db);
			$allcat=$cat->getAllCat();
		?>
        <?php
		if(isset($_GET['id'])){
			$NS=$art->getAllNewsData($_GET['id']);
			$Nimg=$art->getNewsImg($NS['imgid']);
		}

		if($_GET['action']=='view')
		{
			echo $view=true;
			echo 'view';
		}
		

		?>
		
	<form action='' method='post' ENCTYPE="multipart/form-data">
    
	<table border="1">
    <caption> <?=$_GET['action'];?>ing Article
		<tr>
			<td width='150px'>
				Category
			</td>
			<td>
				<select name='category' >
                <?php 
				foreach($allcat as $cat){
				?>
                 <option value="<?=$cat['id'];?>">
                 <?=$cat['title'];?>
                </option>
                <?php }?>
                </select>
			</td>
		</tr>
		<tr>
			<td>
				Tags
			</td>
			<td>
				<textarea placeholder="some search engine text" name="tag" required="required"
				<?=($_GET['action']=='view')? 'disabled="disabled"':'';?> ><?php if(isset($_POST['tag'])){
				echo $_POST['tag'];
				}elseif(isset($_GET['id'])){
				echo $NS['tags'];}?></textarea>
			</td>
		</tr>
		<tr>
			<td>
				Keyword / Meta Tags
			</td>
			<td>
				<input type='text' name='keyword' required="required" <?=($_GET['action']=='view')? 'disabled="disabled"':'';?>  value="<?php if(isset($_POST['keyword'])){echo trim($_POST['keyword']);} elseif(isset($_GET['id'])){echo $NS['keyword_'];}?>">
			</td>
		</tr>
		<tr>
			<td>
				Description
			</td>
			<td>
				<textarea name="sdescri" placeholder="Short Description" <?=($_GET['action']=='view')? 'disabled="disabled"':'';?>><?php if(isset($_POST['sdescri'])){echo trim($_POST['sdescri']);}elseif(isset($_GET['id'])){echo $NS['description'];}?></textarea>
			</td>
		</tr>
        <tr>
			<td>
				Status
			</td>
			<td>
				<select name="status" <?=($_GET['action']=='view')? 'disabled="disabled"':'';?>>
                	<option value="enable">Publish</option>
                	<option value="pending">Save Draft</option>
                </select>                    
			</td>
		</tr>
		<tr>
			<td>
				Created Date
			</td>
			<td>
				<input type='date' name='created' <?=($_GET['action']=='view')? 'disabled="disabled"':'';?>  value="<?php if(isset($_POST['created'])){echo trim($_POST['created']);} elseif(isset($_GET['id'])){echo $NS['c_date'];}?>">
			</td>
		</tr>
		<tr>
			<td>
				Title
			</td>
			<td>
				<input type='text' name='title' required="required" <?=($_GET['action']=='view')? 'disabled="disabled"':'';?>  value="<?php if(isset($_POST['title'])){echo trim($_POST['title']);} elseif(isset($_GET['id'])){echo $NS['title'];}?>">
			</td>
		</tr>
		<tr>
			<td>
				Image
			</td>
			<td>
            <div id="imagePreview"></div>
				<input type='file' name='image' id="uploadFile" <?=($_GET['action']=='view')? 'disabled="disabled"':'';?>>
                
			</td>
		</tr>
		<tr>
			<td>
				Image Description
			</td>
			<td>
				<input type='text' name='caption' required="required" <?=($_GET['action']=='view')? 'disabled="disabled"':'';?> value="<?php if(isset($_POST['caption'])){echo trim($_POST['caption']);} elseif(isset($_GET['id'])){echo $Nimg['caption'];}?>">
			</td>
		</tr>
		<tr>
			<td>
				Content
			</td>
			<td>
				<!-- lll-->
             
<textarea cols="80" rows="10" id="area2" name="content">
<?=isset($_GET['id'])? trim($NS['content']):''; ?><?php if(isset($_POST['content'])){
				echo $_POST['content'];
				}elseif(isset($_GET['id'])){
				echo $NS['content'];}?>
</textarea>
                <!-- lll-->
			</td>
		</tr>
		<tr>
        	<td>
            </td>
			<td>
				<input type=submit value='<?=$_GET['action'];?>' name="action"'>
				<?php
				if($_GET['action']=='add'){
				?>
				<input type="reset"  value='clear'>				
				<?php
				}
				elseif($_GET['action']=='edit'){
				?>
				<input type="submit" value='delete'>
				<?php
				}
				elseif($_GET['action']=='view'){
				?>
				<input type="submit" value='edit'>
				<?php }
				?>
				<input type="submit" value='cancel'>
				
			</td>
		</tr>
		
	</table>
    <?php
	if(isset($_POST['action'])){
		if($_POST['action']=='add'){
			//do add new article action
			echo '<pre>'.var_dump($_POST).'</pre>';
			$img=isset($_POST['image'])? htmlentities(trim($_POST['image'])) : '';
			$cap=isset($_POST['caption'])? htmlentities(trim($_POST['caption'])) : '';
			$admid=1;
			$title=isset($_POST['title'])? htmlentities(trim($_POST['title'])) : '';
			$content=isset($_POST['content'])? trim($_POST['content']):'';
			$kwords=isset($_POST['keyword'])? htmlentities(trim($_POST['keyword'])) : '';
			$tags=isset($_POST['tag'])? htmlentities(trim($_POST['tag'])) : '';
			$c_date=isset($_POST['created'])? htmlentities(trim($_POST['created'])) : 'now()';
			$status=isset($_POST['status'])? htmlentities(trim($_POST['status'])) : '';
			$description=isset($_POST['sdescri'])? htmlentities(trim($_POST['sdescri'])) : '';
			$catid=isset($_POST['category'])? htmlentities(trim($_POST['category'])) : '';
			//$art->addNews($img,$cap,$admid,$title,$content,$tag,$kwords,$c_date,$status);
			$image=$_FILES['image']['name'];
			$img=$art->imageUpload($image);
			var_dump($img);
			echo $imgname=substr($img[0],3);
			echo $thumbname=substr($img[1],3);
			$art->addNews($imgname,$thumbname,$cap,$admid,$title,$description,$content,$tags,$kwords,$c_date,$status,$catid);
	        header ('Location : articlemgr.php?addsuccess');
								///($imgname,$thumbname,$cap,$admid,$title,$description,$content,$tags,$kwords,$c_date,$status,$catid)
		}
		elseif($_POST['action']=='edit'){
			$art->editNews();
		}
		elseif($_POST['action']=='delete'){
			//delete
		}
	}
	?>
<script src="js/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
new nicEditor({fullPanel : true}).panelInstance('area2');

});
</script>
<script type="text/javascript">
$(function() {
    $("#uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>