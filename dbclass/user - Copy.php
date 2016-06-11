<?php
class User{

	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	

public function email_exist($mil)
	{
		$query = $this->db->prepare("select id,email,status from subscriber where email=?");
		$query->bindValue(1, $mil);
		try{
			$query->execute();
			$count=$query->rowCount();
			if($count!=1){
				return true;
			}
			else{
				return false;
			}
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
public function regNewEmail($email){
	$status='pending';
	$email_code=uniqid('yeye_',true);
	$ip	= $_SERVER['REMOTE_ADDR'];
	$type='allcat';
		$query=$this->db->prepare("insert into subscriber (email,status,email_code,ip,type,c_date) values (?,?,?,?,?,now())");
		$query->bindValue(1,$email);
		$query->bindValue(2,$status);
		$query->bindValue(3,$email_code);
		$query->bindValue(4,$ip);
		$query->bindValue(5,$type);
		try{
			$result=$query->execute();
		}
		catch(PDOException $e)
		{
		die($e->getMessage());
		}
	}
	
function regNewDetailEmail	($email,$cat){
	$status='pending';
	$email_code=uniqid('yeye_',true);
	$ip	= $_SERVER['REMOTE_ADDR'];
	$type='cust';	
 	$pin=rand(0,9).rand(0,9).rand(0,9).rand(0,9);
		$query=$this->db->prepare("INSERT into subscriber (email,status,email_code,ip,type,c_date,pin) values (?,?,?,?,?,now(),?)");
		$query1=$this->db->prepare("INSERT INTO usercat (user_id,cat_id) VAlUES (?,?)");
		$query->bindValue(1,$email);
		$query->bindValue(2,$status);
		$query->bindValue(3,$email_code);
		$query->bindValue(4,$ip);
		$query->bindValue(5,$type);
		$query->bindValue(6,$pin);
		var_dump($query);
		try{
			$query->execute();
			$id=$this->db->lastInsertId();
			//var_dump($id);
			foreach ($cat as $key => $value){ 
			$query1->bindValue(1,$id);
			$query1->bindValue(2,$value);
			$query1->execute();
			var_dump($query1);
			}
		//  print $this->lastInsertId();
		}
		catch(PDOException $e)
		{
		die($e->getMessage());
		}
}

public function checkStatus($email)
	{
		$query = $this->db->prepare("select id,status from subscriber where email=?");
		$query->bindValue(1, $email);
		var_dump($query);
		try{
			$query->execute();
			return $query->fetch();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
public function checkMailCode($id,$code){
	$query=$this->db->prepare("SELECT id  FROM subscriber WHERE id=? AND email_code=? ");
	$query->bindValue(1,$id);
	$query->bindValue(2,$code);
	var_dump($query);
	try{
			$query->execute();
			$count=$query->rowCount();
			if($count!=1){
				return false;
			}
			else{
				return true;
			}
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

public function activateEmail($id){
	$query=$this->db->prepare("UPDATE subscriber SET status='active',updated=NOW() WHERE id=?");
	$query->bindValue(1,$id);
	var_dump($query);
	try{
		$query->execute();
		}
catch(PDOException $e){
	die($e->getMessage());
}
}
public function getEmailId($email){
	$query=$this->db->prepare("SELECT id FROM subscriber WHERE email=?");
	$query->bindValue(1,$email);
	try{
		 $query->execute();
		 return $query->fetch();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
}

public function commentNews($nid,$message,$name,$email,$noti,$replyid=NULL){
	$emid=$this->getEmailId($email);
	$sid=$emid['id'];
	$query=$this->db->prepare("INSERT INTO comment (nid,reply_id,noti,sid,message,name,email,c_date) VALUES (?,?,?,?,?,?,?,NOW());");
	$query->bindValue(1,$nid);
	$query->bindValue(2,$replyid);
	$query->bindValue(3,$noti);
	$query->bindValue(4,$sid);
	$query->bindValue(5,$message);
	$query->bindValue(6,$name);
	$query->bindValue(7,$email);
//	$query->bindValue(6,NOW());
	var_dump($query);
	try{
		$query->execute();
		}
catch(PDOException $e){
	die($e->getMessage());
}
}
function getNewsComment($nid){
		$query=$this->db->prepare("SELECT * FROM comment WHERE  nid=? ORDER BY c_date DESC");
	$query->bindValue(1,$nid);
	try{
		 $query->execute();
		 return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
}
function getReplyById($rid){
$query=$this->db->prepare("SELECT * FROM comment WHERE  reply_id=? ORDER BY c_date DESC");
	$query->bindValue(1,$nid);
	try{
		 $query->execute();
		 return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
}

function getComments($row) {
	echo "<li class='combox'>";
	echo "<img src='img/avator.jpg' class='avator'/>";
	echo "<div class='txtspace'>";
	echo "<div class='name'>".$row['id'].$row['name']."</div>";
	echo $row['message']."</div>";
	echo "<div class='oplist'>";
	echo "<a href='test3.php?postid=".$row['id']."' class='reply' id='".$row['id']."'>Reply</a></div>";
	
	$query =$this->db->prepare("SELECT * FROM comment WHERE reply_id = ".$row['id']."");
//	try{
	$query->execute();
	if($query->rowCount()>0)
		{
		echo "<ul>";
		while($row=$query->fetch()) {
			$this->getComments($row);
		}
		echo "</ul>";
		}
	echo "</li>";
}

}
?>
