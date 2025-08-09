<?php 
phpinfo();
include("class.phpmailer.php");
include("class.smtp.php");

    $name = $_POST['name'];
    $emailid = $_POST['email'];
	$numb = $_POST['contactno'];
	$sub = $POST['subj']
	$check1 = $_POST['message'];

    
    $headers = "From:" . $emailid ."\r\n";
    $subject = "Arya Fire and Safety";
    $message = "Name :" . $name . "\r\n\ Subject :" . $sub . "\r\n\n Email: ". $emailid ."\r\n\n Number: ". $numb ."\r\n\n Query: " . $check1."" ;
	//echo $message;
    //echo "%%" . $query;

if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subj']) || empty($_POST['contactno'] || empty($_POST['message']))
{
echo "All fields required";
}
else{
 
$to = 'info@aryafireandsafety.com';
$result = mail($to, $subject, $message, $headers );
        if ( $result ) {
            echo 'OK';
        } else {
            echo 'FAIL';
        }
}
?>