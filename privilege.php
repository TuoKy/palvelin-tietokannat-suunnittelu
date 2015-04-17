<?php
$allPrivileges = array(
	'Guest' => '',
	'User' => '',
	'Admin' => ''
);

$requiredPrivileges = array(
	'showUsers' => 'Admin',
	'newPost' => 'User'
);
//permissions are as follows:
//1 = Guest (can comment)
//2 = User (can create posts)
//3 = Admin
@$yourPrivileges = $dbTouch->oikeudet($_SESSION['idKayttaja']);
include("navbar.php");


@$page = $_GET['page'];
if (!empty($page) && (!isset($requiredPrivileges[$page]) || isset($yourPrivileges[$requiredPrivileges[$page]]))) {
	$page .= '.php';
	include($page);
}
else {
	include('listPosts.php');
}