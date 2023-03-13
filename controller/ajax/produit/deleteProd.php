<?php 
	require_once '../../../config/db.php';

	function deleteProduit($refProd){
		global $db;

		$refProd = htmlspecialchars(trim($refProd));
		$sql = "DELETE FROM produit WHERE refProd = ?";
		$req = $db->prepare($sql);
		$req->execute([$refProd]);
	}


	if (!empty($_POST['refProd'])) {
		 $errors = [];
		 extract($_POST);	 
		 	deleteProduit($refProd);
		 	setFlash('Suppression avec success');
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
