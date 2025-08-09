<?php
include('db.php');
include('function.php');
if(isset($_POST["product_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM products 
		WHERE id = '".$_POST["product_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["product_name"] = $row["product_name"];
		$output["supplier_name"] = $row["supplier_name"];
        $output["quote_date"] = $row["quote_date"];
		$output["product_detail"] = $row["product_detail"];
        $output["product_price"] = $row["product_price"];
        $output["hsn_code"] = $row["hsn_code"];
        $output["product_code"] = $row["product_code"];
        $output["tax"] = $row["tax"];
		if($row["image"] != '')
		{
			$output['product_image'] = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_product_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['product_image'] = '<input type="hidden" name="hidden_product_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>