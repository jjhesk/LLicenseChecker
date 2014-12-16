<?php
ob_start();
require_once ("../config.php");
require_once ("../includes/pagetitles/admin.php");
@session_start();
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
<script src="../js/jquery.easytabs.min.js" type="text/javascript"></script>
<script src="../js/container.js" type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>
<!--/ CSS -->
</head>
<body>
<div class="navbar-inner"><div class="left">Welcome To Admin Area Login</div><div class="right"><a href="#">Please Sign In</a></div></div>