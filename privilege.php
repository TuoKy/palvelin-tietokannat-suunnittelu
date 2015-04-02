<?php
$requiredPrivileges = array(
	'showUsers' => '3',
	'newPost' => '2'
);
//privileges are as follows:
//1 = user can comment
//2 = user can make posts
//3 = user is admin

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