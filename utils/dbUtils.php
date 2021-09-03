<?php
	
	function sendDbRequest($query, $dataArray) {
		global $db;
		$prepareDb = $db -> prepare($query);
		$prepareDb -> execute($dataArray);
		//$prepareDb->debugDumpParams();
		return $prepareDb -> fetchAll(PDO::FETCH_ASSOC);
	}