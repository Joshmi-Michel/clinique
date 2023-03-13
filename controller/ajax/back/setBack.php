<?php 
	require_once '../../../config/db.php';

	function setBack($numLecteur,$numLivre){
		global $db;

		$numLecteur = htmlspecialchars(trim($numLecteur));
		$numLivre = htmlspecialchars(trim($numLivre));
		
		$sql = "UPDATE pret SET rendu = 1 , dateRetour = NOW() WHERE numLecteur = ? AND numLivre = ?";
		$req = $db->prepare($sql);
		$req->execute([$numLecteur,$numLivre]);
	}

	function setDispo($numLivre)
	{
		global $db;
		$numLivre = htmlspecialchars(trim($numLivre));
		
		$sql = "UPDATE livre SET dispo = 'oui' WHERE numLivre = ?";
		$req = $db->prepare($sql);
		$req->execute([$numLivre]);
	}


	if (!empty($_POST['numLecteur']) && !empty($_POST['numLivre'])) {
		 $errors = [];
		 extract($_POST);
		 
	 	setBack($numLecteur,$numLivre);
	 	setDispo($numLivre);
	 	setFlash('Retour d\'ouvrage avec success');

		?>
	 	<script type="text/javascript">
			window.location.replace('?page=backLivre');
		</script>
	 	<?php

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
