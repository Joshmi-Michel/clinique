<?php 
	unset($_SESSION['auth']);
	session_destroy();
	header('Location:?page=login');
	die();
?>