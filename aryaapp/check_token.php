<?php
//login.php
include('db.php');
$query = '';
$output = array();

if(isset($_POST["token"]) && isset($_POST["name"]))
{
 $token =$_POST["token"];
 $first_name = $_POST["name"];
 $query = "SELECT * FROM users WHERE token = '".$token."' AND first_name = '".$first_name."'";
 $statement = $connection->prepare($query);
 $statement->execute();
    $result = $statement->fetchAll();
 $num_row = $statement->rowCount();
 if($num_row === 1)
 {
     foreach($result as $row)
	{
		$output["user"] = $row["usertype"];
     }
     $output["name"] = $first_name;
     $output["token"] = $token;
     $output["logged_in"] = "true";
     
        
    }
        
    else{
       
        $output["name"] = "";
        $output["token"] = "";
        $output["logged_in"] = "false";
        $output["user"] ="";
        
    }
     echo json_encode($output);
}
else{
        $output["name"] = "";
        $output["token"] = "";
        $output["logged_in"] = "false";
    $output["user"] ="";
     echo json_encode($output);
}
?>