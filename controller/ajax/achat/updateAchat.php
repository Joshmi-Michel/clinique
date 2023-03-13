<?php 
	require_once '../../../config/db.php';

	function getOldAchatQte($idAch)
	{
		global $db;
		$idAch = htmlspecialchars(trim($idAch));

		$sql = "SELECT qte FROM acheter WHERE idAch = ?";
		$req = $db->prepare($sql);
		$req->execute([$idAch]);

		$result = $req->fetchObject();
		return $result;
	}

	function updateProd($oldQte,$qte,$refProd)
	{
		global $db;
		$oldQte = htmlspecialchars(trim($oldQte));
		$refProd = htmlspecialchars(trim($refProd));
		$qte = htmlspecialchars(trim($qte));

		if ($qte > $oldQte) {
			$diff = $qte - $oldQte;
			$sql = "UPDATE produit SET qte = (qte - ?) WHERE refProd = ?";
		} else {
			$diff = $oldQte - $qte;
			$sql = "UPDATE produit SET qte = (qte + ?) WHERE refProd = ?";
		}

		$req = $db->prepare($sql);
		$req->execute([$diff,$refProd]);
	}

	function updateAchat($idAch,$design,$qte,$dateAchat){
		global $db;
		$idAch = htmlspecialchars(trim($idAch));
		$design = htmlspecialchars(trim($design));
		$qte = htmlspecialchars(trim($qte));
		$dateAchat = htmlspecialchars(trim($dateAchat));
		$dateAchat = date('Y-m-d H:i:s',strtotime($dateAchat));

		$sql = "UPDATE acheter SET refProd = ?, qte = ?, dateAchat = ? WHERE idAch = ?";
		$req = $db->prepare($sql);
		$req->execute([$design,$qte,$dateAchat,$idAch]);
	}


	if (!empty($_POST['idAch']) && !empty($_POST['design']) && !empty($_POST['qte']) && !empty($_POST['dateAchat'])) {
		$errors = [];
		extract($_POST);
		$oldQteTab = getOldAchatQte($idAch);
		$oldQte = $oldQteTab->qte;
	 	updateAchat($idAch,$design,$qte,$dateAchat);
	 	updateProd($oldQte,$qte,$design);

	 	setFlash('L\'achat a été mis à jour avec success');
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
