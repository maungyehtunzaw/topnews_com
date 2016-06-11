<?php 
session_start();
require 'dbconnect.php';
require 'user.php';
require 'general.php';
require 'bcrypt.php';

// error_reporting(0);

$users 		= new Users($db);
$general 	= new General();
$bcrypt 	= new Bcrypt(12);

$errors = array();

if ($general->logged_in() === true)  {
	$user_id 	= $_SESSION['id'];
	$user 		= $users->userdata($user_id);
}

ob_start(); // Added to avoid a common error of 'header already sent'