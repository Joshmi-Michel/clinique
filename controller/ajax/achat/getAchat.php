<?php 
	require_once '../../../config/db.php';

	function getClient()
	{
		global $db;
		$sql = "SELECT * FROM client";

		$req = $db->query($sql);
		$results = [];
		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}

	function getProd()
	{
		global $db;
		$sql = "SELECT * FROM produit";

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

		$results =  $req->fetchObject();
		return $results;
	}


	if (!empty($_POST['idAch'])) {
		$errors = [];
		extract($_POST);	 
		$achat = getAchat($idAch);
		$clients = getClient();
		$produits = getProd();
		?>
		<div class="form-group">
            <input type="hidden" name="idAch" class="form-control" id="idAch" value="<?= $achat->idAch ?>">
          </div>
          <div class="form-group">
          	<label for="clientEd">Client</label>          
            <select class="form-control" id="clientEd">
	            <?php foreach ($clients as $client):?>
	            	<option <?= ($client->numCli == $achat->numCli) ? 'selected' : '' ?> value="<?= $client->numCli ?>"><?= ucwords($client->nomCli) ?>&nbsp; <?= $client->prenomCli ?></option>
	        	<?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
          	<label for="designEd">Produit</label>          
            <select class="form-control" id="designEd">
	            <?php foreach ($produits as $prod):?>
	            	<option <?= ($prod->refProd == $achat->refProd) ? 'selected' : '' ?> value="<?= $prod->refProd ?>"><?= ucwords($prod->design) ?>&nbsp; (PU: <?= $prod->pu ?>&nbsp;Fmg)</option>
	        	<?php endforeach ?>
            </select>
          </div>          
          <div class="form-group">
          	<label for="qteEd">Quantité commandé</label>         
            <input type="number" name="qte" class="form-control" id="qteEd" value="<?= $achat->qte ?>">
          </div>
          <div class="form-group">
          	<label for="dateAchatEd">Date Achat (jj/mm/AAAA à H:m:s)</label>         
            <input type="date" name="dateAchatEd" class="form-control" id="dateAchatEd" value="<?= date('d-m-Y à H:i:s',strtotime($achat->dateAchat)) ?>">
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
