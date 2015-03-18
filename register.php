<?php 
// IS WORK IN PROGRESS
require_once ("../palvelin/myslijuttu/hurhur.php"); // kytän tietokanta avaus juttu

session_start();

?>
<head>
	<title>Register</title>
<?php include("head.txt");?>
</head>
<!--Navbar-->
<?php include("navbar.php");?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"
style=color:#000;background-color:#eeeeee>
Tunnus:<br><input type="text" name="tunnus" size="30"><br>
Salasana:<br><input type="text" name="salasana" size="30"><br>
<input type='submit' name='action' value='Kirjaudu'>
<br>
</form>