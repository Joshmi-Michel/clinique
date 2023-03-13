<?php 
	require_once '../../../config/db.php';

	function deleteChauf($numU){
		global $db;

		$numU = htmlspecialchars(trim($numU));
		$sql = "DELETE FROM usine WHERE numU = ?";
		$req = $db->prepare($sql);
		$req->execute([$numU]);
	}


	if (!empty($_POST['numU'])) {
		 $errors = [];
		 extract($_POST);	 
		 	deleteChauf($numU);
		 	setFlash('Suppression avec success');
		?>
		<script type="text/javascript">
			window.location.replace('?page=usine');
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
