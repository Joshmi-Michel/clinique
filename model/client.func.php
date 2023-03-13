<?php 

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

	function getPan2()
	{
		global $db;

		$sql = "SELECT * FROM panier2";
		$req = $db->query($sql);

		$results = [];

		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}

?>