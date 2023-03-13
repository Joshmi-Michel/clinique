<?php 
	require_once '../../../config/db.php';
	require_once '../../../vues/chiffreEnLettre.php';

	function getTotal($numCli){
		global $db;

		$numCli = htmlspecialchars(trim($numCli));

		$sql = "SELECT
				SUM(acheter.prixAchat)	as total				
				FROM acheter,client
				WHERE acheter.numCli = client.numCli
				AND acheter.livree = 1
				AND acheter.numCli = ?
			";

		$req = $db->prepare($sql);
		$req->execute([$numCli]);

		$results = $req->fetchObject();
		return $results;
	}

	function getChauffLivraison($idAch)
	{
		global $db;

		$idAch = htmlspecialchars(trim($idAch));

		$sql = "SELECT
					livraison.numChauf,
					chauffeur.numChauf,
					chauffeur.nomChauf,
					chauffeur.immVtr
				FROM livraison
				JOIN chauffeur
				ON livraison.numChauf = chauffeur.numChauf
				WHERE livraison.idAch = ?
			";

		$req = $db->prepare($sql);
		$req->execute([$idAch]);

		$results = $req->fetchObject();
		return $results;
	}

	function getClient($numCli){
		global $db;

		$numCli = htmlspecialchars(trim($numCli));

		$sql = "SELECT
					DISTINCT
					acheter.numCli,
					client.nomCli,
					client.prenomCli,
					client.adCli
				FROM acheter,client
				WHERE acheter.numCli = client.numCli
				AND acheter.livree = 1
				AND acheter.numCli = ?
			";

		$req = $db->prepare($sql);
		$req->execute([$numCli]);

		$results = $req->fetchObject();
		return $results;
	}

	function getProd($numCli){
		global $db;

		$numCli = htmlspecialchars(trim($numCli));

		$sql = "SELECT
					acheter.numCli,
					produit.refProd,
					produit.design,
					produit.pu,
					acheter.prixAchat,
					acheter.dateAchat,
					acheter.qte
				FROM acheter,produit
				WHERE acheter.refProd = produit.refProd
				AND acheter.livree = 1
				AND acheter.numCli = ?
			";

		$req = $db->prepare($sql);
		$req->execute([$numCli]);

		$results = [];
		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}
	
	function getAchat($numCli){
		global $db;

		$numCli = htmlspecialchars(trim($numCli));

		$sql = "SELECT
					acheter.idAch
				FROM acheter
				WHERE acheter.numCli = ?
			";

		$req = $db->prepare($sql);
		$req->execute([$numCli]);

		$results = $req->fetchObject();
		return $results;
	}


	if (!empty($_POST['numCli'])) {
		$errors = [];
		extract($_POST);	

	?>
	<span class="lead"><?= $website_name ?></span>
	<table id="table2excel" class="table table-striped table-condensed table-bordered dt-responsive nowrap bulk_action" cellspacing="0" width="100%">
		<?php
			$client = getClient($numCli);
			$prods = getProd($numCli);
			$totals = getTotal($numCli);
			$achat = getAchat($numCli);
			$chauffeur = getChauffLivraison($achat->idAch);
			$lettres = new ChiffreEnLettre();
		?>
		<tbody>
			<tr>			
				<td>Bon de Livraison n°</td>
				<td id="numFacture"><?= $achat->idAch ?></td>				
			</tr>
			<tr>
				<td>Livraison faite par Voiture</td>
				<td>
					N°&nbsp;<span id="numChauffeur"><?= $chauffeur->numChauf ?></span>&nbsp; | 
					<b>Nom Chauffeur :</b> &nbsp; <?= ucwords($chauffeur->nomChauf) ?>&nbsp; | 
					<b>Immatricule Voiture :</b> &nbsp;<?= strtoupper($chauffeur->immVtr) ?>&nbsp;
				</td>
			</tr>
			<tr>			
				<td>Num Client</td>
				<td><?= $client->numCli ?></td>				
			</tr>
			<tr>
				<td>Client</td>
				<td><?= strtoupper($client->nomCli) ?>&nbsp;<?= ucwords($client->prenomCli) ?></td>
			</tr>
			<tr>
				<td>Adresse Client</td>
				<td><?= ucwords($client->adCli) ?></td>
			</tr>
			<tr>				
				<td>Produit (qté)</td>
				<td>
				<?php foreach ($prods as $prod):?>
					<?= ucwords($prod->design) ?>&nbsp;(<?=$prod->qte ?>)&nbsp; --- Le <?= date('d-m-Y à H:i:s',strtotime($prod->dateAchat)) ?>&nbsp; ---- Prix d'achat : <?= substr_replace($prod->prixAchat, ' , ', -3,1) ?>&nbsp; Fmg<br>
				<?php endforeach ?>	
				</td>			
			</tr>		
			
			<tr>				
				<td>TOTAL</td>
				<td><b><?= substr_replace($totals->total, ' , ', -3,1) ?>&nbsp; Fmg<b></td>	                   
			</tr>	
			<tr>				
				<td>Arrêter a la somme de</td>
				<td><b><?= ucwords($lettres->conversion(ceil($totals->total))) ?>Fmg<b></td>	                   
			</tr>		
		</tbody>
		</table>
		
	<?php
			
		 
	} else {
		$errors[] = "Veuillez selectionner un client";
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
