<?php
ob_start();
require_once ("config.php");
$incomelicense = $_GET['license'];
$incomehash = $_GET['hash'];
$get_license = mysql_query("SELECT licenses.siteurl, licenses.siteurlwww, licenses.active, licenses.ver,licenses.brand,licenses.newstatus,licenses.newbrand FROM licenses WHERE licenses.licensekey = '$incomelicense' AND licenses.hash = '$incomehash'");
if(mysql_num_rows($get_license) > 0){
if($license_data = mysql_fetch_array($get_license)){
$siteurl = $license_data['siteurl'];
$siteurlwww = $license_data['siteurlwww'];
$status = $license_data['active'];
$ver = $license_data['ver'];
$brand = $license_data['brand'];
$newstatus = $license_data['newstatus'];
$newbrand = $license_data['newbrand'];
echo ("$siteurl,$siteurlwww,$status,$ver,$brand,$newstatus,$newbrand");
}
}
else{
echo ("notfound");
}
mysql_close($connection);
ob_flush();
?>