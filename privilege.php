<?php
$allPrivileges = array(
	'Guest' => '1',
	'User' => '2',
	'Admin' => '3'
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
	if (!in_array($page, array('index', 'privilege'))){ //tähän voi määritellä mitä sivuja ei voi olla page= kohdassa, tämä sen takia, että sivu räjähti jos sinne laittoi esim. page=index
	$page .= '.php';
	include($page);
	}
}
else {
	include('listPosts.php');
}