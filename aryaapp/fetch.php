<?php

include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM products ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE product_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR supplier_name LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR product_detail LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR quote_date LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR product_price LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR hsn_code LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR product_code LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
    //check username 
    $userid=$row["modify_user"];
    global $username;
         
    $query_user = "SELECT * FROM users WHERE id = '".$userid."'";
    $statement_user = $connection->prepare($query_user);
    $statement_user->execute();
    $result_user = $statement_user->fetchAll();
    $user_row = $statement_user->rowCount();
    if($user_row ===1)
    {
     foreach($result_user as $row_user)
	{
		 $username= $row_user["username"];
     }
          
    }else{$username= "";}
    
    
    ////////
    
	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="100"/>';
	}
	else
	{
		$image = '';
	}
    $date= date(  "F j, Y", strtotime( $row["quote_date"] ) );
    
	$sub_array = array();
	$sub_array[] = $image;
	$sub_array[] = $row["product_name"];
    $sub_array[] = $row["product_price"];
	$sub_array[] = $row["supplier_name"];
    $sub_array[] = $row["quote_date"];
    $sub_array[] = $row["tax"].'%';
    $sub_array[] = $row["hsn_code"];
    $sub_array[] = $row["product_code"];
    $sub_array[] = $row["product_detail"];
   
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-block update" data-dismiss="modal">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-block delete">Delete</button>';
     $sub_array[] = $row["modify_date"];    
    $sub_array[] = $username;
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);

echo json_encode($output);


?>