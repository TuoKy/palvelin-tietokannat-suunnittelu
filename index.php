<!DOCTYPE html>
<html>
<head>
	<title>Testiblogi</title>
<?php include("head.txt");?>
</head>

<body>
	<!--Navbar-->
	 <?php include("navbar.php");?>

	<?php
	@$page = $_GET['page'];
	if (!empty($page)) {
		$page .= '.php';
		include($page);
	}
	else {
		include('listPosts.php');
	}
	?>	
</body>
</html>