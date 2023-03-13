<?php 
	require_once '../../../config/db.php';

	function deleteClient($numCli){
		global $db;

		$numCli = htmlspecialchars(trim($numCli));
		$sql = "DELETE FROM client WHERE numCli = ?";
		$req = $db->prepare($sql);
		$req->execute([$numCli]);
	}


	if (!empty($_POST['numCli'])) {
		 $errors = [];
		 extract($_POST);	 
		 	deleteClient($numCli);
		 	setFlash('Suppression avec success');
		?>
		<script type="text/javascript">
			window.location.replace('?page=client');
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
