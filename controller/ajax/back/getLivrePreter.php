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

    function getLivre($numLecteur)
    {
        global $db;
		$numLecteur = htmlspecialchars(trim($numLecteur));
		$sql = "SELECT
				pret.numPret,
				pret.numLecteur,
				pret.numLivre,
				livre.numLivre,
				livre.titre,
				livre.auteur,
				livre.dateEdition				
				FROM pret,livre
				WHERE pret.numLivre = livre.numLivre
				AND pret.rendu = 0
				AND pret.numLecteur = ?
		";
		$req = $db->prepare($sql);
		$req->execute([$numLecteur]);
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
				lecteur.numLecteur,
				lecteur.nomLecteur,
				livre.numLivre,
				livre.titre,
				livre.auteur,
				livre.dateEdition				
				FROM pret,lecteur,livre
				WHERE pret.numLecteur = lecteur.numLecteur
				AND pret.numLivre = livre.numLivre
				AND pret.rendu = 0
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


	if (!empty($_POST['numLecteur'])) {
		$errors = [];
		extract($_POST);
			 
		$livres = getLivre($numLecteur);
		?>
        <div class="form-group">
            <select class="form-control" id="numLivre">
                <option disabled selected>Séléctionner un Livre</option>
              <?php foreach ($livres as $livre):?>
                  <option value="<?= $livre->numLivre ?>"><?= ucwords($livre->titre) ?></option>
              <?php endforeach; ?>
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
