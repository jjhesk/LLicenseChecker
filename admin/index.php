<?php
include("header.php");

$adminnotes = mysql_query("select * from adminnotes");
if($notes = mysql_fetch_array($adminnotes)){
$adminnotes = $notes['notes'];
}
$countalllicenses = mysql_query("select licenses.id, licenses.ver from licenses");
$num_of_all_licenses = mysql_num_rows($countalllicenses);
if($licensesver = mysql_fetch_array($countalllicenses)){
$ver = $licensesver['ver'];
}

$countactivelicenses = mysql_query("select licenses.id from licenses WHERE licenses.active = 1");
$num_of_active_licenses = mysql_num_rows($countactivelicenses);

$countinactivelicenses = mysql_query("select licenses.id from licenses WHERE licenses.active = 0");
$num_of_inactive_licenses = mysql_num_rows($countinactivelicenses);

$countadmins = mysql_query("select admin.id from admin");
$num_of_admins = mysql_num_rows($countadmins);

$jsonfile = '../check_template_version.json';
$current_json = file_get_contents($jsonfile);
?>
<div class="tab1 tabsContent tabsupdateoptions">
<div class="admindashborad">
<div class="dashleft">
<h1>At a Glance!</h1>
<div class="adminnotes">
<label class="control-label-themeselrs labeladmin"><?php echo @$num_of_all_licenses; ?> License(s)<br /></label>
<label class="control-label-themeselrs labeladmin"><?php echo @$num_of_active_licenses; ?> Active License(s)<br /></label>
<label class="control-label-themeselrs labeladmin"><?php echo @$num_of_inactive_licenses; ?> Inactive License(s)<br /></label>
<label class="control-label-themeselrs labeladmin"><?php echo @$num_of_admins; ?> Administrator(s)<br /></label>
</div>
</div>
<div class="dashright">
<h1>The JSON File</h1>
<div class="adminnotes">
<div class="everyoption everyoptionver">
<form name="adminnotes" action="updateoptions.php?action=updatejsonfile" method="post">
<textarea class="regular-textarea adminnotestext" name="jsonapifile" id="jsonapifile" /><?php echo @$current_json;?></textarea>
<input type="submit" name="updatenotes" class="button-primary" value="Update JSON File">
</form>
</div>
<div class="everyoption everyoptionver2">
<form action="licenses.php?action=updatever" name="addlicense" method="post" enctype="multipart/form-data">
<p><label for="licensever" class="control-label-themeselrs control-label2">License Version</label> <input class="regular-text regular-text3" type="text" name="licensever" value="<?php echo @$ver;?>" id="licensever" placeholder="Please Enter Latest License Version" /></p>
<input type="submit" name="updateversion" class="button-primary" value="Update Version">
</form>
</div>
</div>
</div>
</div>
</div>
<?php require_once("footer.php"); ?>