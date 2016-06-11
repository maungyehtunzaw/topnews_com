<?php
class Comment{

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
	//echo "<a href='' id='show'> </a>";
	//echo "<a href='test3.php?postid=".$row['id']."' class='reply' id='".$row['id']."'>Reply</a></div>";
	
	$query =$this->db->prepare("SELECT * FROM comment WHERE reply_id = ".$row['id']."");
//	try{
	$query->execute();
	if($query->rowCount()>0)
		{
		echo "<ul class='sub'>";
		while($row=$query->fetch()) {
			$this->getComments($row);
		}
		echo "</ul>";
		}
	echo "</li>";
}

public function getNewsComm($nid,$start,$limit){
	$query=$this->db->prepare("SELECT * FROM comment WHERE nid=2 ORDER By upvote-downvote DESC LIMIT $start,$limit");
//	$query->bindValue(1,$nid);
//	$query->bindValue(2,$start,PDO::PARAM_INT);
	//$query->bindValue(3,$limit,PDO::PARAM_INT);
	try{
		 $query->execute();
		 var_dump($query);
		 return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
}

}
?>
