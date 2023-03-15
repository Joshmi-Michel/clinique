<?php 	
	require_once 'config/db.php';

	$pages = scandir("vues/");

	if (isset($_GET['page'])){
		if (in_array($_GET['page'].'.php', $pages)){
			$page = $_GET['page'];
		} else {
			$page = 'home';
		}
		
	} else {
		$page = 'login';
	}


	$functionsPhp = scandir("model/");
	$functionsJs = scandir("controller/js/");

	if ($page != 'login' && $page != 'logout') {		
		require_once 'layouts/header.php';
		require_once 'layouts/navbar.php';
	}
	
	?>
	<?php
	if (in_array($page.'.func.php', $functionsPhp)) {
		require 'model/'.$page.'.func.php';
	}	
	require 'vues/'.$page.'.php';

	if ($page !='login' && $page != 'logout') {
		require_once 'layouts/footer.php';
	}

	if (in_array($page.'.func.js', $functionsJs)) {
	?>
		<script type="text/javascript" src="controller/js/<?= $page ?>.func.js"></script>
	<?php
	}	
 ?>
