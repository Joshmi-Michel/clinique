<?php 
	require_once '../../../config/db.php';

	function updateproduit($refProd,$numU,$design,$qte,$peremption,$pu){
		global $db;
		$refProd = htmlspecialchars(trim($refProd));
		$numU = htmlspecialchars(trim($numU));
		$design = htmlspecialchars(trim($design));
		$qte = htmlspecialchars(trim($qte));
		$peremption= htmlspecialchars(trim($peremption));
		$pu = htmlspecialchars(trim($pu));

		$sql = "UPDATE produit SET numU = ?, design = ?, qte = ?, peremption=? ,  pu = ?  WHERE refProd = ?";
		$req = $db->prepare($sql);
		$req->execute([$numU,$design,$qte,$peremption,$pu,$refProd]);
	}


	if (!empty($_POST['refProd']) && !empty($_POST['numU']) && !empty($_POST['design']) && !empty($_POST['qte']) && !empty($_POST['peremption']) && !empty($_POST['pu'])) {
		 $errors = [];
		 extract($_POST);	 
		 	updateproduit($refProd,$numU,$design,$qte,$peremption,$pu);
		 	setFlash('Mise à jour avec success');
		?>
		<script type="text/javascript">
			window.location.replace('?page=produit');
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
