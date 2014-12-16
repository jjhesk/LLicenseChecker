<?php
include("header.php");
?>
<!-- The tabs -->
<ul class="tabs">
<li class="tab1"><a href="admin.php" class="tab1 tab active">View Admins</a></li>
<li class="tab2"><a href="addadmin.php"class="tab1 tab">Add Admin</a></li>
</ul>
<?php
############################################
# 		 <!-- View All Admins -->	  	   #
############################################
if ($_GET['action'] == ''){
$get_admins = mysql_query("SELECT admin.id, admin.user, admin.name, admin.active FROM admin ORDER BY id ASC");
echo("<div class='tab1 tabsContent'><div class='teacherheadall'><div class='teacherheadleft'></div></div>");
?>
<div class='licenses-all licenses-all-head'>
<div class="ldiv lid">ID</div>
<div class="ldiv lclientid adminuser">Username</div>
<div class="ldiv lsiteurl adminname">Name</div>
<div class="ldiv lactive">Status</div>
<div class="ldiv deactivate">Edit</div>
<div class="ldiv ladelete">Delete</div>
</div>
<div class='licenses-all'>
<?php
WHILE($admindetails = mysql_fetch_array($get_admins)){
$id = $admindetails['id'];
$user = $admindetails['user'];
$name = $admindetails['name'];
$status = $admindetails['active'];
if($status == 1){
$active = "<span style='color:#8ac007;'>Active</span>";
}
else{
$active = "<span style='color:#FF0000;'>Banned</span>";
}
if($id == $userid){
$editadminpage = "profile.php";
}
else{
$editadminpage = "admin.php?action=editadmin&id=$id";
}
?>
<div class="ldiv lid"><a href="<?php echo $editadminpage ?>"><?php echo $id; ?></a></div>
<div class="ldiv lclientid adminuser"><a href="<?php echo $editadminpage ?>"><?php echo $user; ?></a></div>
<div class="ldiv lsiteurl lsiteurlleft2 adminname"><a href="<?php echo $editadminpage ?>"><?php echo $name; ?></a></div>
<div class="ldiv lactive"><?php echo $active; ?></div>
<div class="ldiv deactivate"><a href="<?php echo $editadminpage ?>">Edit</div>
<div class="ldiv ladelete"><a href="javascript:if(confirm('Are You Sure?')) window.location.href = 'admin.php?action=deladmin&id=<?php echo $id ?>'">Delete</a></div>
<?php

}
echo("</div></div>");
}

########################################
#      <!-- Edit Admin Form -->	   #
########################################
if ($_GET['action'] == 'editadmin'){
$id = $_GET['id'];
if($id == $userid){
die(header('location:profile.php'));
}
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
<form action="admin.php?action=update" name="editadmin" method="post" enctype="multipart/form-data">
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
<input type="submit" name="updateoptions" class="button-primary" value="Edit Administrator">
</div>
</form>
<?php
}

############################################
# 	 <!-- Update Admin Data Insert -->	   #
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
	die ("<META http-equiv=Refresh content=2;URL=admin.php?action=editadmin&id=$id><div class='updateerror'>Administrator Fields Can't Be Empty.</div>");
}
elseif($pass == ""){
$do_update = mysql_query("UPDATE admin SET user='$user',email='$email',name='$name',active='$active' WHERE admin.id = $id");
	if(mysql_affected_rows() > 0){
	echo ("<META http-equiv=Refresh content=1;URL=admin.php><div class='updatesuccess'>Administrator Has Been Updated Successfully.</div>");
	}
	else{
	die ("<META http-equiv=Refresh content=2;URL=admin.php?action=editadmin&id=$id><div class='updateerror'>Nothing Changed.</div>");
	}
}
else{
$pass = md5($pass);
$do_addadmin = mysql_query("UPDATE admin SET user='$user',pass='$pass',email='$email',name='$name',active='$active' WHERE admin.id = $id");
	if(mysql_affected_rows() > 0){
	echo ("<META http-equiv=Refresh content=1;URL=admin.php><div class='updatesuccess'>Administrator Has Been Updated Successfully.</div>");
	}
	else{
	die ("<META http-equiv=Refresh content=2;URL=admin.php?action=editadmin&id=$id><div class='updateerror'>Error In Updating Administrator.</div>");
	}
}
echo("</div>");
}

############################################
# 		 <!-- Delete Admin -->	  	   #
############################################
if ($_GET['action'] == 'deladmin'){
echo("<div class='tab1 tabsContent'>");
$id = $_GET['id'];
if($id == $userid){
die ("<META http-equiv=Refresh content=1;URL=addadmin.php><div class='updateerror'>You Can't Delete Yourself.</div>");
}
$do_delete = mysql_query("DELETE FROM admin WHERE admin.id = $id");
	echo ("<META http-equiv=Refresh content=1;URL=admin.php><div class='updatesuccess'>Administrator Deleted.</div>");
echo("</div>");
}
require_once("footer.php");
?>