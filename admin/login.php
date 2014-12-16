<?php
include("header-login.php");
?>
<div class="tab1 tabsContent tabslogin">
<div class="admindashboradlogin">
<?php
if (@$_GET['action'] == 'dologin'){
$incomeusername = @$_POST['username'];
$incomepassword = md5(@$_POST['password']);
$do_login = mysql_query("select admin.id,admin.user,admin.name,admin.active from admin WHERE admin.user='$incomeusername' AND admin.pass='$incomepassword' AND admin.active='1'");

if ($result=mysql_fetch_array($do_login)){
	$userid=$result["id"];
	$userfullname=$result["name"];
	
echo ("<META http-equiv=Refresh content=2;URL=index.php><div class='updatesuccess'>Thank You For Logging $userfullname</div>");
	$_SESSION['userid'] = $userid;
	$_SESSION['loginhash'] = md5(microtime(true));
}
else{
	echo ("<div class='updateerror'>Please Check Your Data.</div>");
}
}
?>
<h1>Control Panel Login!</h1>
<form name="adminnotes" action="login.php?action=dologin" method="post">
<div class="everyoption">
<p><label for="username" class="control-label-themeselrs">Admin Username</label> <input class="regular-text" type="text" name="username" placeholder="Please Enter Your Username" value="<?php global $incomeusername; echo $incomeusername; ?>" id="username" /></p>
</div>
<p><label for="password" class="control-label-themeselrs">Admin Password</label> <input class="regular-text" type="password" name="password" placeholder="Please Enter Your Password" id="password" /></p>
<input type="submit" name="updatenotes" class="button-primary" value="Sign In">
</form>
</div>
</div>
<?php require_once("footer.php"); ?>