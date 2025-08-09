<?php
include('db.php');
include('function.php');
if(isset($_POST["lead_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM leads 
		WHERE id = '".$_POST["lead_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["company_name"] = $row["company_name"];
		$output["contact_name"] = $row["contact_name"];
        $output["mobile"] = $row["mobile"];
        $output["email"] = $row["email"];
        $output["custom_detail"] = $row["custom_detail"];
        $output["address"] = $row["address"];
        $output["city"] = $row["city"];
        $output["sector"] = $row["sector"];
        $output["visit_date"] = $row["visit_date"];
        $output["marketing_name"] = $row["marketing_name"];
        $output["result"] = $row["result"];
        $output["feedback"] = $row["feedback"];
    
		
	}
	echo json_encode($output);
}
?>