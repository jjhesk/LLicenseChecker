<?php
$server_name = "localhost";
$db_username = "db_user";
$db_password = "db_pass";
$db_name = "db_name";

$whmcs_url = "Your WHMCS System URL If You Use";
$sitename = "Licenses Manager";

$connection=mysql_connect($server_name,$db_username,$db_password);
if(!$connection)
{
	die("Can't Connect to Database ");
}
$database=mysql_select_db($db_name,$connection);
if(!$database)
{
	die("Database Doesn't Exists " .mysql_error());
}
?>
