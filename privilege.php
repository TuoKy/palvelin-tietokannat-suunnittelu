<?php
$allPrivileges = array(
	'Guest' => '1',
	'User' => '2',
	'Admin' => '3'
);

$requiredPrivileges = array(
    //Admin tason oikeuksia tarvitaan näillä sivuilla
	'showUsers' => 'Admin',
    'editUser' => 'Admin',
    'editPost' => 'Admin',
	'editComment' => 'Admin',
    'manageComments' => 'Admin',
    'managePosts' => 'Admin',
    'userInfo' => 'Admin',
    
    //Käyttäjä tason oikeuksia tarvitaan näillä sivuilla
	'newPost' => 'User',
    
    //Näillä sivuilla ei tarvita oikeuksia
    'listPosts' => 'Free',
    'register' => 'Free',
    'showPost' => 'Free',
	
	'editMyInfo' => 'Any',
    
);
//permissions are as follows:
//1 = Guest (can comment)
//2 = User (can create posts)
//3 = Admin
@$yourPrivileges = $dbTouch->oikeudet($_SESSION['idKayttaja']);
include("navbar.php");

if(isset($_GET['page'])) {
    if(isset($requiredPrivileges[$_GET['page']])) {
        @$page = $_GET['page'];
    }
}

if (!empty($page) && (($requiredPrivileges[$page] == 'Free') || isset($yourPrivileges[$requiredPrivileges[$page]]) || ($requiredPrivileges[$page] == 'Any' && !empty($yourPrivileges)))) {
	$page .= '.php';
	include($page);
}
else {
	include('listPosts.php');
}