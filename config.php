<?php
$server_name = "localhost";
$db_username = "root";
$db_password = "123456";
$db_name = "lcn";

$whmcs_url = "https://cp.arb4host.net/adcp/";
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
