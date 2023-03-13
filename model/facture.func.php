<?php 
	
	

	function getClient()
	{
		global $db;

		$sql = "SELECT
					DISTINCT
					acheter.numCli,
					client.nomCli,
					client.prenomCli,
					client.adCli
				FROM acheter,client,produit
				WHERE acheter.numCli = client.numCli
				AND acheter.refProd = produit.refProd
				AND acheter.livree = 1
			";
		$req = $db->query($sql);

		$results = [];

		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}

?>