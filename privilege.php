<?php
$requiredPrivileges = array(
	'ShowUsers' => '3',
	'newPost' => '2'
);
//privileges are as follows:
//1 = user can comment
//2 = user can make posts
//3 = user is admin

$yourPrivileges = array('2' => '', '3' => '');

include("navbar.php");


@$page = $_GET['page'];
if (!empty($page)) {
	$page .= '.php';
	include($page);
}
else {
	include('listPosts.php');
}