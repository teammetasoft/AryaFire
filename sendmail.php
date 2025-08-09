<?php 
phpinfo();
include("class.phpmailer.php");
include("class.smtp.php");

    $name = $_POST['fullname'];
    $emailid = $_POST['emailid'];
    $numb = $_POST['contactno'];
    $sub = $_POST['subj'];
	$check1 = $_POST['message'];
    $cc = 'care@aryafireandsafety.com'
    
    $headers = "From:" . $emailid ."\r\n";
    $headers .= "Cc:" . $cc ."\r\n";
    $headers .="MIME-Version: 1.0\n";
    $headers .="X-Priority: 3";
    $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
    $headers .="X-Mailer: smail-PHP ".phpversion()."";
    $subject = "Arya Fire and Safety";
    $message = "Name :" . $name . "\r\n\n Subject: ". $sub ."\r\n\n Email: ". $emailid ."\r\n\n Number: ". $numb ."\r\n\n Query: " . $check1."" ;
	//echo $message;
    //echo "%%" . $query;

if(empty($_POST['fullname']) || empty($_POST['emailid']) || empty($_POST['contactno']) || empty($_POST['subj']) || empty($_POST['message']))
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