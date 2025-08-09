<?php
include('db.php');
include('function.php');
$usertoken=$_POST["usertoken"];
global $userid;
if(isset($_POST["usertoken"]))
{
 $token =$_POST["usertoken"];
 
 $query = "SELECT * FROM crm_users WHERE token = '".$token."'";
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
       
        		
		$statement = $connection->prepare("
			INSERT INTO leads (company_name, contact_name, mobile, email, address, city, custom_detail, sector, modify_date, modify_user, visit_date, result, marketing_name, feedback) 
			VALUES (:company_name, :contact_name, :mobile, :email, :address, :city, :custom_details, :sector, :date, :userid, :visit_date, :result,:marketing_name, :feedback)
		");
        date_default_timezone_set("Asia/Kolkata");
        $today = date("Y-m-d H:i:s");
        
		$result = $statement->execute(
			array(
			    ':company_name'	=> $_POST["company_name"],
                ':contact_name'	=> $_POST["contact_name"],
                ':mobile' => $_POST["mobile"],
                ':email' => $_POST["email"],
                ':address' => $_POST["address"],
                ':city'	=> $_POST["city"],
                ':custom_details' => $_POST["custom_details"],
                ':sector' => $_POST["sector"],
                ':date' =>	$today,
                ':userid' => $userid,
                ':visit_date' => $_POST["visit_date"],
                ':result' => $_POST["result"],
                ':marketing_name' => $_POST["marketing_name"],
                ':feedback'	=> $_POST["feedback"]                
               
			)
		);
      
		if(!empty($result))
		{
			echo 'Data Inserted';
		}else{ echo 'some problem in code';}
	}
    
    
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE leads 
			SET company_name = :company_name, contact_name = :contact_name, mobile = :mobile, email = :email, address = :address, city = :city, custom_detail = :custom_details, sector = :sector, modify_date = :date, modify_user = :userid, visit_date = :visit_date, result = :result , marketing_name = :marketing_name, feedback = :feedback 
			WHERE id = :id
			"
		);
        date_default_timezone_set("Asia/Kolkata");
        $today = date("Y-m-d H:i:s");
		$result = $statement->execute(
			array(
             ':id'			    =>	$_POST["lead_id"],

			 ':company_name'	=> $_POST["company_name"],
                ':contact_name'	=> $_POST["contact_name"],
                ':mobile' => $_POST["mobile"],
                ':email' => $_POST["email"],
                ':address' => $_POST["address"],
                ':city'	=> $_POST["city"],
                ':custom_details' => $_POST["custom_details"],
                ':sector' => $_POST["sector"],
                ':date' =>	$today,
                ':userid' => $userid,
                ':visit_date' => $_POST["visit_date"],
                ':result' => $_POST["result"],
                ':marketing_name' => $_POST["marketing_name"],
                ':feedback'	=> $_POST["feedback"]         
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}else{echo 'Data Error';}
	}
}

?>