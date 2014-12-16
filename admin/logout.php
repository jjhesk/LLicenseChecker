<?php 
include("header.php");
if($_GET['loginhash'] == $loginhash){
session_unset();
session_destroy();
header('location:login.php');
}
else{
header('location:index.php');
}
require_once("footer.php");
?>