<?php

function get_total_all_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM leads");
	$statement->execute();
	$result = $statement->fetchAll((PDO::FETCH_ASSOC));
	return $statement->rowCount();
}

?>