<?php
include_once 'dbconnect.php';
class articlemgr{

	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	public function getAllNewsData($id)
	{
		$query = $this->db->prepare("SELECT * FROM news WHERE id=?");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetch();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

public function getNewsImg($id)
	{
		$query = $this->db->prepare("SELECT url,thumb_url,caption FROM image WHERE id= ?");
		$query->bindValue(1, $id);
	try{
		$query->execute();
		return $query->fetch();
			}
	 catch(PDOException $e){
		die($e->getMessage());
		}
	}

public function getAllNews($start,$limit)
	{$query = $this->db->prepare("SELECT id,imgid,title FROM news WHERE status != 'delete' ORDER BY c_date LIMIT $start, $limit");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
		}

public function AllNewsCount()
	{
		$query = $this->db->prepare("SELECT id FROM news WHERE status != 'delete' ");
		
		try{
			$query->execute();
			return $query->rowCount();
		}
		catch(PDOExecption $e)
		{
			die($e->getMessage());
		}
	}
		
function make_thumb($img_name,$filename,$new_w,$new_h)
{
			  $ext=$this->getExtension($img_name);
				  if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
				  $src_img=imagecreatefromjpeg($img_name);
			  if(!strcmp("png",$ext))
			  $src_img=imagecreatefrompng($img_name);
			  $old_x=imageSX($src_img);
			  $old_y=imageSY($src_img);
			  $ratio1=$old_x/$new_w;
			  $ratio2=$old_y/$new_h;
			  if($ratio1>$ratio2) {
			  $thumb_w=$new_w;
			  $thumb_h=$old_y/$ratio1;
			  }
			  else {
			  $thumb_h=$new_h;
			  $thumb_w=$old_x/$ratio2;
			  }
			  
			  $dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
			  imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
			  if(!strcmp("png",$ext))
			  imagepng($dst_img,$filename);
			  else
			  imagejpeg($dst_img,$filename);
			  imagedestroy($dst_img);
			  imagedestroy($src_img);
}
function getExtension($str) {
		  $i = strrpos($str,".");
		  if (!$i) { return ""; }
		  $l = strlen($str) - $i;
		  $ext = substr($str,$i+1,$l);
		  return $ext;
}
 public function imageUpload($image){
	 define ("MAX_SIZE","250");
	define ("WIDTH","150");
	define ("HEIGHT","150");
$filename = stripslashes($_FILES['image']['name']);
$extension = $this->getExtension($filename);
$extension = strtolower($extension);
$image_name=time().'.'.$extension;
if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png"))
{
echo '<h1>Unknown extension!</h1>';
$errors=1;
}
else
{
$size=getimagesize($_FILES['image']['tmp_name']);
$sizekb=filesize($_FILES['image']['tmp_name']);
if ($sizekb > MAX_SIZE*20000)
{
echo '<h1>You have exceeded the size limit!</h1>';
$errors=1;
}
$newname="../newsimg/".$image_name;
$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied)
{
echo '<h1>Copy unsuccessfull!</h1>';
$errors=1;
}
else
{
$thumb_name='../newsimg/thumbs/thumb_'.$image_name;
$thumb=$this->make_thumb($newname,$thumb_name,WIDTH,HEIGHT);
}
}
return array($newname,$thumb_name);
}
 public function addNews($imgname,$thumbname,$cap,$admid,$title,$description,$content,$tags,$kwords,$c_date,$status,$catid){
		 $date= date('Y-m-d');
		 $query1=$this->db->prepare("INSERT INTO image (url,thumb_url,caption) VALUES (?,?,?)");
		 $query2=$this->db->prepare("INSERT INTO news (adminid,title,content,tags,keyword_,c_date,status,description,imgid) VALUES (?,?,?,?,?,?,?,?,?)");
		 $query3=$this->db->prepare("INSERT INTO newscat (newsid,catid) VALUES (?,?)");
		 
		$query1->bindValue(1, $imgname);
		$query1->bindValue(2, $thumbname);
		$query1->bindValue(3,$cap);
		$query2->bindValue(1,$admid);
		$query2->bindValue(2,$title);
		$query2->bindValue(3,$content);
		$query2->bindValue(4,$tags);
		$query2->bindValue(5,$kwords);
		$query2->bindValue(6,$c_date);
		$query2->bindValue(7,$status);
		$query2->bindValue(8,$description);
		try{
			$query1->execute();
			$imgid=$this->db->lastInsertId();
			$query2->bindValue(9,$imgid);
			$query2->execute();
			$newid=$this->db->lastInsertId();
			$query3->bindValue(1,$newid);
			$query3->bindValue(2,$catid);
			$query3->execute();

		}catch(PDOException $e){
			die($e->getMessage());
		}
	 }

public function editNews($nid,$imgid,$imgname,$thumbname,$cap,$admid,$title,$description,$content,$tags,$kwords,$c_date,$status,$catid){
		 $date= date('Y-m-d');
		 $query1=$this->db->prepare("UPDATE  image SET url=?,thumb_url=?,caption=? WHERE id=$imgid;");
		 $query2=$this->db->prepare("UPDATE  news SET adminid=?, title=?, content=?, tags=?, keyword_=?, c_date=?,status=?, description=? WHERE id=$nid");
		 $query3=$this->db->prepare("INSERT INTO newscat (newsid,catid) VALUES (?,?)");
		 
		$query1->bindValue(1, $imgname);
		$query1->bindValue(2, $thumbname);
		$query1->bindValue(3,$cap);
		$query2->bindValue(1,$admid);
		$query2->bindValue(2,$title);
		$query2->bindValue(3,$content);
		$query2->bindValue(4,$tags);
		$query2->bindValue(5,$kwords);
		$query2->bindValue(6,$c_date);
		$query2->bindValue(7,$status);
		$query2->bindValue(8,$description);
		try{
			$query1->execute();
			$imgid=$this->db->lastInsertId();
			$query2->bindValue(9,$imgid);
			$query2->execute();
			$newid=$this->db->lastInsertId();
			$query3->bindValue(1,$newid);
			$query3->bindValue(2,$catid);
			$query3->execute();

		}catch(PDOException $e){
			die($e->getMessage());
		}
	 }
	 
public function searchNews($cat,$stat,$keyword,$start,$limit)
	{
		$catq=($cat=='')? '':'AND A.catid ='.$cat;
		$statq=($stat=='')? "":"AND B.status= '".$stat."'" ;
		$keyq=($keyword=='')? "":"AND B.keyword_  LIKE '%".$keyword."'";
		$query = $this->db->prepare("SELECT catid, B.id, A.newsid,title, imgid
FROM newscat A
RIGHT JOIN news B ON A.newsid = B.id
WHERE 1=1 $catq $statq $keyq ORDER BY c_date DESC LIMIT $start, $limit ");

$query1 = $this->db->prepare("SELECT B.id FROM newscat A 
RIGHT JOIN news B ON A.newsid = B.id
WHERE 1=1 $catq $statq $keyq");
				
		try{
			$query->execute();
			$query1->execute();
		
		}catch(PDOException $e){
			die($e->getMessage());
		}
		 $count= $query1->rowCount();	
		 $result= $query->fetchAll();
	 return array($count,$result);
		}

}
?>
