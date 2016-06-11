<?php
class mygeneral{

	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	
	public function saveSearch($keyword)
	{
		$ip	= $_SERVER['REMOTE_ADDR'];
		$query=$this->db->prepare("INSERT INTO search (keyword, c_date,ip) VALUES (?,NOW(),?)");
		$query->bindValue(1,$keyword);
		$query->bindValue(2,$ip);
		try{
				$query->execute();
		}
	catch(PDOException $e)
		{
		die($e->getMessage());
		}
	}
	
}
?>
