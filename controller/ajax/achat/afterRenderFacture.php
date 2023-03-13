<?php 
	require_once '../../../config/db.php';

	function deleteAchat($idAch){
		global $db;

		$idAch = htmlspecialchars(trim($idAch));
		$sql = "DELETE FROM acheter WHERE idAch = ?";
		$req = $db->prepare($sql);
		$req->execute([$idAch]);
	}

	function setDispo($numChauf)
	{
		global $db;

		$numChauf = htmlspecialchars(trim($numChauf));
		$sql = "UPDATE chauffeur SET dispo = 1 WHERE numChauf = ?";
		$req = $db->prepare($sql);
		$req->execute([$numChauf]);
	}

	if (!empty($_POST['idAch']) && !empty($_POST['numChauf'])) {
		 $errors = [];
		 extract($_POST);

		 	deleteAchat($idAch);
		 	setDispo($numChauf);
		 	setFlash('Bon de livraison exporter avec success');
				 
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
