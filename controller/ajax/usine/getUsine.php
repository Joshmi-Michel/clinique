<?php 
	require_once '../../../config/db.php';

	function getusine($numU){
		global $db;

		$numU = htmlspecialchars(trim($numU));
		$sql = "SELECT * FROM usine WHERE numU = ?";
		$req = $db->prepare($sql);
		$req->execute([$numU]);

		$results = [];
		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}


	if (!empty($_POST['numU'])) {
		$errors = [];
		extract($_POST);	 
		$usines = getusine($numU);
		foreach ($usines as $usine) {} 
		?>
		<div class="form-group">
            <input type="hidden" name="numU" class="form-control" id="numU" value="<?= $usine->numU ?>">
          </div>
          <div class="form-group">
          	<label for="nomUEd">Nom Fournisseur</label>          
            <input type="text" name="nomU" class="form-control" id="nomUEd" value="<?= $usine->nomU ?>">
          </div>
          <div class="form-group">
          	<label for="telUEd">Telephone</label>          
            <input type="text" name="telU" class="form-control" id="telUEd" value="<?= $usine->telU ?>">
          </div>
          <div class="form-group">
          	<label for="mailUEd">Adresse</label>         
            <input type="text" name="mailU" class="form-control" id="mailUEd" value="<?= $usine->mailU ?>">
          </div>    
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
