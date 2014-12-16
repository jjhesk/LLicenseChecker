<?php
include("header.php");
########################################
#      <!-- Edit Profile Form -->	   #
########################################
if ($_GET['action'] == ''){
$id = $userid;
$get_admin = mysql_query("SELECT admin.id, admin.user, admin.email, admin.name, admin.active FROM admin WHERE id = '$id'");
if($admindetails = mysql_fetch_array($get_admin)){
$id = $admindetails['id'];
$user = $admindetails['user'];
$email = $admindetails['email'];
$name = $admindetails['name'];
$active = $admindetails['active'];
}
?>
<div class="tab1 tabsContent">
<form action="profile.php?action=update" name="editadmin" method="post" enctype="multipart/form-data">
<div class="everyoption">
<p><label for="user" class="control-label-themeselrs">Admin Username</label> <input class="regular-text" type="text" name="user" value="<?php echo $user;?>" id="user" placeholder="Please Enter Admin Username" /></p>
</div>
<div class="everyoption">
<p><label for="pass" class="control-label-themeselrs">Admin Password</label> <input class="regular-text" type="text" name="pass" value="<?php echo $pass;?>" id="pass" placeholder="Leave it Blank If You Don't Want to Change" /></p>
</div>
<div class="everyoption">
<p><label for="email" class="control-label-themeselrs">Admin Email</label> <input class="regular-text" type="text" name="email" value="<?php echo $email;?>" id="email" placeholder="Please Enter Admin Email" /></p>
</div>
<div class="everyoption">
<p><label for="name" class="control-label-themeselrs">Admin Name</label> <input class="regular-text" type="text" name="name" value="<?php echo $name;?>" id="name" placeholder="Please Enter Admin Name" /></p>
</div>
<?php if($id !== $userid){ ?>
<div class="everyoption">
<p><label for="active" class="control-label-themeselrs">Admin Status</label>
<div class="slideThree">
	<input type="checkbox" name="active" id="active" value="1" <?php if ($active == 1) echo 'checked="checked"'; ?>/>
	<label for="active"></label>
</div></p>
</div>
<? } ?>
</div>
<div style="margin: 5px auto; text-align: center;">
<?php if($id == $userid){ ?>
<input type="hidden" name="active" value="<?php echo $active;?>" />
<? } ?>
<input type="hidden" name="id" value="<?php echo $id;?>" />
<input type="submit" name="updateoptions" class="button-primary" value="Update Profile">
</div>
</form>
<?php
}
############################################
# 	 <!-- Update Profile Data Insert -->	   #
############################################
if ($_GET['action'] == 'update'){
echo("<div class='tab1 tabsContent'>");
$id = $_POST['id'];
$user = str_replace(" ","",strip_tags($_POST['user']));
$pass = str_replace(" ","",strip_tags($_POST['pass']));
$email = str_replace(" ","",strip_tags($_POST['email']));
$name = strip_tags($_POST['name']);
$active = $_POST['active'];
if($active ==""){
$active = "0";
}
if($user == "" || $email == "" || $name == ""){
	die ("<META http-equiv=Refresh content=2;URL=profile.php><div class='updateerror'>Administrator Fields Can't Be Empty.</div>");
}
elseif($pass == ""){
$do_update = mysql_query("UPDATE admin SET user='$user',email='$email',name='$name',active='$active' WHERE admin.id = $id");
	if(mysql_affected_rows() > 0){
	echo ("<META http-equiv=Refresh content=1;URL=admin.php><div class='updatesuccess'>Your Profile Has Been Updated Successfully.</div>");
	}
	else{
	die ("<META http-equiv=Refresh content=2;URL=profile.php><div class='updateerror'>Nothing Changed.</div>");
	}
}
else{
$pass = md5($pass);
$do_addadmin = mysql_query("UPDATE admin SET user='$user',pass='$pass',email='$email',name='$name',active='$active' WHERE admin.id = $id");
	if(mysql_affected_rows() > 0){
	echo ("<META http-equiv=Refresh content=3;URL=admin.php><div class='updatesuccess'>Your Profile Has Been Updated Successfully.</div>");
	session_unset();
	session_destroy();
	die(header('location:login.php'));
	}
	else{
	die ("<META http-equiv=Refresh content=2;URL=profile.php><div class='updateerror'>Nothing Changed.</div>");
	}
}
echo("</div>");
}
require_once("footer.php");
?>