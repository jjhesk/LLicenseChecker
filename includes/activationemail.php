<?php
require_once("includes/class.phpmailer.php");
$activatemail = new PHPMailer();
	$activatemessage = "";
	$activatemail->IsSMTP(true);  // telling the class to use SMTP
    $activatemail->SMTPDebug  = false;
    $activatemail->SMTPAuth   = true;     // enable SMTP authentication
	$activatemail->SMTPSecure = 'tls';
	$activatemail->Port       = '587';             // set the SMTP port
    $activatemail->Host       = 'smtp.email.com';           // SMTP server
    $activatemail->Username   = 'you@email.com'; // SMTP account username
    $activatemail->Password   = '12345678'; // SMTP account password
	$activatemail->IsHTML(true);
    $activatemail->From       = 'you@email.com';
    $activatemail->FromName   = $sitename;
	$activatemail->AddAddress($incomeemail);
	$activatemail->Subject  = 'Activate Your Account';
	$activatemail->Body = $activatemessage;
	$activatemail->Send();
// Send Notification to Admin
