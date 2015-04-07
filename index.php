<?php
require_once ("Tietokanta.class.php");
session_start();

$dbTouch = new Tietokanta();

if (isset($_POST['signIn']) AND isset($_POST['username']) AND isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];	

	if ($idKayttaja = $dbTouch->kirjaudu_sisaan($username,$password)) {	
		$_SESSION['app2_islogged'] = true;
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['idKayttaja'] = $idKayttaja;
	}
	else{
		?>
		<script>
		alert("Wrong userName or Password");	
		</script>
<?php	
	}	
}
else if (isset($_POST['register']))
	$_GET['page']='register'; 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Testiblogi</title>
<?php include("head.txt");?>
</head>

<body>
	<!--Navbar-->
	 <?php include("privilege.php");?>
	
</body>
</html>