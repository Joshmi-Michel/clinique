<?php 
	require_once '../../../config/db.php';

	function setProd($numU,$design,$qte,$peremption,$pu){
		global $db;
		$numU = htmlspecialchars(trim($numU));
		$design = htmlspecialchars(trim($design));
		$qte = htmlspecialchars(trim($qte));
		$peremption = htmlspecialchars(trim($peremption));
		$pu = htmlspecialchars(trim($pu));

		$sql = "INSERT INTO produit (numU,design,qte,peremption,pu,dateEntrer) VALUES (?,?,?,?,?,NOW())";
		$req = $db->prepare($sql);
		$req->execute([$numU,$design,$qte,$peremption,$pu]);
	}

	if (!empty($_POST['numU']) && !empty($_POST['design']) && !empty($_POST['peremption']) && !empty($_POST['qte']) && !empty($_POST['pu'])) {
		 $errors = [];
		 extract($_POST);	 
		 	
		 	setProd($numU,$design,$qte,$peremption,$pu);
		 	setFlash('Ajout avec success');
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
