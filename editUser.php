<?php
$row = $dbTouch->show_user($_SESSION['manageUserId']);
?>

<div class="container">
	<div class="content">	
		<div class="formContainer">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<label>Name</label>
			<input type="text" name="name" value=<?php echo $row['kayttajaNimi'];?> ><br />
			<label>Password</label>
			<input type="text" name="password" value=<?php echo $row['password'];?>><br />
			<label>Email</label>
			<input type="text" name="email" value=<?php echo $row['email'];?>><br />
			<button type="submit" name ="save" class="btn btn-default">Save changes</button>
			<button type="submit" name ="cancel" class="btn btn-default">Cancel</button>
			</form>
		</div>
	</div>
</div>			
<?php
if (isset($_POST['register']) AND isset($_POST['name']) AND isset($_POST['password'])){
			$kayttajaNimi = $_POST['name'];
			$email = $_POST['email'];
			$salasana = $_POST['password'];
			
			$dbTouch->luo_kayttaja($kayttajaNimi, $email, $salasana); 
}
?>	