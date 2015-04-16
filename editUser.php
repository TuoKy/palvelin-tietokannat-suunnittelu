<?php
$row = $dbTouch->show_user($_SESSION['manageUserId']);
@$editedPrivileges = $dbTouch->oikeudet($_SESSION['manageUserId']);
?>

<div class="container">
	<div class="content">
		<div class="formContainer">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<label>Name</label>
			<input type="text" name="name" value=<?php echo $row['kayttajaNimi'];?> ><br />
			<label>Password</label>
			<input type="text" name="password" value=<?php echo $row['salasana'];?>><br />
			<label>Email</label>
			<input type="text" name="email" value=<?php echo $row['email'];?>><br />
			
			<input type="checkbox" name="privilegeBox" value="Admin" <?php if(isset($editedPrivileges['Admin'])) echo "checked='checked'"; ?>  />Admin<br />
			<input type="checkbox" name="privilegeBox" value="User" <?php if(isset($editedPrivileges['User'])) echo "checked='checked'"; ?>  />User<br />
			<input type="checkbox" name="privilegeBox" value="Guest" <?php if(isset($editedPrivileges['Guest'])) echo "checked='checked'"; ?>  />Guest<br />

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