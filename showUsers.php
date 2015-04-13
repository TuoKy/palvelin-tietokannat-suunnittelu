<?php
if (isset($_POST['edit'])) {
	$_SESSION['manageUserId'] = $_POST['edit'];
    header("Location: index.php?page=editUser");
	
} elseif (isset($_POST['delete'])) {
    $dbTouch->deleteUser($_POST['delete']);
	
} elseif (isset($_POST['info'])) {
    $_SESSION['manageUserId'] = $_POST['info'];
	header("Location: index.php?page=userInfo");
}
?>
<div class="container">
		<div class="content">
		<div class="table-responsive">
			<table class="table">
			<tr>
			<th>Käyttäjä-Id</th><th>Kayttäjänimi</th><th>Postausten Määrä</th><th>Kommenttien Määrä</th><th>Hallinta</th>
			</tr>
			<?php
				$tiedot = $dbTouch->kayttajatiedot();	
				foreach($tiedot as $rivi)
				{
				echo "
				<form id='form' method='post' action='index.php?page=showUsers'>
				<tr>
					<td> {$rivi['idKayttaja']} </td>
					<td> {$rivi['kayttajaNimi']} </td>
					<td> {$rivi['postausten_lukumaara']} </td>
					<td> {$rivi['kommenttiLkm']} </td>
					<td>
						<button type='submit' name ='edit' value={$rivi['idKayttaja']} class='btn btn-default'>Edit</button>
						<button type='submit' name ='delete' value={$rivi['idKayttaja']} class='btn btn-default'>Delete</button>
						<button type='submit' name ='info' value={$rivi['idKayttaja']} class='btn btn-default'>Info</button>
					</td>
				</tr>
				</form>";								
				}			
			?>
			</table>
		</div>		
		</div>		
</div>

