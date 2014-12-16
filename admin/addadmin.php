<?php
include("header.php");
?>
<!-- The tabs -->
<ul class="tabs">
<li class="tab1"><a href="admin.php" class="tab1 tab">View Admins</a></li>
<li class="tab2"><a href="addadmin.php"class="tab1 tab active">Add Admin</a></li>
</ul>
<?php
############################################
# 	 <!-- Add Admin Data Insert -->	   #
############################################
if ($_GET['action'] == 'add'){
echo "<div class='tab1 tabsContent'>";
$user = str_replace(" ","",strip_tags($_POST['user']));
$pass = str_replace(" ","",strip_tags($_POST['pass']));
$pass = md5($pass);
$email = str_replace(" ","",strip_tags($_POST['email']));
$name = strip_tags($_POST['name']);
$active = $_POST['active'];
$checkusername = mysql_query("SELECT admin.user from admin WHERE user='$user'");
$checkemail = mysql_query("SELECT admin.email from admin WHERE email='$email'");
if($user == "" || $pass == "" || $email == "" || $name == ""){
die ("<META http-equiv=Refresh content=1;URL=addadmin.php><div class='updateerror'>Error In Adding Administrator.</div>");
}
elseif (mysql_num_rows($checkemail) > 0){
	die ("<META http-equiv=Refresh content=1;URL=addadmin.php><div class='updateerror'>Email Address Already Exists.</div>");
}
elseif (mysql_num_rows($checkusername) > 0){
	die ("<META http-equiv=Refresh content=1;URL=addadmin.php><div class='updateerror'>Username Already Exists.</div>");
}
else{
	$do_addadmin = mysql_query("INSERT INTO admin(user,pass,email,name,active) VALUES('$user','$pass','$email','$name','$active')");
	if(mysql_affected_rows() > 0){
	echo ("<META http-equiv=Refresh content=1;URL=admin.php><div class='updatesuccess'>Administrator Has Been Added Successfully.</div>");
	}
	else{
	echo ("<META http-equiv=Refresh content=1;URL=addadmin.php><div class='updateerror'>Error In Adding Administrator.</div>");
	}
}
echo "</div>";
}

########################################
#      <!-- Add Admin Form -->	   #
########################################
if ($_GET['action'] == ''){
?>
<div class="tab1 tabsContent">
<form action="addadmin.php?action=add" name="addadmin" method="post" enctype="multipart/form-data">
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
<div class="everyoption">
<p><label for="active" class="control-label-themeselrs">Admin Status</label>
<div class="slideThree">
	<input type="checkbox" name="active" id="active" value="1" <?php if ($active == 1) echo 'checked="checked"'; ?>/>
	<label for="active"></label>
</div></p>
</div>
</div>
<div style="margin: 5px auto; text-align: center;">
<input type="submit" name="updateoptions" class="button-primary" value="Add Admin Now">
</div>
</form>
<?php
}
require_once("footer.php");
?>