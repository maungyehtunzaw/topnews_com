<?php
include_once 'dbconnect.php';

class catmgr{
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	public function gettopcat($id)
	{
		$query = $this->db->prepare("SELECT * FROM `category` WHERE `parent_id`= ? && status='enable'  ");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}
	public function getsubcat($id)
	{
		$query = $this->db->prepare("SELECT * FROM `category` WHERE `id`= ?");
		$query->bindValue(1, $id);

		try{
			$query->execute();
			return $query->fetchAll();
		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

public function getAllCat()
	{$query = $this->db->prepare("SELECT * FROM category WHERE status!='delete' ");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
		}
		
public function getparentcat($id)
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
public function getParentID($id){
	$query=$this->db->prepare("SELECT parent_id FROM `category` WHERE id =?");
	$query->bindValue(1,$id);
	try{
		//var_dump($query);
		$query->execute();
		return $query->fetch();
	}
	catch(PDOException $e){
		die($e->getMessage());
	}

	}
}
?>