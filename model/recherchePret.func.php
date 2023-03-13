<?php 
	function convertMonth($key)
	{

		switch ($key) {
		    case 1:
		        $mois = "Janvier";
		        break;
		    case 2:
		        $mois = "Février";
		        break;
		    case 3:
		        $mois = "Mars";
		        break;
		    case 4:
		        $mois = "Avril";
		        break;
	      	case 5:
		        $mois = "Mai";
		        break;
	        case 6:
		        $mois = "Juin";
		        break;
	       	case 7:
		        $mois = "Juillet";
		        break;
	        case 8:
		        $mois = "Août";
		        break;
	        case 9:
		        $mois = "Septembre";
		        break;
	        case 10:
		        $mois = "Octobre";
		        break;
	        case 11:
		        $mois = "Novembre";
		        break;
	        case 12:
		        $mois = "Décembre";
		        break;
		    default:
	        $mois = "Lol";
		}

		return $mois;
	}

	function getPretBetween($debut,$fin)
	{
		global $db;

		if (strlen($debut) <= 2 && strlen($fin) <= 2 ) {

			$sql = "SELECT 
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
				AND EXTRACT(MONTH FROM pret.datePret) BETWEEN '$debut' AND '$fin'				
			";

		}elseif (strlen($debut) == 10 && strlen($fin) == 10) {
			
			$deb = date('Y-m-d',strtotime($debut));
			$fn = date('Y-m-d',strtotime($fin));

			$sql = "SELECT 
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
				AND pret.datePret BETWEEN '$deb' AND '$fn'
			";
		}elseif(strlen($debut) == 4 && strlen($fin) == 4){
			$sql = " SELECT
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
				AND EXTRACT(YEAR FROM pret.datePret) BETWEEN '$debut' AND '$fin'
			";
		}

		$req = $db->query($sql);
		$r = [];

		while ($rows = $req->fetchObject()) {
			$r[] = $rows;
		}

		return $r;
	}


	$results = 1;
  if (isset($_POST['search'])) {

    if (!empty($_POST['rechercheOpt'])) {
      $errors = [];
      extract($_POST);  

      if ($rechercheOpt == 'year') {
        $results = getPretBetween($debutAnnee,$finAnnee);
      }

      if ($rechercheOpt == 'month') {
        $results = getPretBetween($debutMois,$finMois);
      }

      if ($rechercheOpt == 'custom') {
        $results = getPretBetween($debutCustom,$finCustom);
      }

    } 
  }
 ?>
