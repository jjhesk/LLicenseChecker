<?php
include("header.php");
?>
<div class="tab1 tabsContent tabsupdateoptions">
<?php
if ($_REQUEST['action'] == 'adminnotes'){
$up_adminnotes = strip_tags($_POST['adminnotes']);
$do_update = mysql_query("UPDATE adminnotes SET notes='$up_adminnotes' WHERE Id=1");
echo ("<META http-equiv=Refresh content=2;URL=index.php><div class='updatesuccess'>Notes Updated.</div>");
}
if ($_REQUEST['action'] == 'updatejsonfile'){
$jsonfile = '../check_template_version.json';
$up_jsonfile = strip_tags($_POST['jsonapifile']);
file_put_contents($jsonfile, $up_jsonfile);
echo ("<META http-equiv=Refresh content=2;URL=index.php><div class='updatesuccess'>JSON File Updated.</div>");
}
require_once("footer.php");
?>