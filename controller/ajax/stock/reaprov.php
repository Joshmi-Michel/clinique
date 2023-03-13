<?php 
	require_once '../../../config/db.php';

	function reaprov($refProd,$qte,$peremption){
		global $db;

		$refProd = htmlspecialchars(trim($refProd));
		$qte = htmlspecialchars(trim($qte));
		$peremption = htmlspecialchars(trim($peremption));
		$sql = "UPDATE produit SET qte = (qte + ?) , peremption =? , dateEntrer = NOW()  WHERE refProd = ?";
		$req = $db->prepare($sql);
		$req->execute([$qte,$peremption,$refProd]);

		$db->exec("INSERT INTO aprov (qteAp , dateAp , prodAprov) VALUES('$qte',NOW(),'$refProd')");
	
	}


	if (!empty($_POST['refProd']) && !empty($_POST['qte'])) {
		 $errors = [];
		 extract($_POST);	 
		 	
		 	reaprov($refProd,$qte,$peremption);
		 	setFlash('Réaprovisionnement faite avec success');
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
