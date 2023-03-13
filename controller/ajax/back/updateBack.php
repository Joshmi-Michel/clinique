<?php 
	require_once '../../../config/db.php';

	function updateDateRetour($numPret,$dateRetour){
		global $db;

		$numPret = htmlspecialchars(trim($numPret));
		$dateRetour = date('Y-m-d',strtotime($dateRetour));

		$sql = "UPDATE pret SET dateRetour = ? WHERE numPret = ?";
		$req = $db->prepare($sql);
		$req->execute([$dateRetour,$numPret]);
	}


	if (!empty($_POST['numPret']) && !empty($_POST['dateRetour'])) {
		$errors = [];
		extract($_POST);
		
		updateDateRetour($numPret,$dateRetour);
		setFlash('Mise à jour avec success');
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
