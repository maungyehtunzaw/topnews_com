<?php
class Articlemgr{

	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	public function getallarticle($id)
	{
		$query = $this->db->prepare("SELECT * FROM `category` WHERE `parent_id`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}
	public function getNewsImage($id)
	{
		$query = $this->db->prepare("SELECT url,thumb_url,caption FROM image WHERE id= ?");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetch();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
public function getNewsImageId($id)
	{
		$query = $this->db->prepare("SELECT url,thumb_url,caption FROM image I LEFT JOIN news N ON I.id=N.imgid WHERE N.id=?");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetch();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function getallart()
	{$query = $this->db->prepare("SELECT * FROM news");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
		}
		
	
public function getarticlebyid($id)
		{
		$query = $this->db->prepare("SELECT N.*,A.pre_name,A.name FROM `news` N LEFT JOIN admin A ON N.adminid=A.id WHERE N.id=? ");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetchAll();
			} catch(PDOException $e){
				die($e->getMessage());
				}
		}

public function getSelectedId($id)
		{
		$query = $this->db->prepare("SELECT * FROM `news` WHERE id=$id ORDER BY c_date DESC limit 1");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetch();
			} catch(PDOException $e){
				die($e->getMessage());
				}
		}
		
	public function lastnews()
	{
		$query = $this->db->prepare("SELECT * FROM news ORDER BY c_date DESC limit 1");
		try{
			$query->execute();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetch();
		}
	
	public function searchnews($kword,$start,$limit)
	{
		$query=$this->db->prepare("select * from news where keyword_ LIKE '%$kword%' || title LIKE '%$kword%' ORDER BY c_date LIMIT $start, $limit");
		//$query->bindValue(1, $kword);
		//$query->bindValue(2,$kword);
	try{
		$query->execute();
		return $query->fetchAll();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
public function searchResultCount($kword)
	{
		$query=$this->db->prepare("select id from news where keyword_ LIKE '%$kword%' || title LIKE '%$kword%' ORDER BY c_date");
		try{
			$query->execute();
			return $query->rowCount();
		}
		catch(PDOExecption $e)
		{
			die($e->getMessage());
		}
	}

public function searchResultNewsID($kword)
	{
		$query=$this->db->prepare("select id from news where keyword_ LIKE '%$kword%' || title LIKE '%$kword%' ORDER BY c_date");
		try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOExecption $e)
		{
			die($e->getMessage());
		}
	}

	public function getnewsidfromcat($id)
	{
		$query=$this->db->prepare("select * from newscat where catid=?");
		$query->bindValue(1, $id);
		//$query->bindValue(2,$kword);
	try{
		$query->execute();
		//	return $count=$query->rowCount();
			return $query->fetchAll();
			
			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
	function getLastTenNews()
	{
		$query=$this->db->prepare("select * from news order by c_date desc limit 0,10");
		try{$query->execute();
		return $query->fetchAll();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
function getTopViewNews()
	{
		$query=$this->db->prepare("select * from news order by view_count DESC limit 0,10");
		try{$query->execute();
		return $query->fetchAll();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
function addViewCount($ID){
		$query=$this->db->prepare("select vcount from new where idnew=?");
		$query1=$this->db->prepare("update news set view_count=? where idnew=?");
		$query->bindValue(1,$ID);
		$query1->bindValue(1,$vcou);
		$query1->bindValue(2,$ID);
		try{
			$query->execute();
			$row=$query->fetch();
			$vcou=$row['vcount']+1;
			$query1->execute();
			
			}
		catch(PDOException $e){
			die($e->getMessage());
			}
	}

	
function getCatTabByNsID($NID) //get categoryID of news by article id
	{
		$query=$this->db->prepare("select catid from newscat where id=?");
		$query->bindValue(1,$NID);
		try{
			$query->execute();
			return $query->fetchAll();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}

function getNewsByMonthLink() //To Views Monthly Achieve news categorized for Link
	{
		$query=$this->db->prepare("select date_format(c_date,'%M %Y') AS mon_year,DATE_FORMAT(c_date,'%m%Y') AS mon from news group by DATE_FORMAT(c_date,'%m %Y') ORDER BY c_date DESC;");
		try{
			$query->execute();
			return $query->fetchAll();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}

public function getNewsByMonth($month,$start,$limit) //To Views Monthly Achieve news categorized for Link
	{
		$query=$this->db->prepare("select * from news where DATE_FORMAT(c_date,'%m%Y')=?  ORDER BY c_date LIMIT $start, $limit");
		$query->bindValue(1,$month);
		var_dump($query);
		try{
			$query->execute();
			return $query->fetchAll();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
public function getNewsIDByMonth($month) 
	{
		$query=$this->db->prepare("select id from news where DATE_FORMAT(c_date,'%m')=?  ORDER BY c_date");
		$query->bindValue(1,$month);
		try{
			$query->execute();
			return $query->fetchAll();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}


public function getNewsByMonthTotal($month) //To Views Monthly Achieve news categorized for Link
	{
		$query=$this->db->prepare("select  id as total from news where DATE_FORMAT(c_date,'%m%Y')=?");
		$query->bindValue(1,$month);
		try{
				$query->execute();
			return $query->rowCount();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}


function getRelatedNews($newsk) //To Views Monthly Achieve news categorized for Link
	{
		$query=$this->db->prepare("select * from news where keyword_ LIKE '$newsk' ORDER BY c_date DESC limit 1,5");
		print_r($query);
		try{
			$query->execute();
			return $query->fetchAll();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}	

function getLastNewsIdOfCat($catid){
	$query=$this->db->prepare("select id as lstid from newscat where catid=? order by c_date limit 0,1");
	$query->bindValue(1,$catid);
	try{
		$query->execute();
		return $query->fetch();
		}
		catch(PDOException $e){
			die($e->getMessage());
			}
}

function getLatestListFromCat($catid){
	$query=$this->db->prepare("SELECT n.id, n.title, n.imgid
FROM newscat nc
LEFT JOIN news n ON nc.newsid = n.id
WHERE nc.catid =? limit 1,5");
	$query->bindValue(1,$catid);
	try{
		$query->execute();
		return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage());
			}
}

	public function getNewsGroupByCat($id)
	{
		$query = $this->db->prepare("SELECT NC.id, catid, newsid, N.id as nid,title
FROM newscat NC
RIGHT JOIN news N ON NC.newsid = N.id WHERE catid=?
ORDER BY NC.id
LIMIT 0 , 30");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetch();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
function getLatesteNewFromCat($cid){
	$query=$this->db->prepare("SELECT  n.id,n.title,n.imgid, LEFT (n.content,110) as content FROM newscat nc
LEFT JOIN news n ON nc.newsid = n.id WHERE nc.catid =?
ORDER BY c_date LIMIT 0,1");
$query->bindValue(1,$cid);
try{
	$query->execute();
	return $query->fetch();
	}	
	catch(PDOException $e){
		die($e->getMessage());
	}

}
function getPreviousID($nid){
	$query=$this->db->prepare("SELECT id,LEFT(title,45) as title FROM news WHERE  id< ? ORDER BY id DESC LIMIT 1;");
	$query->bindValue(1,$nid);
	try{
		$query->execute();
		return $query->fetch();
	}
	catch(PDOException $e){
		die($e->getMessage());
	}
}
function getNextID($nid){
	$query=$this->db->prepare("SELECT id,LEFT(title,45) as title FROM news WHERE id >? ORDER BY id LIMIT 1");
	$query->bindValue(1,$nid);
	try{
		$query->execute();
		return $query->fetch();
	}
	catch(PDOException $e){
		die($e->getMessage());
	}
}

}
?>
