<?php
include("header.php");
?>
<!-- The tabs -->
<ul class="tabs">
<li class="tab1"><a href="licenses.php" class="tab1 tab">View Licenses</a></li>
<li class="tab2"><a href="addlicense.php"class="tab1 tab active">Add License</a></li>
</ul>
<?php
############################################
# 	 <!-- Add License Data Insert -->	   #
############################################
if ($_GET['action'] == 'add'){
$countalllicenses = mysql_query("select licenses.ver from licenses");
if($licensesver = mysql_fetch_array($countalllicenses)){
$ver = $licensesver['ver'];
}
$clientid = str_replace(" ","",strip_tags($_POST['clientid']));
$siteurlfirst = str_replace(" ","",$_POST['siteurl']);
$siteurlwww = "www." .$siteurlfirst;
$siteurl = $siteurlfirst;
$licensekey = verificationcode($length = 10);
$hash = md5(time());
$active = "mUvF9atp0Q";
$issuedate = date("Y-m-d H:i:s");
$issuedby = $userid;
$brand = $_POST['brand'];
if($brand == ''){$brand = '0';}
if($siteurlfirst == "" || $clientid == ""){
echo ("<META http-equiv=Refresh content=1;URL=addlicense.php><div class='updateerror'>Error In Adding License.</div>");
}
else{
	$do_addlicense = mysql_query("INSERT INTO licenses(clientid,licensekey,hash,siteurl,siteurlwww,newstatus,issuedate,issuedby,ver,newbrand) VALUES('$clientid','$licensekey','$hash','$siteurl','$siteurlwww','$active','$issuedate','$userid','$ver','$brand')");
	if(mysql_affected_rows() > 0){
	echo ("<META http-equiv=Refresh content=1;URL=licenses.php><div class='updatesuccess'>License Has Been Added.</div>");
	}
	else{
	echo ("<META http-equiv=Refresh content=1;URL=addlicense.php><div class='updateerror'>Error In Adding License.</div>");
	}
}
}

########################################
#      <!-- Add License Form -->	   #
########################################
?>
<div class="tab1 tabsContent">
<form action="addlicense.php?action=add" name="addlicense" method="post" enctype="multipart/form-data">
<div class="everyoption">
<p><label for="clientid" class="control-label-themeselrs">Client ID</label> <input class="regular-text" type="text" name="clientid" value="<?php echo $clientid;?>" id="clientid" placeholder="Please Enter Client ID In Clients Area" /></p>
</div>
<div class="everyoption">
<p><label for="siteurl" class="control-label-themeselrs">Site URL</label> <input class="regular-text" type="text" name="siteurl" value="<?php echo $siteurl;?>" id="siteurl" placeholder="Please Enter Site URL (without http:// or www)" /></p>
</div>
<div class="everyoption">
<p><label for="brand" class="control-label-themeselrs">Branding Removal</label>
<div class="slideThree">
	<input type="checkbox" name="brand" id="brand" value="f1BhT6DGVT" <?php if ($brand == 'f1BhT6DGVT') echo 'checked="checked"'; ?>/>
	<label for="brand"></label>
</div></p>
</div>
</div>
<div style="margin: 5px auto; text-align: center;">
<input type="submit" name="updateoptions" class="button-primary" value="Add License Now">
</div>
</form>
<?php
require_once("footer.php");
?>