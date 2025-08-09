<?php

include('db.php');
include("function.php");

if(isset($_POST["lead_id"]))
{
    
	$statement = $connection->prepare(
		"DELETE FROM leads WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["lead_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}else{echo"Data Not Found";}
}else
{echo"Data Error";}


?>