<?php 
	require_once '../../../config/db.php';

	function updateproduit($refProd,$design,$qte,$pu){
		global $db;
		$refProd = htmlspecialchars(trim($refProd));
		$design = htmlspecialchars(trim($design));
		$qte = htmlspecialchars(trim($qte));
		$pu = htmlspecialchars(trim($pu));

		$sql = "UPDATE produit SET design = ?, qte = ?, pu = ? WHERE refProd = ?";
		$req = $db->prepare($sql);
		$req->execute([$design,$qte,$pu,$refProd]);
	}


	if (!empty($_POST['refProd']) && !empty($_POST['design']) && !empty($_POST['qte']) && !empty($_POST['pu'])) {
		 $errors = [];
		 extract($_POST);	 
		 	updateproduit($refProd,$design,$qte,$pu);
		 	setFlash('Mise à jour avec success');
		?>
		<script type="text/javascript">
			window.location.replace('?page=stock');
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
