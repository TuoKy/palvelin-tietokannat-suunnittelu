<?php
@$editedPrivileges = $dbTouch->oikeudet($_SESSION['manageUserId']);

if (isset($_POST['save'])){
	$email = $_POST['email'];
	
	@$checkedBoxes = $_POST['privilegeBox'];
	
	if(!empty($checkedBoxes)) {
		foreach($allPrivileges as $key => $value) {
			//Ensin tarkistetaan onko käyttäjälle lisätty oikeuksia
			if(in_array($key, $checkedBoxes) && !isset($editedPrivileges[$key])) {
				//Insert
				$dbTouch->lisaa_rooli($_SESSION['manageUserId'], $value);
			}//Sitten tarkistetaan onko käyttäjältä poistettu oikeuksia
			else if(!in_array($key, $checkedBoxes) && isset($editedPrivileges[$key])) {
				//Delete
				$dbTouch->poista_rooli($_SESSION['manageUserId'], $value);
			}
		}
	} else { ?>
		<script>alert("Käyttäjällä täytyy olla ainakin yksi oikeus.")</script>
	<?php
	}
	// Päivitetään sähköposti käyttäjän tietoihin
	$dbTouch->muokkaa_kayttaja($_SESSION['manageUserId'], $email);
          
	
          // Tarkasta uudelleen käyttäjän oikeudet muutosten jälkeen
          @$editedPrivileges = $dbTouch->oikeudet($_SESSION['manageUserId']);
}
else if (isset($_POST['cancel'])){
    header('Location: index.php?page=showUsers');
}
else if (isset($_POST['passwordButton'])){
	$salasana = $_POST['password'];
    // Päivitetään salasana käyttäjän tietoihin
	$dbTouch->admin_vaihda_salasana($_SESSION['manageUserId'], $salasana);
}

$row = $dbTouch->show_user($_SESSION['manageUserId']);
?>

<div class="container">
	<div class="content">
		<div class="formContainer">
			<form method="post" action="index.php?page=editUser">
			<label>Name</label>
			<input type="text" name="name" value=<?php echo $row['kayttajaNimi'];?> readonly><br />
			<label>Password</label>
			<input type="text" name="password" maxlength="32"><button type="submit" name ="passwordButton" class="btn btn-default">Change password</button><br />
			<label>Email</label>
			<input type="email" name="email" value=<?php echo $row['email'];?> maxlength="32"><br />
			<?php
			foreach($allPrivileges as $key => $value) { ?>
				<label><?php echo $key; ?><input type="checkbox" name="privilegeBox[]" value="<?php echo $key; ?>" <?php if(isset($editedPrivileges[$key])) echo "checked='checked'"; ?>/></label>
			<?php
			}
			?>
			<br>
			<button type="submit" name ="save" class="btn btn-default">Save changes</button>
			<button type="submit" name ="cancel" class="btn btn-default">Cancel</button>
			</form>
		</div>
	</div>
</div>			
