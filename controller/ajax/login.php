<?php 
	require_once '../../config/db.php';

	function login($login,$password){
		global $db;

		$login = htmlspecialchars(trim($login));
		$password = md5($password);

		$sql = 'SELECT * FROM admin WHERE login = ? AND password = ?';
		$req = $db->prepare($sql);
		$req->execute([$login,$password]);

		$results = $req->fetch();

		return $results;
	}


	if (!empty($_POST['login']) && !empty($_POST['password'])) {
		 $errors = [];
		 extract($_POST);	 
		 	
		 	$resultat = login($login,$password);

		 	if ($resultat == false) {
		 		
		 		$_SESSION['auth'] = $resultat;
		 	?>
		 		<script type="text/javascript">
		 			window.location.replace("?page=home")
		 		</script>
		 	<?php

		 	} else {
		 		$errors[] = "Login ou mot de passe incorrecte";
		 	}	

		 
	} else {
		$errors[] = "Veuillez remplir tous les champs";
	}
	
 ?>
<?php 
	if (!empty($errors)) {
		foreach ($errors as $error) {
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <?= $error ?>
		</div>
		<?php
		}
	} 
 ?>
