<?php

if (isset($_POST['save'])){
			$email = $_POST['email'];
			
			// Päivitetään sähköposti käyttäjän tietoihin
			$dbTouch->muokkaa_kayttaja($_SESSION['idKayttaja'], $email);
			
}
else if (isset($_POST['cancel'])){
    header('Location: index.php');
}
else if (isset($_POST['passwordButton'])){
	$oldPassword = $_POST['oldPassword'];
	$newPassword = $_POST['newPassword'];
    // Päivitetään salasana käyttäjän tietoihin
	if(!$dbTouch->vaihda_salasana($_SESSION['idKayttaja'], $oldPassword, $newPassword)) {
	?>
		<script>alert("Vanha salasana väärin!")</script>
	<?php
	}
}

$row = $dbTouch->show_user($_SESSION['idKayttaja']);
?>

<div class="container">
	<div class="content">
		<div class="formContainer">
			<form method="post" action="index.php?page=editMyInfo">
			<label>Name</label>
			<input type="text" name="name" value=<?php echo $row['kayttajaNimi'];?> readonly><br />
			<label>Email</label>
			<input type="email" name="email" value=<?php echo $row['email'];?> maxlength="32" required><br />
			<br>
			<button type="submit" name ="save" class="btn btn-default">Save changes</button>
			<button type="submit" name ="cancel" class="btn btn-default">Cancel</button>
		</div>
	</div>
	<div class="content">
		<div class="formContainer">
			<label>Old Password</label>
			<input type="text" name="oldPassword" maxlength="32">
			<label>New Password</label>
			<input type="text" name="newPassword" maxlength="32">
			<button type="submit" name ="passwordButton" class="btn btn-default">Change password</button><br />
			</form>
		</div>
	</div>
</div>		