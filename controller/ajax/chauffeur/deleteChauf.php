<?php 
	require_once '../../../config/db.php';

	function deleteChauf($numChauf){
		global $db;

		$numChauf = htmlspecialchars(trim($numChauf));
		$sql = "DELETE FROM chauffeur WHERE numChauf = ?";
		$req = $db->prepare($sql);
		$req->execute([$numChauf]);
	}


	if (!empty($_POST['numChauf'])) {
		 $errors = [];
		 extract($_POST);	 
		 	deleteChauf($numChauf);
		 	setFlash('Suppression avec success');
		?>
		<script type="text/javascript">
			window.location.replace('?page=chauffeur');
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
