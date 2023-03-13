<?php 
	require_once '../../../config/db.php';

	function getClient($numCli){
		global $db;

		$numCli = htmlspecialchars(trim($numCli));
		$sql = "SELECT * FROM client WHERE numCli = ?";
		$req = $db->prepare($sql);
		$req->execute([$numCli]);

		$results = [];
		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}


	if (!empty($_POST['numCli'])) {
		$errors = [];
		extract($_POST);	 
		$clients = getClient($numCli);
		foreach ($clients as $Cli) {} 
		?>
		<div class="form-group">
            <input type="hidden" name="numCli" class="form-control" id="numCli" value="<?= $Cli->numCli ?>">
          </div>
          <div class="form-group">
          	<label for="nomCliEd">Nom</label>
            <input type="text" name="nomCli" class="form-control" id="nomCliEd" value="<?= $Cli->nomCli ?>">
          </div>
          <div class="form-group">
          	<label for="prenomCliEd">Prénom</label>        	
            <input type="text" name="prenomCli" class="form-control" id="prenomCliEd" value="<?= $Cli->prenomCli ?>">
          </div>
          <div class="form-group">
          	<label for="adCliEd">Adresse</label>
            <input type="text" name="adCli" class="form-control" id="adCliEd" value="<?= $Cli->adCli ?>">
          </div>
          <div class="form-group">
          	<label for="cpCliEd">Code Postal</label>
            <input type="text" name="cpCli" class="form-control" id="cpCliEd" value="<?= $Cli->cpCli ?>">
          </div>
          <div class="form-group">
          	<label for="telCliEd">Telephone</label>       
            <input type="text" name="telCli" class="form-control" id="telCliEd" value="<?= $Cli->telCli ?>">
          </div>
          <div class="form-group">
          	<label for="mailCliEd">Adresse email</label>          
            <input type="email" name="mailCli" class="form-control" id="mailCliEd" value="<?= $Cli->mailCli ?>">
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
