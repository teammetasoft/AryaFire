<?php

include('db.php');
include("function.php");

if(isset($_POST["product_id"]))
{
    
	$image = get_image_name($_POST["product_id"]);
	if($image != '')
	{
		unlink("upload/" . $image);
	}
	$statement = $connection->prepare(
		"DELETE FROM products WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["product_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}



?>