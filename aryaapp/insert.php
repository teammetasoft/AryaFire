<?php
include('db.php');
include('function.php');
$usertoken=$_POST["usertoken"];
global $userid;
if(isset($_POST["usertoken"]))
{
 $token =$_POST["usertoken"];
 
 $query = "SELECT * FROM users WHERE token = '".$token."'";
 $statement = $connection->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $num_row = $statement->rowCount();
 if($num_row === 1)
 {
     foreach($result as $row)
	{
		 $userid= $row["id"];
     }
     
        
    }
    
}

if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
        $image = '';
        $price='';
		if($_FILES["product_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO products (product_name, supplier_name, image, quote_date, product_detail, product_price, hsn_code, product_code, tax, modify_date, 	modify_user) 
			VALUES (:product_name, :supplier_name, :image, :quote_date, :product_detail, :product_price, :hsn_code, :product_code, :tax, :date, :userid)
		");
        $today = date("Y-m-d H:i:s");
        
		$result = $statement->execute(
			array(
			    ':product_name'	=>	$_POST["product_name"],
				':supplier_name'	=>	$_POST["supplier_name"],
				':image'		=>	$image,
                ':quote_date'		=>	$_POST["quote_date"],
                ':product_detail'		=>	$_POST["product_detail"],
                ':product_price'	=>	$_POST["product_price"],
                ':hsn_code'		=>	$_POST["hsn_code"],
                ':product_code'		=>	$_POST["product_code"],
                ':tax'		=>	$_POST["tax"],
                ':date'		=>	$today,
                ':userid'		=>	$userid
               
			)
		);
      
		if(!empty($result))
		{
			echo 'Data Inserted';
		}else{ echo 'some problem in code';}
	}
    
    
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["product_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_product_image"];
		}
		$statement = $connection->prepare(
			"UPDATE products 
			SET product_name = :product_name, supplier_name = :supplier_name, image = :image, quote_date = :quote_date, product_detail = :product_detail, product_price = :product_price, hsn_code = :hsn_code, product_code = :product_code, tax = :tax, modify_date = :date, modify_user = :userid  
			WHERE id = :id
			"
		);
        $today = date("Y-m-d H:i:s");
		$result = $statement->execute(
			array(
				':product_name'	=>	$_POST["product_name"],
				':supplier_name'=>	$_POST["supplier_name"],
				':image'		=>	$image,
                ':quote_date'	=>	$_POST["quote_date"],
                ':product_detail'	=>	$_POST["product_detail"],
                ':product_price'	=>	$_POST["product_price"],
                ':hsn_code'		    =>	$_POST["hsn_code"],
                ':product_code'		=>	$_POST["product_code"],
                ':tax'	         	=>	$_POST["tax"],
				':id'			    =>	$_POST["product_id"],
                ':date'		=>	$today,
                ':userid'		=>	$userid
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>