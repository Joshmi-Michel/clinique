<?php 
	require_once '../../../config/db.php';

	function setChauffeur($nomChauf,$immVtr){
		global $db;

		$nomChauf = htmlspecialchars(trim($nomChauf));
		$immVtr = htmlspecialchars(trim($immVtr));

		$sql = "INSERT INTO chauffeur (nomChauf,immVtr) VALUES (?,?)";
		$req = $db->prepare($sql);
		$req->execute([$nomChauf,$immVtr]);
	}


	if (!empty($_POST['nomChauf']) && !empty($_POST['immVtr'])) {
		 $errors = [];
		 extract($_POST);	 
		 	
		 	setChauffeur($nomChauf,$immVtr);
		 	setFlash('Ajout avec success');
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
