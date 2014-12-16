<?php
ob_start();
require_once ("../config.php");
require_once ("../includes/pagetitles/admin.php");
require_once ( '../includes/functions.php' );
//require_once ( '../includes/options.php' );
$browser = get_user_browser();
if ($browser == 'ie'){
	header('Location:ie.php');
}
@session_start();
$userid=$_SESSION['userid'];
$loginhash=$_SESSION['loginhash'];
$userfullname = $_SESSION['fullname'];
if(!isset($_SESSION['userid'])){
die(header('location:login.php'));
}
$checkdelorban = mysql_query("select admin.id,admin.name from admin where id=$userid AND active=1");
if (mysql_num_rows($checkdelorban) == 0){
session_unset();
session_destroy();
die(header('location:login.php'));
}
else{
$get_my_details = mysql_fetch_array($checkdelorban);
$userfullname = $get_my_details['name'];
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($sitename); ?> | <?php echo ($pagetitle); ?></title>
<!-- CSS -->
<link rel="stylesheet" href="../style/admin/style.css" type="text/css" />
<link rel="stylesheet" href="../style/font.css" type="text/css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery.hashchange.min.js" type="text/javascript"></script>

<script src="../js/container.js" type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>
<!--/ CSS -->
</head>
<body>
<div class="navbar-inner"><div class="left">Welcome <?php echo $userfullname ?></div><div class="right"><a href="logout.php?loginhash=<?php echo $loginhash; ?>">Sign Out</a></div></div>
<div class="mainContainer">
<div class="leftsidebar">
<ul>
<li><a href="index.php">Dashboard</a></li>
<li><a href="licenses.php">Licenses</a></li>
<li><a href="admin.php">Administrators</a></li>
<li><a href="profile.php">My Profile</a></li>
<li><a href="logout.php?loginhash=<?php echo $loginhash; ?>">Sign Out</a></li>
</ul>
</div>
<div class="htmltabs">