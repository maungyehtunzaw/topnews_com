<?php
include_once 'dbconnect.php';
class adsmgr{
	private $db;
	public function __construct($database) {
	    $this->db = $database;
	}	

	public function getselectads($id) //get selected ads
	{
		$query = $this->db->prepare("SELECT * FROM `ads_tbl` WHERE `ads_id`= ?");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $query->fetch();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}


	public function getallads()
	{$query = $this->db->prepare("SELECT * FROM ads");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
		}
		
		
		public function getartimg($id)
	{
		$query = $this->db->prepare("SELECT * FROM `category_tbl` WHERE article_tbl_art_id= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	
	public function addnewads($adsname,$descr,$link,$price,$usrid,$tmpName,$mime,$status,$expdate){
		$img = fopen($tmpName,'rb');
		$time 		= date('Y-m-d');
		
		$query1 =$this->db->prepare("insert into 'image' ('url','caption') values (?,?)");
		$query1->bindValue(1,$url);
		$query1->bindValue(2,$caption);
		
		try{
			$query1->execute();
			$id=$query1->lastInsertId('idimage');

		}catch(PDOException $e){
			die($e->getMessage());
		}
		
		$query 	= $this->db->prepare("INSERT INTO `ads` (`name`, `description`, `link`, `pirce`, `Admin_tbl_admin_id`, `ads_c_date`,`ads_img`,`mime`,`status`,`ads_exp_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");

		$query->bindValue(1, $adsname);
		$query->bindValue(2, $descr);
		$query->bindValue(3, $link);
		$query->bindValue(4, $price);
		$query->bindValue(5, $usrid);
		$query->bindValue(6, $time);
		$query->bindValue(7, $img,PDO::PARAM_LOB);
		$query->bindValue(8, $mime);
		$query->bindValue(9, $status);
		$query->bindValue(10, $expdate);		

		try{
			$query->execute();

		}catch(PDOException $e){
			die($e->getMessage());
		}	
	} //end of new ads
	
	public function updateads($adsname,$descr,$link,$price,$userid,$status,$expdate,$adsid){
				$update= date('Y-m-d');
		$query = $this->db->prepare("UPDATE `ads_tbl` SET
								`ads_name`	= ?,
								`ads_description`		= ?,
								`ads_link`= ?,
								`ads_price`	= ?,								
								`ads_status`= ?,
								`ads_exp_date`= ?,																
								`ads_up_date`= ?								
								WHERE `ads_id`= ? 
								");
			$query->bindValue(1, $adsname);
			$query->bindValue(2, $descr);
			$query->bindValue(3, $link);
			$query->bindValue(4, $price);
			$query->bindValue(5, $status);
			$query->bindValue(6, $expdate);
			$query->bindValue(7, $update);
			$query->bindValue(8, $adsid);			
			//remain to update admin id left for contraint Integrity constraint violation
		try{
			$query->execute();
			}catch(PDOException $e){
			die($e->getMessage());
			}	
		}
	
}
?>
