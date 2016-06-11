<?php
include_once 'dbconnect.php';
class subscriber{

	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	public function getAllSubscriber()
	{
		$query = $this->db->prepare("SELECT * FROM `subscriber` WHERE  status!='delete'");
		try{
			$query->execute();
			return $query->fetchAll();
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

public function getAllNews()
	{$query = $this->db->prepare("SELECT id,imgid,title FROM news WHERE status != 'delete' ORDER BY c_date");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
		}
		
 public function addarticle($tit,$cont,$stat,$adminid){
		 $date= date('Y-m-d');
		 $query=$this->db->prepare("insert into `news` (`art_title`, `art_content`, `art_status`, `Admin_tbl_admin_id`,`art_c_date`) VALUES (?, ?, ?, ?, ?) ");
		 
		$query->bindValue(1, $tit);
		$query->bindValue(2, $cont);
		$query->bindValue(3, $stat);
		$query->bindValue(4, $adminid);
		//$query->bindValue(5, $imgid);
		$query->bindValue(5, $date);

		try{
			$query->execute();

		}catch(PDOException $e){
			die($e->getMessage());
		}
	 }
	 
public function searchNews($cat,$stat,$keyword)
	{
		$catq=isset($cat)? 'A.catid='.$cat:'';
		$statq=isset($stat)? 'B.status='.$stat:'';
		$keyq=isset($keyword)? 'B.keyword_='.$keyword:'';
		$query = $this->db->prepare("SELECT catid, B.id, A.newsid, title, imgid
FROM newscat A
RIGHT JOIN news B ON A.newsid = B.id
WHERE A.catid =5
AND B.status = 'enable'
AND B.keyword_ = 'test'"
);
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
		}

}
?>
