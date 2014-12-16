<?php 
$pagename = basename($_SERVER['PHP_SELF']);
if($pagename == 'addadmin.php'){
$pagetitle = 'Add Administrator';
}
if($pagename == 'admin.php'){
$pagetitle = 'View Administrator';
}
if($pagename == 'licenses.php'){
$pagetitle = 'View Licenses';
}
if($pagename == 'addlicense.php'){
$pagetitle = 'Add License';
}
if($pagename == 'profile.php'){
$pagetitle = 'Edit Admin Profile';
}
if($pagename == 'index.php'){
$pagetitle = 'Dashboard';
}
if($pagename == 'login.php'){
$pagetitle = 'Admin Login';
}