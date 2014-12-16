<?php
include("header-install.php");
?>
<div class="tab1 tabsContent tabslogin">
<div class="admindashboradlogin admininstall">
<?php
if ($_GET['action'] == 'step1'){
if( mysql_num_rows( mysql_query("SHOW TABLES LIKE 'admin'")))
{$admin = "1";}else{$admin = "0";}
if( mysql_num_rows( mysql_query("SHOW TABLES LIKE 'licenses'")))
{$licenses = "1";}else{$licenses = "0";}
if( mysql_num_rows( mysql_query("SHOW TABLES LIKE 'adminnotes'")))
{$adminnotes = "1";}else{$adminnotes = "0";}
if($admin == '1' && $licenses == '1' && $adminnotes == '1'){
die(header('location:login.php'));
}
else{
echo "Creating Table admin...<br />";
mysql_query("CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL DEFAULT '',
  `pass` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
echo "Creating Table licenses...<br />";
mysql_query("CREATE TABLE IF NOT EXISTS `licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientid` int(11) NOT NULL DEFAULT '0',
  `licensekey` varchar(255) NOT NULL DEFAULT '',
  `hash` varchar(255) DEFAULT NULL,
  `siteurl` varchar(255) NOT NULL DEFAULT '',
  `siteurlwww` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '0',
  `issuedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `issuedby` varchar(255) NOT NULL DEFAULT '',
  `ver` varchar(10) DEFAULT NULL,
  `brand` varchar(10) DEFAULT NULL,
  `newstatus` varchar(20) DEFAULT NULL,
  `newbrand` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
echo "Creating Table adminnotes...<br />";
mysql_query("CREATE TABLE IF NOT EXISTS `adminnotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
if($adminnotes == '0'){
mysql_query("INSERT INTO adminnotes(notes) VALUES('This Is Test Note You Can Change It Now')");
}
echo "<span style='color:#2cb508;'>Tables Has Been Created Successfully</span><br />";
if($admin == '1'){
$nextsteplink = "install.php?action=step4";
$nextsteptitle = "GO TO LAST STEP FINALIZING YOUR INSTALLATION";
}
else{
$nextsteplink = "install.php?action=step2";
$nextsteptitle = "GO TO NEXT STEP TO CREATE THE FIRST ADMINISTRATOR";
}
?>
<form name="adminnotes" action="<?php echo $nextsteplink;?>" method="post">
<input type="submit" name="step1" class="button-primary setp1" value="<?php echo $nextsteptitle;?>">
</form>
<?php
}
}
if ($_GET['action'] == 'step2'){
?>
<form action="install.php?action=step3" name="addadmin" method="post" enctype="multipart/form-data">
<div class="everyoption">
<p><label for="user" class="control-label-themeselrs">Admin Username</label> <input class="regular-text" type="text" name="user" value="<?php echo $user;?>" id="user" placeholder="Please Enter Admin Username" /></p>
</div>
<div class="everyoption">
<p><label for="pass" class="control-label-themeselrs">Admin Password</label> <input class="regular-text" type="text" name="pass" value="<?php echo $pass;?>" id="pass" placeholder="Please Enter Admin Password" /></p>
</div>
<div class="everyoption">
<p><label for="email" class="control-label-themeselrs">Admin Email</label> <input class="regular-text" type="text" name="email" value="<?php echo $email;?>" id="email" placeholder="Please Enter Admin Email" /></p>
</div>
<div class="everyoption">
<p><label for="name" class="control-label-themeselrs">Admin Name</label> <input class="regular-text" type="text" name="name" value="<?php echo $name;?>" id="name" placeholder="Please Enter Admin Name" /></p>
</div>
</div>
<div style="margin: 5px auto; text-align: center;">
<input type="submit" name="updateoptions" class="button-primary" value="Add Admin Now">
</div>
</form>
<? }
if ($_GET['action'] == 'step3'){
$user = str_replace(" ","",strip_tags($_POST['user']));
$pass = str_replace(" ","",strip_tags($_POST['pass']));
$pass = md5($pass);
$email = str_replace(" ","",strip_tags($_POST['email']));
$name = strip_tags($_POST['name']);
$active = "1";
$checkusername = mysql_query("SELECT admin.user from admin WHERE user='$user'");
$checkemail = mysql_query("SELECT admin.email from admin WHERE email='$email'");
if($user == "" || $pass == "" || $email == "" || $name == ""){
die ("<META http-equiv=Refresh content=1;URL=install.php?action=step2><div class='updateerror'>Administrator Fields Can't Be Empty.</div>");
}
elseif (mysql_num_rows($checkemail) > 0){
	die ("<META http-equiv=Refresh content=1;URL=install.php?action=step2><div class='updateerror'>Email Address Already Exists.</div>");
}
elseif (mysql_num_rows($checkusername) > 0){
	die ("<META http-equiv=Refresh content=1;URL=install.php?action=step2><div class='updateerror'>Username Already Exists.</div>");
}
else{
	$do_addadmin = mysql_query("INSERT INTO admin(user,pass,email,name,active) VALUES('$user','$pass','$email','$name','$active')");
	if(mysql_affected_rows() > 0){
	echo ("<META http-equiv=Refresh content=4;URL=install.php?action=step4><div class='updatesuccess'>Administrator Has Been Created Successfully.</div>");
	}
	else{
	echo ("<META http-equiv=Refresh content=1;URL=install.php?action=step2><div class='updateerror'>Error In Adding Administrator.</div>");
	}
}
}

if ($_GET['action'] == 'step4'){
echo("<h1>License Manager Has Been Installed Successfully!</h1><br /><h1 style='color:#FF0000; text-align: center;'>Please Remove install.php File Now For Security Reason</h1>
<form name='adminnotes' action='login.php' method='post'>
<input type='submit' name='step1' class='button-primary setp1' value='CLICK HERE TO GO TO ADMIN LOGIN PAGE'>
</form>");
}
if ($_GET['action'] == ''){
echo("<h1>Install License Manager From Arb4Host Network!</h1>
<form name='adminnotes' action='install.php?action=step1' method='post'>
<input type='submit' name='step1' class='button-primary setp1' value='GO TO FIRST STEP TO CHECK IF TABLES EXISTS AND CREATE TABLES'>
</form>");
}
?>
</div>
</div>
<?php require_once("footer.php"); ?>