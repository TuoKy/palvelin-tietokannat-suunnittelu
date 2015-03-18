
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
<?php include("head.txt");?>
</head>
<!--Navbar-->
<?php include("navbar.php");?>
<div class="container">
	<div class="content">	
		<div class="formContainer">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<label>Name</label>
			<input type="text" name="name"><br />
			<label>Password</label>
			<input type="text" name="password"><br />
			<label>Email</label>
			<input type="text" name="email"><br />
			<button type="submit" name ="register" class="btn btn-default">Register</button>
			<button type="submit" name ="cancel" class="btn btn-default">Cancel</button>
			</form>
		</div>
	</div>
</div>			
</html>	
<?php

if (isset($_POST['register']) AND isset($_POST['name']) AND isset($_POST['password'])){
			$kayttajaNimi = $_POST['name'];
			$email = $_POST['email'];
			$salasana = $_POST['password'];
			
			$stmt = $db->prepare("INSERT INTO Kayttaja (kayttajaNimi,email, salasana,liittymisPaiva) VALUES(?,?,?,NOW())");
			$stmt->execute(array($kayttajaNimi, $email, $salasana));
			echo "toimi";
}
?>	