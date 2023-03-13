<?php 
	require_once '../../../config/db.php';

	function deleteBack($numPret){
		global $db;

		$numPret = htmlspecialchars(trim($numPret));
		$sql = "DELETE FROM pret WHERE numPret = ? AND rendu = 1";
		$req = $db->prepare($sql);
		$req->execute([$numPret]);
	}

	if (!empty($_POST['numPret'])) {
	 	$errors = [];
 		extract($_POST);	 
	 	deleteBack($numPret);
	 	setFlash('Suppression avec success');
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
