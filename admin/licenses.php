<?php
include("header.php");
?>
<!-- The tabs -->
<ul class="tabs">
<li class="tab1"><a href="licenses.php" class="tab1 tab active">View Licenses</a></li>
<li class="tab2"><a href="addlicense.php"class="tab1 tab">Add License</a></li>
</ul>
<?php
############################################
# 		 <!-- View All Licenses -->	  	   #
############################################
if ($_GET['action'] == ''){
$get_licenses = mysql_query("SELECT licenses.id, licenses.clientid, licenses.licensekey, licenses.hash, licenses.siteurl, licenses.siteurlwww, licenses.active, licenses.newstatus FROM licenses ORDER BY id DESC");
echo("<div class='tab1 tabsContent'><div class='teacherheadall'><div class='teacherheadleft'></div><div class='teacherheadright'><form action='licenses.php?action=searchlicense' method='POST' name='searchlicensename'><input type='text' name='licensekey' id='licensekey' class='regular-text regular-textsearch' placeholder='Enter License Key'><br /><div class='searchtype'></div></form></div></div>");
?>
<div class='licenses-all licenses-all-head'>
<div class="ldiv lid">ID</div>
<div class="ldiv lclientid">Client ID</div>
<div class="ldiv lsiteurl">Website URL</div>
<div class="ldiv lactive">Status</div>
<div class="ldiv deactivate">Deactivate</div>
<div class="ldiv ladelete">Delete</div>
</div>
<div class='licenses-all'>
<?php
WHILE($licensedata = mysql_fetch_array($get_licenses)){
$id = $licensedata['id'];
$clientid = $licensedata['clientid'];
$licensekey = $licensedata['licensekey'];
$hash = $licensedata['hash'];
$siteurl = $licensedata['siteurl'];
$siteurlwww = $licensedata['siteurlwww'];
$status = $licensedata['active'];
$newstatus = $licensedata['newstatus'];
if($status == 1 || $newstatus == 'mUvF9atp0Q'){
$active = "<span style='color:#8ac007;'>Active</span>";
}
else{
$active = "<span style='color:#FF0000;'>Inactive</span>";
}
?>

<div class="ldiv lid"><a href="licenses.php?action=edit&id=<?php echo $id; ?>"><?php echo $id; ?></a></div>
<div class="ldiv lclientid"><a href="<?php echo $whmcs_url; ?>clientssummary.php?userid=<?php echo $clientid; ?>"><?php echo $clientid; ?></a></div>
<div class="ldiv lsiteurl lsiteurlleft2"><a href="licenses.php?action=edit&id=<?php echo $id; ?>"><?php echo $siteurlwww; ?></a></div>
<div class="ldiv lactive"><?php echo $active; ?></div>
<?php 
if($status == 1 || $newstatus == 'mUvF9atp0Q'){
echo ("<div class='ldiv deactivate'><a href='licenses.php?action=stoplicense&id=$id'>Deactivate</div>");
}
else{
echo ("<div class='ldiv deactivate'><a href='licenses.php?action=activate&id=$id'>Activate</div>");
}
?>
<div class="ldiv ladelete"><a href="javascript:if(confirm('Are You Sure?')) window.location.href = 'licenses.php?action=dellicense&id=<?php echo $id ?>'">Delete</a></div>
<?php

}
echo("</div></div>");
}

############################################
# 		 <!-- Search Result Licenses -->	  	   #
############################################
if ($_GET['action'] == 'searchlicense'){
$licensekey = $_POST['licensekey'];
$get_licenses = mysql_query("SELECT licenses.id, licenses.clientid, licenses.licensekey, licenses.hash, licenses.siteurl, licenses.siteurlwww, licenses.active, licenses.newstatus FROM licenses WHERE licenses.licensekey = '$licensekey'");
echo("<div class='tab1 tabsContent'><div class='teacherheadall'><div class='teacherheadleft'></div><div class='teacherheadright'><form action='licenses.php?action=searchlicense' method='POST' name='searchlicense'><input type='text' name='licensekey' id='licensekey' class='regular-text regular-textsearch' placeholder='Enter License Key'><br /><div class='searchtype'></div></form></div></div>");
?>
<div class='licenses-all licenses-all-head'>
<div class="ldiv lid">ID</div>
<div class="ldiv lclientid">Client ID</div>
<div class="ldiv lsiteurl">Website URL</div>
<div class="ldiv lactive">Status</div>
<div class="ldiv deactivate">Deactivate</div>
<div class="ldiv ladelete">Delete</div>
</div>
<div class='licenses-all'>
<?php
if(mysql_num_rows($get_licenses) > 0){
if($licensedata = mysql_fetch_array($get_licenses)){
$id = $licensedata['id'];
$clientid = $licensedata['clientid'];
$licensekey = $licensedata['licensekey'];
$hash = $licensedata['hash'];
$siteurl = $licensedata['siteurl'];
$siteurlwww = $licensedata['siteurlwww'];
$status = $licensedata['active'];
$newstatus = $licensedata['newstatus'];
if($status == 1 || $newstatus == 'mUvF9atp0Q'){
$active = "<span style='color:#8ac007;'>Active</span>";
}
else{
$active = "<span style='color:#FF0000;'>Inactive</span>";
}
?>

<div class="ldiv lid"><a href="licenses.php?action=edit&id=<?php echo $id; ?>"><?php echo $id; ?></a></div>
<div class="ldiv lclientid"><a href="<?php echo $whmcs_url; ?>clientssummary.php?userid=<?php echo $clientid; ?>"><?php echo $clientid; ?></a></div>
<div class="ldiv lsiteurl lsiteurlleft2"><a href="licenses.php?action=edit&id=<?php echo $id; ?>"><?php echo $siteurlwww; ?></a></div>
<div class="ldiv lactive"><?php echo $active; ?></div>
<?php 
if($status == 1 || $newstatus == 'mUvF9atp0Q'){
echo ("<div class='ldiv deactivate'><a href='licenses.php?action=stoplicense&id=$id'>Deactivate</div>");
}
else{
echo ("<div class='ldiv deactivate'><a href='licenses.php?action=activate&id=$id'>Activate</div>");
}
?>
<div class="ldiv ladelete"><a href="javascript:if(confirm('Are You Sure?')) window.location.href = 'licenses.php?action=dellicense&id=<?php echo $id ?>'">Delete</a></div>
<?php

}
}
else{
echo("<div class='no-licenses'>No Licenses Found</div>");
}
echo("</div></div>");
}

############################################
# 		 <!-- Delete License -->	  	   #
############################################
if ($_GET['action'] == 'dellicense'){
echo("<div class='tab1 tabsContent'>");
$id = $_GET['id'];
$do_delete = mysql_query("DELETE FROM licenses WHERE licenses.id = $id");
	echo ("<META http-equiv=Refresh content=1;URL=licenses.php><div class='updatesuccess'>License Deleted.</div>");
echo("</div>");
}

############################################
# 		 <!-- Deactivate License -->	  	   #
############################################
if ($_GET['action'] == 'stoplicense'){
echo("<div class='tab1 tabsContent'>");
$id = $_GET['id'];
$do_deacivate = mysql_query("UPDATE licenses SET active=0, newstatus='0' WHERE licenses.id = $id");
	echo ("<META http-equiv=Refresh content=1;URL=licenses.php><div class='updatesuccess'>License Deactivated.</div>");
echo("</div>");
}

############################################
# 		 <!-- Activate License -->	  	   #
############################################
if ($_GET['action'] == 'activate'){
echo("<div class='tab1 tabsContent'>");
$id = $_GET['id'];
$do_deacivate = mysql_query("UPDATE licenses SET active=1, newstatus='mUvF9atp0Q' WHERE licenses.id = $id");
	echo ("<META http-equiv=Refresh content=1;URL=licenses.php><div class='updatesuccess'>License Activated.</div>");
echo("</div>");
}

############################################
# 		 <!-- Edit License -->	  	   #
############################################
if ($_GET['action'] == 'edit'){
$id = $_GET['id'];
$get_licenses = mysql_query("SELECT licenses.*,admin.name FROM licenses  INNER JOIN admin ON licenses.issuedby = admin.id WHERE licenses.id = $id");
if ($licensedata=mysql_fetch_array($get_licenses)){
$id = $licensedata['id'];
$clientid = $licensedata['clientid'];
$licensekey = $licensedata['licensekey'];
$hash = $licensedata['hash'];
$siteurl = $licensedata['siteurl'];
$siteurlwww = $licensedata['siteurlwww'];
$issuedate = $licensedata['issuedate'];
$issuedby = $licensedata['name'];
$status = $licensedata['active'];
$newstatus = $licensedata['newstatus'];
$brand = $licensedata['brand'];
$newbrand = $licensedata['newbrand'];
}
if (mysql_num_rows($get_licenses) > 0){
?>
<div class="tab1 tabsContent">
<form action="licenses.php?action=update" name="addlicense" method="post" enctype="multipart/form-data">
<div class="everyoption">
<p><label for="clientid" class="control-label-themeselrs">Client ID</label> <input class="regular-text" type="text" name="clientid" value="<?php echo $clientid;?>" id="clientid" placeholder="Please Enter Client ID In Clients Area" /></p>
</div>
<div class="everyoption">
<p><label for="siteurl" class="control-label-themeselrs">Site URL Without WWW</label> <input class="regular-text" type="text" name="siteurl" value="<?php echo $siteurl;?>" id="siteurl" placeholder="Please Enter Site URL (without http://www.)" /></p>
</div>
<div class="everyoption">
<p><label for="siteurlwww" class="control-label-themeselrs">Site URL With WWW</label> <input class="regular-text" type="text" name="siteurlwww" value="<?php echo $siteurlwww;?>" id="siteurlwww" placeholder="Please Enter Site URL (without http://www.)" /></p>
</div>
<div class="everyoption">
<p><label for="licensekey" class="control-label-themeselrs">License Key</label> <input class="regular-text readonly" type="text" name="licensekey" value="<?php echo $licensekey;?>" id="licensekey" placeholder="Please Enter Client ID In Clients Area" readonly="readonly" /></p>
</div>
<div class="everyoption">
<p><label for="hash" class="control-label-themeselrs">License Hash</label> <input class="regular-text readonly" type="text" name="hash" value="<?php echo $hash;?>" id="hash" placeholder="Please Enter Client ID In Clients Area" readonly="readonly" /></p>
</div>
<div class="everyoption">
<p><label for="status" class="control-label-themeselrs">License Status</label>
<div class="slideThree">
	<input type="checkbox" name="status" id="status" value="mUvF9atp0Q" <?php if ($status == 1 || $newstatus == 'mUvF9atp0Q') echo 'checked="checked"'; ?>/>
	<label for="status"></label>
</div></p>
</div>
<div class="everyoption">
<p><label for="issuedate" class="control-label-themeselrs">License Issue Date</label> <input class="regular-text readonly" type="text" name="issuedate" value="<?php echo $issuedate;?>" id="issuedate" readonly="readonly" /></p>
</div>
<div class="everyoption">
<p><label for="issuedby" class="control-label-themeselrs">License Issued By</label> <input class="regular-text readonly" type="text" name="issuedby" value="<?php echo $issuedby;?>" id="issuedby" readonly="readonly" /></p>
</div>
<div class="everyoption">
<p><label for="brand" class="control-label-themeselrs">Branding Removal</label>
<div class="slideThree">
	<input type="checkbox" name="brand" id="brand" value="f1BhT6DGVT" <?php if ($brand == 1 || $newbrand == 'f1BhT6DGVT') echo 'checked="checked"'; ?>/>
	<label for="brand"></label>
</div></p>
</div>
</div>
<div style="margin: 5px auto; text-align: center;">
<input type="hidden" name="id" value="<?php echo $id;?>" />
<input type="submit" name="updateoptions" class="button-primary" value="Update License Now">
</div>
</form>
<?php
}
else{
echo("<div class='tab1 tabsContent'>");
die ("<META http-equiv=Refresh content=1;URL=licenses.php><div class='updateerror'>License ID Not found.</div>");
echo("</div>");
}
}

############################################
# 		 <!-- Update License -->	  	   #
############################################
if ($_GET['action'] == 'update'){
echo("<div class='tab1 tabsContent'>");
$id = $_POST['id'];
$clientid = str_replace(" ","",strip_tags($_POST['clientid']));
$siteurl = str_replace(" ","",$_POST['siteurl']);
$siteurlwww = str_replace(" ","",$_POST['siteurlwww']);
$brand = $_POST['brand'];
if($brand == 'f1BhT6DGVT'){$oldbrand = '1';}
if($brand == ''){$brand = '0'; $oldbrand = '0';}
$status = $_POST['status'];
if($status == 'mUvF9atp0Q'){$oldstatus = '1';}
if($status == ''){$status = '0'; $oldstatus = '0';}

$do_deacivate = mysql_query("UPDATE licenses SET clientid='$clientid',siteurl='$siteurl',siteurlwww='$siteurlwww',brand='$oldbrand',newbrand='$brand',active='$oldstatus',newstatus='$status' WHERE licenses.id = $id");
	echo ("<META http-equiv=Refresh content=1;URL=licenses.php><div class='updatesuccess'>License Updated.</div>");
echo("</div>");
}

############################################
# 	<!-- Update License Version -->	  	   #
############################################
if ($_GET['action'] == 'updatever'){
echo("<div class='tab1 tabsContent'>");
$ver = str_replace(" ","",$_POST['licensever']);

$do_update_ver = mysql_query("UPDATE licenses SET licenses.ver='$ver'");
	echo ("<META http-equiv=Refresh content=1;URL=index.php><div class='updatesuccess'>License Version Updated.</div>");
echo("</div>");
}
require_once("footer.php");
?>