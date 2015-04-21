<?php
@$editedPrivileges = $dbTouch->oikeudet($_SESSION['manageUserId']);

if (isset($_POST['save'])){
			$kayttajaNimi = $_POST['name'];
			$email = $_POST['email'];
			$salasana = $_POST['password'];
			
			foreach($allPrivileges as $key => $value) {
				$checkedBoxes = $_POST['privilegeBox'];
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
			// Päivitetään sähköposti ja salasana käyttäjän tietoihin
			$dbTouch->muokkaa_kayttaja($kayttajaNimi, $email, $salasana);
            
            // Tarkasta uudelleen käyttäjän oikeudet muutosten jälkeen
            @$editedPrivileges = $dbTouch->oikeudet($_SESSION['manageUserId']);
}
else if (isset($_POST['cancel'])){
    header('Location: index.php?page=showUsers');
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
			<input type="text" name="password" value=<?php echo $row['salasana'];?>><br />
			<label>Email</label>
			<input type="email" name="email" value=<?php echo $row['email'];?>><br />
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
