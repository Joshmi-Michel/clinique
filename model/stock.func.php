<?php 

	function getProduit()
	{
		global $db;

		$sql = "SELECT 
					produit.refProd,
					produit.design,
					produit.qte,
					produit.pu,
					produit.peremption,
					produit.dateEntrer,
					usine.numU,
					usine.nomU
				FROM produit
				JOIN usine
				ON produit.numU = usine.numU
				";
		$req = $db->query($sql);

		$results = [];

		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}

?>