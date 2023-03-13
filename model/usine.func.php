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

?>