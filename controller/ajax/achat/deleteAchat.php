<?php 
	require_once '../../../config/db.php';

	function deleteAchat($idAch){
		global $db;

		$idAch = htmlspecialchars(trim($idAch));
		$sql = "DELETE FROM acheter WHERE idAch = ?";
		$req = $db->prepare($sql);
		$req->execute([$idAch]);
	}

	function getQte($idAch)
	{
		global $db;
		$idAch = htmlspecialchars(trim($idAch));
		$sql = "SELECT refProd,qte FROM acheter WHERE idAch = ?";
		$req = $db->prepare($sql);
		$req->execute([$idAch]);
		$result = $req->fetchObject();
		return $result;
	}

	function addProdReseted($refProd,$qte)
	{
		global $db;

		$refProd = htmlspecialchars(trim($refProd));
		$qte = htmlspecialchars(trim($qte));
		$sql = "UPDATE produit SET qte = (qte + ?) WHERE refProd = ?";
		$req = $db->prepare($sql);
		$req->execute([$qte,$refProd]);
	}

	if (!empty($_POST['idAch'])) {
		 $errors = [];
		 extract($_POST);
		 
		 	$qteTab = getQte($idAch);
		 	$qte = $qteTab->qte;
		 	$refProd = $qteTab->refProd;

		 	deleteAchat($idAch);
		 	addProdReseted($refProd,$qte);
		 	setFlash('La commande a été annuler avec success');
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
