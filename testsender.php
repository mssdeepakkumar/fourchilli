<?php
// Include mailer
require_once('testmailer.php');

$thistz = time() + ((mktime()-gmmktime())+((15*60*60)));
//print date("Y-m-d H:i:s",$thistz);
$sendtime = date("Y-m-d H:i:s",$thistz);
$email = "kit147@hotmail.com,yunlung.ten@gmail.com,nljm@hotmail.com";

if ($mailer->sendTestMail($email,$sendtime))
{
	print "Send Email Success!";	
}
else
{
	print "Send Email Fail!";
}

//mail($email, "Fourchillies Test Mailer.", "Received email at: ".$sendtime, "From: Four Chillies <admin@fourchillies.com>") or die("Send mail failed!");
?>