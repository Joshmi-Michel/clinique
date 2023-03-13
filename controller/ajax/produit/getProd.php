<?php 
	require_once '../../../config/db.php';

	function getUsine(){
		global $db;
		$sql = "SELECT numU,nomU FROM usine";
		$req = $db->query($sql);
		$results = [];
		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}
	function getPanier(){
		global $db;
		$sql = "SELECT * FROM panier";
		$req = $db->query($sql);
		$results = [];
		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}
	
	function getProduit($refProd){
		global $db;

		$refProd = htmlspecialchars(trim($refProd));
		$sql = "SELECT 
					produit.refProd,
					produit.design,
					produit.qte,
					produit.peremption,
					produit.pu,
					usine.numU,
					usine.nomU
				FROM produit
				JOIN usine
				ON produit.numU = usine.numU
				AND produit.refProd = ?
				";
		$req = $db->prepare($sql);
		$req->execute([$refProd]);

		$results = $req->fetchObject();
		return $results;
	}


	if (!empty($_POST['refProd'])) {
		$errors = [];
		extract($_POST);	 
		$prod = getProduit($refProd);
		$usines = getUsine();
		?>
		      <div class="form-group">
            <input type="hidden" name="refProd" class="form-control" id="refProd" value="<?= $prod->refProd ?>">
          </div>
          <div class="form-group">
          	<label for="numUEd">Fournisseur</label>          
            <select class="form-control" id="numUEd">
	            <?php foreach ($usines as $usine):?>
	            	<option <?= ($usine->numU == $prod->numU) ? 'selected' : '' ?> value="<?= $usine->numU ?>"><?= ucwords($usine->nomU) ?></option>
	        	<?php endforeach ?>
            </select>
          </div> 
          <div class="form-group">
          	<label for="designEd">Désignation</label>          
            <input type="text" name="design" class="form-control" id="designEd" value="<?= $prod->design ?>">
          </div>
          <div class="form-group">
          	<label for="qteEd">Quantité</label>          
            <input type="number" name="qte" class="form-control" id="qteEd" value="<?= $prod->qte ?>">
          </div>
          <div class="form-group">
          	<label for="puEd">Date Peremption</label>          
            <input type="text" name="peremptionEd" class="form-control" id="peremptionEd" value="<?= $prod->peremption ?>">
          </div>
          <div class="form-group">
          	<label for="perempEd">Prix unitaire (Fmg)</label>          
            <input type="text" name="pu" class="form-control" id="puEd" value="<?= $prod->pu ?>">
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
