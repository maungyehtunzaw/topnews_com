<?php
class catmgr{
	private $db;
	public function __construct($database) {
	    $this->db = $database;
	}	

public function gettopcat($id)
	{
		$query = $this->db->prepare("SELECT * FROM `category` WHERE `parent_id`= ? && status='enable'");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetchAll();
		} catch(PDOException $e){

			die($e->getMessage());
		}
	}
	
	public function getSelectedIdData($id)
	{
		$query = $this->db->prepare("SELECT title FROM `category` WHERE `id`= ?");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetch();
		} catch(PDOException $e){

			die($e->getMessage());
		}
	}
	
	public function getsubcat($id)
	{
		$query = $this->db->prepare("SELECT * FROM `category` WHERE `id`= ? && status='enable'");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}
	public function getallcat()
	{$query = $this->db->prepare("SELECT * FROM category where status='enable'");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
		}
		
public function getAllCatByViewSort() //use in usersubscribe.php for user subscriber
	{
		$query = $this->db->prepare("SELECT id,title FROM category where status='enable' ORDER BY view_count");
	try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
		}
		

public function getarticleid($id)
	{
		$query = $this->db->prepare("SELECT id FROM `newscat` WHERE `id`= ?");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetchAll();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function getTagsOfNews($id)
		{
			$query = $this->db->prepare("SELECT catid FROM `newscat` WHERE `newsid`= ?");
			$query->bindValue(1, $id);
				try{
					$query->execute();
					return $query->fetchAll();
				} 
				catch(PDOException $e){
				die($e->getMessage());
				}
		}
		
	public function getCatTitlebyID($catid)
		{
			$query=$this->db->prepare("select id,title from category where id=?");
			$query->bindValue(1,$catid);
				try{$query->execute();
					return $query->fetch();}
				catch(PDOException $e){
				die($e->getMessage());
				}
		}
	
	public function getsutcategory($catid){
		$query=$this->db->prepare("select idcat from category where parent_id=?");
		$query->bindValue(1,$catid);
		try{$query->execute();
		return $query->fetchAll();}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function subcat_exist($catid) {
		$query = $this->db->prepare("SELECT COUNT(`idcat`) FROM `category` WHERE `parent_id`= ?");
		$query->bindValue(1, $catid);
		try{
			$query->execute();
			$rows = $query->fetchColumn();
			if($rows == 0){
				return false;
			}else{
				return true;
			}
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function getTopViewTwoCatId(){
		$query=$this->db->prepare("SELECT id FROM category WHERE status!='disable' && cat_lvl='top' ORDER BY view_count DESC  LIMIT 0,3");
		try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public function getTopViewTagsGroup(){
		$query=$this->db->prepare("SELECT id,title FROM category WHERE status!='disable' && cat_lvl='top' ORDER BY view_count DESC  LIMIT 2,7");
		try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}
	/*
 public function getSubCatIDs($cid){ // not use 
	 $carr[]=$cid; //3 LEVEL
foreach($this->gettopcat($cid) as $sub) // 7 and 8
	{
		$carr[]=$sub['id'];
		foreach($this->gettopcat($sub['id']) as $catsub){
			$carr[]=$catsub['id'];
		}
	}
		return array_unique($carr);
 }*/

}
?>