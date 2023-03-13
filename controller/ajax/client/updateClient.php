<?php 
	require_once '../../../config/db.php';

	function updateClient($numCli,$nomCli,$prenomCli,$adCli,$cpCli,$telCli,$mailCli){
		global $db;
		$numCli = htmlspecialchars(trim($numCli));
		$nomCli = htmlspecialchars(trim($nomCli));
		$prenomCli = htmlspecialchars(trim($prenomCli));
		$adCli = htmlspecialchars(trim($adCli));
		$cpCli = htmlspecialchars(trim($cpCli));
		$telCli = htmlspecialchars(trim($telCli));
		$mailCli = htmlspecialchars(trim($mailCli));
		$sql = "UPDATE client SET nomCli = ?, prenomCli = ?, adCli = ?, cpCli = ?, telCli = ?, mailCli = ? WHERE numCli = ?";
		$req = $db->prepare($sql);
		$req->execute([$nomCli,$prenomCli,$adCli,$cpCli,$telCli,$mailCli,$numCli]);
	}


	if (!empty($_POST['numCli']) && !empty($_POST['nomCli']) && !empty($_POST['prenomCli']) && !empty($_POST['adCli']) && !empty($_POST['cpCli']) && !empty($_POST['telCli']) && !empty($_POST['mailCli'])) {
		 $errors = [];
		 extract($_POST);	 
		 	updateClient($numCli,$nomCli,$prenomCli,$adCli,$cpCli,$telCli,$mailCli);
		 	setFlash('Mise à jour avec success');
		?>
		<script type="text/javascript">
			window.location.replace('?page=client');
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
