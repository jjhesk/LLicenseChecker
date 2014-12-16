<?php 
$options = mysql_query("select * from options");
if($optiondata = mysql_fetch_array($options)){
$sitename = $optiondata['site_name'];
$siteurl = $optiondata['site_url'];
$adminemail = $optiondata['admin_email'];
$site_working = $optiondata['site_working'];
$posts_per_page = $optiondata['posts_per_page'];
$show_other_profiles = $optiondata['show_other_profiles'];
$allow_register = $optiondata['allow_register'];
$attachment_folder = $optiondata['attachment_folder'];
$images_folder = $optiondata['images_folder'];
$smtp_host = $optiondata['smtp_host'];
$smtp_port = $optiondata['smtp_port'];
$smtp_secure = $optiondata['smtp_secure'];
$smtp_user = $optiondata['smtp_user'];
$smtp_pass = $optiondata['smtp_pass'];
$msg_footer = $optiondata['msg_footer'];
$fds_per_page = $optiondata['fds_per_page'];
$show_usr_details = $optiondata['show_usr_details'];
$show_posts = $optiondata['show_posts'];
$allow_add_posts = $optiondata['allow_add_posts'];
$verify_email = $optiondata['verify_email'];
$send_admin_notify = $optiondata['send_admin_notify'];
$edit_profile = $optiondata['edit_profile'];
$show_latest_posts = $optiondata['show_latest_posts'];
$latest_posts_num = $optiondata['latest_posts_num'];
}