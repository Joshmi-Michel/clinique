<?php 
	require_once '../../../config/db.php';

	function getChauffeur()
	{
		global $db;
		$sql = "SELECT * FROM chauffeur WHERE dispo = 1";

		$req = $db->query($sql);
		$results = [];
		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}

	function getAchat($idAch){
		global $db;

		$idAch = htmlspecialchars(trim($idAch));

		$sql = "SELECT
					acheter.idAch,
					acheter.numCli,
					acheter.refProd,
					acheter.dateAchat,
					acheter.qte,
					acheter.prixAchat,
					client.nomCli,
					client.prenomCli,
					client.adCli,
					produit.design
				FROM acheter,client,produit
				WHERE acheter.numCli = client.numCli
				AND acheter.refProd = produit.refProd
				AND acheter.livree = 0
				AND acheter.idAch = ?
			";

		$req = $db->prepare($sql);
		$req->execute([$idAch]);

		$results = [];
		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}


	if (!empty($_POST['idAch'])) {
		$errors = [];
		extract($_POST);	 
		$achats = getAchat($idAch);
		$chauffeurs = getChauffeur();
		foreach ($achats as $achat) {} 
		?>
		<div class="form-group">
            <input type="hidden" name="idAch" class="form-control" id="idAch" value="<?= $achat->idAch ?>">
          </div>
          <div class="form-group">
          	<label for="clientEd">Client</label>          
            <input type="text" readonly name="client" class="form-control" id="clientEd" value="<?= strtoupper($achat->nomCli) ?> <?= $achat->prenomCli ?>">
          </div>
          <div class="form-group">
          	<label for="clientEd">Adresse</label>          
            <input type="text" readonly name="client" class="form-control" id="clientEd" value="<?= strtoupper($achat->adCli) ?>">
          </div>
          <div class="form-group">
          	<label for="designEd">Produits</label>          
            <input type="text" readonly name="design" class="form-control" id="designEd" value="<?= $achat->design ?>">
          </div>
          <div class="form-group">
          	<label for="qteEd">Quantité commandé</label>         
            <input type="number" readonly name="qte" class="form-control" id="qteEd" value="<?= $achat->qte ?>">
          </div>  
          <div class="form-group">
          	<label for="numChauf">Chauffeur (Voiture)</label>          
            <select class="form-control" id="numChauf">
	            <option selected disabled>---- Sélectionner un chauffeur (Voiture) ----</option>
	            <?php foreach ($chauffeurs as $chauffeur):?>
	            	<option value="<?= $chauffeur->numChauf ?>"><?= ucwords($chauffeur->nomChauf) ?>&nbsp; (Voiture <?= $chauffeur->immVtr ?>)</option>
	        	<?php endforeach ?>
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
