<?php 

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