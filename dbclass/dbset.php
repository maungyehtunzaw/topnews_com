<?php
require 'dbconnect.php';
require 'categorymgr.php';
require 'articlemgr.php';
require 'mygeneral.php';
require 'adsmanager.php';
require 'user.php';
require 'comment.php';
require 'general.php';
require 'bcrypt.php';

$cat=new catmgr($db);
$art=new articlemgr($db);
$gen=new mygeneral($db);
$ads=new adsmgr($db);
$usr=new User($db);
$comm=new Comment($db);
$general=new General($db);
$bcrypt = new Bcrypt(12);

$errors = array();

if ($general->logged_in() === true)  {
	$user_id 	= $_SESSION['id'];
	//$user 		= $users->userdata($user_id);
}

ob_start(); // Added to avoid a common error of 'header already sent'
?>