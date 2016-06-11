<?php
class Articlemgr{

	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	public function getallarticle($id)
	{
		$query = $this->db->prepare("SELECT * FROM `category_tbl` WHERE `parent_id`= ?");
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
		$query = $this->db->prepare("SELECT url,caption FROM image WHERE `idimage`= ?");
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
		$query = $this->db->prepare("SELECT * FROM `news` WHERE idnews=? ORDER BY c_date DESC");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetchAll();
			} catch(PDOException $e){
				die($e->getMessage());
				}
		}
		
	public function lastnews()
	{
		$query = $this->db->prepare("select * from news ORDER BY c_date DESC limit 1");
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetch();
		}
	
	public function searchnews($kword)
	{
		$query=$this->db->prepare("select * from news where keyword_ LIKE '%$kword%' || title LIKE '%$kword%'");
		//$query->bindValue(1, $kword);
		//$query->bindValue(2,$kword);
	try{
		$query->execute();
			 $count=$query->rowCount();
			return array($query->fetchAll(),$count);
			
			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function getnewsidfromcat($id)
	{
		$query=$this->db->prepare("select * from newscat where category_idcat=?");
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
		$query=$this->db->prepare("select * from news order by viewcount DESC limit 0,10");
		try{$query->execute();
		return $query->fetchAll();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
function addViewCount($ID){
		$query=$this->db->prepare("select vcount from new where idnew=?");
		$query1=$this->db->prepare("update news set viewcount=? where idnew=?");
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
function getNationalNs()
	{
		$query=$this->db->prepare("select * from news order by viewcount DESC limit 0,10");
		try{$query->execute();
		return $query->fetchAll();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
function getCatTabByNsID($NID) //get categoryID of news by article id
	{
		$query=$this->db->prepare("select category_idcat from newscat where news_idnews=?");
		$query->bindValue(1,$NID);
		try{
			$query->execute();
			return $query->fetchAll();
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
		
}
?>
