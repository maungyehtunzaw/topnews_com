<?php
include_once 'dbconnect.php';

class  mygeneral{
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	

public function totalNews()
	{
		$query = $this->db->prepare("SELECT  count(id) as totalnews FROM `news` ");
		try{
			$query->execute();
			return $query->fetch();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
public function totalSubscriber()
	{
		$query = $this->db->prepare("SELECT  count(id) as totalscriber FROM `subscriber` ");
		try{
			$query->execute();
			return $query->fetch();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}}
?>