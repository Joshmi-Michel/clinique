<?php 
	
	function getUsine()
	{
		global $db;

		$sql = "SELECT * FROM usine";
		$req = $db->query($sql);

		$results = [];

		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}


	function getProduit()
	{
		global $db;

		$sql = "SELECT 
					produit.refProd,
					produit.design,
					produit.qte,
					produit.peremption,
					produit.pu,
					produit.dateEntrer,
					usine.numU,
					usine.nomU
				FROM produit
				JOIN usine 
				ON produit.numU = usine.numU WHERE qte<=5;
				";
		$req = $db->query($sql);

		$results = [];

		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}

	function getNbTotal($table,$champs)
	{
		global $db;

		$sql = "SELECT COUNT($champs) as total FROM $table";
		$req = $db->query($sql);

		$results = [];

		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}

	function getInsertedDay($table,$champ)
	{
		global $db;

		$sql = "SELECT $champ FROM $table";
		$req = $db->query($sql);

		$results = [];

		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}
?>
