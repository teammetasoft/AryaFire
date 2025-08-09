<?php
include('db.php');
include('function.php');
//$token= $_POST["token"]

$query = '';
$output = array();
$query = "SELECT * FROM leads";


$statement = $connection->prepare($query);
$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

$output=$result;
//$totalRows=["rows"=>$statement->rowCount()];
//$output[]=$totalRows;
//echo(json_encode(["last_page"=>10, "data"=>$output]));
echo json_encode($output);

//print_r ($output);

/*if(isset($_POST[])){

$data = [
    ["id"=>1, "name"=>"Billy Bob", "progress"=>"12", "gender"=>"male", "height"=>1, "col"=>"red", "dob"=>"", "driver"=>1],
    
];

//return JSON formatted data
echo(json_encode($data));
    
}else{
    echo "Invalid request";
}*/


?>