<?php 
	require_once '../../../config/db.php';

	function updateusine($numU,$nomU,$telU,$mailU){
		global $db;
		$numU = htmlspecialchars(trim($numU));
		$nomU = htmlspecialchars(trim($nomU));
		$telU = htmlspecialchars(trim($telU));
		$mailU = htmlspecialchars(trim($mailU));

		$sql = "UPDATE usine SET nomU = ?, telU = ?, mailU = ? WHERE numU = ?";
		$req = $db->prepare($sql);
		$req->execute([$nomU,$telU,$mailU,$numU]);
	}


	if (!empty($_POST['numU']) && !empty($_POST['nomU']) && !empty($_POST['telU']) && !empty($_POST['mailU'])) {
		 $errors = [];
		 extract($_POST);	 
		 	updateusine($numU,$nomU,$telU,$mailU);
		 	setFlash('Mise à jour avec success');
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
