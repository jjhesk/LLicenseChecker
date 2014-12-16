<?php
require_once("includes/class.phpmailer.php");
$activatemail = new PHPMailer();
	$activatemessage = "<div style='direction: ltr; padding: 20px; border: 1px dashed rgb(51, 51, 51); font-family: tahoma; font-size: 13px; display: inline-block; text-align: left; border-radius: 10px; line-height: 25px;'>Hello Mr / $incomefullname,<br />Thank You for register with us<br />to complete your registration please activate your account now by clicking on the following link or take it copy and paste it in address bar<br /><a href='$siteurl/activation.php?do=verify&username=$incomeusername&verification=$verify'>$siteurl/activation.php?do=verify&username=$incomeusername&verification=$verify</a><br />or you can activate it manually by clicking on the following link and enter the following data<br /><a href='$siteurl/activation.php'>$siteurl/activation.php</a><br />Username : $incomeusername<br />Verification Code : $verify<br /><br /><hr>Best Regards<br />$sitename</div>";
	$activatemail->IsSMTP(true);  // telling the class to use SMTP
    $activatemail->SMTPDebug  = false;
    $activatemail->SMTPAuth   = true;     // enable SMTP authentication
	$activatemail->SMTPSecure = 'tls';
	$activatemail->Port       = '587';             // set the SMTP port
    $activatemail->Host       = 'smtp.live.com';           // SMTP server
    $activatemail->Username   = 'lotfy@php-yat.tk'; // SMTP account username
    $activatemail->Password   = 'yat102030'; // SMTP account password
	$activatemail->IsHTML(true);
    $activatemail->From       = 'lotfy@php-yat.tk';
    $activatemail->FromName   = $sitename;
	$activatemail->AddAddress($incomeemail);
	$activatemail->Subject  = 'Activate Your Account';
	$activatemail->Body = $activatemessage;
	$mail->AddAttachment('lotfy.jpg');
	$activatemail->Send();
// Send Notification to Admin