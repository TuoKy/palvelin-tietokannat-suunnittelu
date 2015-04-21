<?php
@$row = $dbTouch->show_user($_SESSION['manageUserId']);
?>

<div class="container">
	<div class="content">	
		<div class="formContainer">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<label>Name</label>
			<input type="text" name="name" maxlength="20"><br />
			<label>Password</label>
			<input type="text" name="password" maxlength="32"><br />
			<label>Email</label>
			<input type="text" name="email" maxlength="32"><br />
			<button type="submit" name ="register" class="btn btn-default">Register</button>
			<button type="submit" name ="cancel" class="btn btn-default">Cancel</button>
			</form>
		</div>
	</div>
</div>			
<?php
if (isset($_POST['register']) AND isset($_POST['name']) AND isset($_POST['password'])){
			$kayttajaNimi = htmlentities($_POST['name']);
			$email = htmlentities($_POST['email']);
			$salasana = htmlentities($_POST['password']);
			
			$dbTouch->luo_kayttaja($kayttajaNimi, $email, $salasana); 
}
?>	