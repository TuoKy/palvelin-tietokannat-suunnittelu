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
	@$page = $_GET['page'];	/* gets the variable $page */
	if (!empty($page)) {
		$page .= '.php';
		include($page);
	} 			/* if $page has a value, include it */
	else {
		include('list.php');
	} 	/* otherwise, include the default page */
	?>	
</body>
</html>