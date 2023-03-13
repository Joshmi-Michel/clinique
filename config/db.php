<?php 
	session_start();
	setlocale(LC_TIME, 'fr');
	$website_name = "clinique";
	$host = "127.0.0.1";
	$dbname = "gynecare";
	$username = "root";
	$password = "";

	try{
		$db = new PDO("mysql:host=".$host.";dbname=".$dbname,$username,$password);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	}catch(PDOException $e){
		die("Une erreur est survenue lors de la connexion a la base de donnee <br>".$e->getMessage());
	}

	function setFlash($message,$type='success'){
		$_SESSION['flash']['message'] = $message;
		$_SESSION['flash']['type'] = $type;
	}
 ?>