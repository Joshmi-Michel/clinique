<?php 

	function getChauf()
	{
		global $db;

		$sql = "SELECT * FROM chauffeur";
		$req = $db->query($sql);

		$results = [];

		while ($rows = $req->fetchObject()) {
			$results[] = $rows;
		}
		return $results;
	}

?>