<?php
if (isset($_POST['edit'])) {
	$_SESSION['manageUserId'] = $_POST['edit'];
    header('index.php?page=editUser');
	
} elseif (isset($_POST['delete'])) {
    $dbTouch->deleteUser($_POST['delete']);
	
} elseif (isset($_POST['info'])) {
    $_SESSION['manageUserId'] = $_POST['info'];
	header('index.php?page=userInfo');
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
				foreach($tiedot as $plaa)
				{
				echo "
				<form id='form' method='post' action='index.php?page=showUsers'>
				<tr>
					<td> {$plaa['idKayttaja']} </td>
					<td> {$plaa['kayttajaNimi']} </td>
					<td> {$plaa['postausten_lukumaara']} </td>
					<td> {$plaa['kommenttiLkm']} </td>
					<td>
						<button type='submit' name ='edit' value={$plaa['idKayttaja']} class='btn btn-default'>Edit</button>
						<button type='submit' name ='delete' value={$plaa['idKayttaja']} class='btn btn-default'>Delete</button>
						<button type='submit' name ='info' value={$plaa['idKayttaja']} class='btn btn-default'>Info</button>
					</td>
				</tr>
				</form>";								
				}			
			?>
			</table>
		</div>		
		</div>		
</div>

