<?php 
	require_once '../../../config/db.php';

	function getProduit($refProd){
		global $db;

		$refProd = htmlspecialchars(trim($refProd));
		$sql = "SELECT 
					produit.refProd,
					produit.design,
					produit.qte,
					produit.pu,
					usine.numU,
					usine.nomU
				FROM produit
				JOIN usine
				ON produit.numU = usine.numU
				WHERE refProd = ?
			";
		$req = $db->prepare($sql);
		$req->execute([$refProd]);

		$results = [];
		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}


	if (!empty($_POST['refProd'])) {
		$errors = [];
		extract($_POST);	 
		$produits = getProduit($refProd);
		foreach ($produits as $prod) {} 
		?>
		<div class="form-group">
            <input type="hidden" name="refProd" class="form-control" id="refProdEd" value="<?= $prod->refProd ?>">
          </div>
           <div class="form-group">
          	<label for="designEd">Usine</label>
            <input type="text" readonly name="nomU" class="form-control" id="nomUEd" value="<?= $prod->nomU ?>">
          </div>
          <div class="form-group">
          	<label for="designEd">Produits</label>
            <input type="text" readonly name="design" class="form-control" id="designEd" value="<?= $prod->design ?>">
          </div>
          <div class="form-group">
          	<label for="qteEd">Quantité en stock</label>
            <input type="number" name="qte" class="form-control" id="qteEd" value="<?= $prod->qte ?>">
          </div>
          <div class="form-group">
            <input type="hidden" readonly name="pu" class="form-control" id="puEd" value="<?= $prod->pu ?>">
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
