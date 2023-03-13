<?php 
	require_once '../../../config/db.php';

	function getProd($refProd)
	{
		global $db;
		$refProd = htmlspecialchars(trim($refProd));

		$sql = "SELECT pu,qte FROM produit WHERE refProd = ?";
		$req = $db->prepare($sql);
		$req->execute([$refProd]);
		$result = $req->fetchObject();
		return $result;
	}

	function subQteStock($refProd,$qteCmd)
	{
		global $db;
		$refProd = htmlspecialchars(trim($refProd));
		$qteCmd = htmlspecialchars(trim($qteCmd));

		$sql = "UPDATE produit SET qte = (qte - ?) WHERE refProd = ?";
		$req = $db->prepare($sql);
		$req->execute([$qteCmd,$refProd]);
	}

	function setProd($refProd,$qte,$prixAchat){
		global $db;

		$refProd = htmlspecialchars(trim($refProd));
		$qte = htmlspecialchars(trim($qte));
		$prixAchat = htmlspecialchars(trim($prixAchat));

		$sql = "INSERT INTO acheter (refProd,qte,prixAchat,dateAchat) VALUES (?,?,?,NOW())";
		$req = $db->prepare($sql);
		$req->execute([$refProd,$qte,$prixAchat]);
	}


	if (  !empty($_POST['refProd']) && !empty($_POST['qte'])) {
		 $errors = [];
		 extract($_POST);	 
		 	$prod = getProd($refProd);
		 	$pu = $prod->pu;
		 	$qteStock = $prod->qte;
		 	$prixAchat = ($pu * $qte);
		 	if ($qteStock < $qte) {
		 		setFlash('Achat en attente! Stock insuffisante, Veuillez réaprovisionner','danger');
		 		?>
					<script type="text/javascript">
						window.location.replace('?page=achat');
					</script>
				<?php
		 	} else {		 		
			 	setProd($refProd,$qte,$prixAchat);
			 	subQteStock($refProd,$qte);
			 	setFlash('Achat avec success');
				?>
					<script type="text/javascript">
						window.location.replace('?page=achat');
					</script>
				<?php
		 	}
		 	
		 
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
