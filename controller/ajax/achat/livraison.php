<?php 
	require_once '../../../config/db.php';

	function setNoDispo($numChauf)
	{
		global $db;
		$numChauf = htmlspecialchars(trim($numChauf));

		$sql = "UPDATE chauffeur SET dispo = 0 WHERE numChauf = ?";
		$req = $db->prepare($sql);
		$req->execute([$numChauf]);
	}

	function setLivree($idAch)
	{
		global $db;
		$idAch = htmlspecialchars(trim($idAch));

		$sql = "UPDATE acheter SET livree = 1 WHERE idAch = ?";
		$req = $db->prepare($sql);
		$req->execute([$idAch]);
	}

	function setLivraison($idAch,$numChauf){
		global $db;

		$idAch = htmlspecialchars(trim($idAch));
		$numChauf = htmlspecialchars(trim($numChauf));

		$sql = "INSERT INTO livraison (idAch,numChauf,dateliv) VALUES (?,?,NOW())";
		$req = $db->prepare($sql);
		$req->execute([$idAch,$numChauf]);
	}


	if (!empty($_POST['idAch']) && !empty($_POST['numChauf'])) {
		 $errors = [];
		 extract($_POST);	 
		 			 		
	 	setLivraison($idAch,$numChauf);
	 	setLivree($idAch);
	 	setNoDispo($numChauf);
	 	setFlash('Livraison faite avec success! Consulter la facture (Bon de Livraison) ');
		?>
			<script type="text/javascript">
				window.location.replace('?page=achat');
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
