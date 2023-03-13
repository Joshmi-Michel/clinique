<?php 
	require_once '../../../config/db.php';

	function getChauf($numChauf){
		global $db;

		$numChauf = htmlspecialchars(trim($numChauf));
		$sql = "SELECT * FROM chauffeur WHERE numChauf = ?";
		$req = $db->prepare($sql);
		$req->execute([$numChauf]);

		$results = [];
		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}


	if (!empty($_POST['numChauf'])) {
		$errors = [];
		extract($_POST);	 
		$chauffeurs = getChauf($numChauf);
		foreach ($chauffeurs as $Chauf) {} 
		?>
		<div class="form-group">
            <input type="hidden" name="numChauf" class="form-control" id="numChauf" value="<?= $Chauf->numChauf ?>">
          </div>
          <div class="form-group">
          	<label for="nomChaufEd">Nom Chauffeur</label>          
            <input type="text" name="nomChauf" class="form-control" id="nomChaufEd" value="<?= $Chauf->nomChauf ?>">
          </div>
          <div class="form-group">
          	<label for="immVtrEd">Immatricule voiture</label>          
            <input type="text" name="immVtr" class="form-control" id="immVtrEd" value="<?= $Chauf->immVtr ?>">
          </div>
          <div class="form-group">
          	<label for="dispoEd">Disponible</label>          
          	<select id="dispoEd" class="form-control">
          		<option value="1" <?= ($Chauf->dispo == 1)? 'selected' : '' ?>>Oui</option>
          		<option value="00" <?= ($Chauf->dispo == 0)? 'selected' : '' ?>>Non</option>
          	</select>
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
