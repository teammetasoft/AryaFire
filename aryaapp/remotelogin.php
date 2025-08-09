<?php
header("Access-Control-Allow-Origin: *");
include('db.php');
$query = '';
$output = array();
$token='';

if(isset($_POST["username"]) && isset($_POST["password"]))
{
 $username =$_POST["username"];
 $password = md5($_POST["password"]);
 $query = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";
 $statement = $connection->prepare($query);
 $statement->execute();
 $num_row = $statement->rowCount();
 if($num_row === 1)
 {
     $token= md5($username.time());
  $result = $statement->fetchAll();
	foreach($result as $row)
	{
		
        $output["first_name"] = $row["first_name"];
        $output["token"] = $token;
        $output["user"] = $row["usertype"];
        
    }
     $updateStatement = $connection->prepare(
			"UPDATE users SET token = '$token', lastlog=now() WHERE username = '$username'"
		);
     $updateStatement->execute();
    
 }
    else{
       
        $output["first_name"] = "";
        $output["token"] = "";
        $output["user"] = "";
        
    }
     echo json_encode($output);
}
?>