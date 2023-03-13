<?php 
	require_once '../../../config/db.php';

	function getLecteur()
    {
        global $db;
        $sql = "SELECT * FROM lecteur";
        $req = $db->prepare($sql);
        $req->execute();

        $results = [];

        while ($rows = $req->fetchObject()) {
          $results[] = $rows;
        }
        return $results;
    }

    function getLivre()
    {
        global $db;
        $sql = "SELECT * FROM livre";
        $req = $db->prepare($sql);
        $req->execute();

        $results = [];

        while ($rows = $req->fetchObject()) {
          $results[] = $rows;
        }
        return $results;
    }

	function getPret($numPret)
	{
		global $db;
		$numPret = htmlspecialchars(trim($numPret));
		$sql = "SELECT
				count(numPret) as nbPret,
				pret.numPret,
				pret.numLecteur,
				pret.numLivre,
				pret.datePret,
				pret.dateRetour,
				lecteur.numLecteur,
				lecteur.nomLecteur,
				livre.numLivre,
				livre.titre,
				livre.auteur,
				livre.dateEdition				
				FROM pret,lecteur,livre
				WHERE pret.numLecteur = lecteur.numLecteur
				AND pret.numLivre = livre.numLivre
				AND pret.rendu = 1
				AND pret.numPret = ?
		";
		$req = $db->prepare($sql);
		$req->execute([$numPret]);
		$results = [];

		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}


	if (!empty($_POST['numPret'])) {
		$errors = [];
		extract($_POST);
		$prets = getPret($numPret);
		$lecteurs = getLecteur();
  		$livres = getLivre();	 
		// $livres = getLecteur($numPret);
		foreach ($prets as $pret) {} 
		?>
		<div class="form-group">
			<input type="hidden" id="numPret" value="<?= $pret->numPret ?>">
		</div>
		<div class="form-group">
          	<label for="datePretEd">Num Lecteur</label>
          	<input type="date" class="form-control" readonly id="numLecteurEd" value="<?= $pret->numLecteur ?>">
      	</div>		
		<div class="form-group">
			<label for="datePretEd">Nom Lecteur</label>
			<input type="date" class="form-control" readonly id="nomLecteurEd" value="<?= $pret->nomLecteur ?>">
		</div>
		<div class="form-group">
			<label for="datePretEd">Livre</label>
			<input type="date" class="form-control" readonly id="numLivreEd" value="<?= $pret->titre ?>">
		</div>
		<div class="form-group">
			<label for="datePretEd">Date de Prêt (aaaa/mm/jj)</label>
			<input type="date" class="form-control" readonly id="datePretEd" value="<?= $pret->datePret ?>">
		</div>
		<div class="form-group">
			<label for="datePretEd">Date de Retour (jj/mm/aaaa)</label>
			<input type="date" class="form-control" id="dateRetourEd" value="<?= date('d-m-Y',strtotime($pret->dateRetour)) ?>">
		</div>
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
