<?php 
	require_once '../../../config/db.php';

	function updatechauffeur($numChauf,$nomChauf,$immVtr,$dispo){
		global $db;
		$numChauf = htmlspecialchars(trim($numChauf));
		$nomChauf = htmlspecialchars(trim($nomChauf));
		$immVtr = htmlspecialchars(trim($immVtr));
		$dispo = htmlspecialchars(trim($dispo));

		$sql = "UPDATE chauffeur SET nomChauf = ?, immVtr = ?, dispo = ? WHERE numChauf = ?";
		$req = $db->prepare($sql);
		$req->execute([$nomChauf,$immVtr,$dispo,$numChauf]);
	}


	if (!empty($_POST['numChauf']) && !empty($_POST['nomChauf']) && !empty($_POST['immVtr']) && !empty($_POST['dispo'])) {
		 $errors = [];
		 extract($_POST);	 
		 	updatechauffeur($numChauf,$nomChauf,$immVtr,$dispo);
		 	setFlash('Mise à jour avec success');
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
