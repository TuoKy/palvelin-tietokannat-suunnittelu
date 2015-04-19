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
			<?php
			foreach($allPrivileges as $key => $value) { ?>
				<input type="checkbox" name="privilegeBox[]" value="<?php echo $key; ?>" <?php if(isset($editedPrivileges[$key])) echo "checked='checked'"; ?>  /><?php echo $key; ?><br />
			<?php
			}
			?>

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
			
			foreach($allPrivileges as $key => $value) {
				$checkedBoxes = $_POST['privilegeBox'];
				//Ensin tarkistetaan onko käyttäjälle lisätty oikeuksia
				if(in_array($key, $checkedBoxes) && !isset($editedPrivileges[$key])) {
					//Insert
					$dbTouch->lisaa_rooli($_SESSION['manageUserId'], $key);
				}//Sitten tarkistetaan onko käyttäjältä poistettu oikeuksia
				else if(!in_array($key, $checkedBoxes) && isset($editedPrivileges[$key])) {
					//Delete
					$dbTouch->poista_rooli($_SESSION['manageUserId'], $key);
				}
			}
			
			$dbTouch->luo_kayttaja($kayttajaNimi, $email, $salasana); 
}
?>	