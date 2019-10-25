<?php

function getDatabase() 
{
	//opciones de conexión
	$dbtype="sqlite";
	$dbConnectionString='sqlite:database/herokids.sqlite';
	
	$db = null;
	if($dbtype=="sqlite") {
		$db = new PDO($dbConnectionString);
	}
	return $db;
}

?>