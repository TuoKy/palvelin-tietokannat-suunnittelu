<?php
if (isset($_POST['edit'])) {
    
} elseif (isset($_POST['delete'])) {
    $dbTouch->deleteUser($_POST['delete']);
} elseif (isset($_POST['info'])) {
    
}
?>
<div class="container">
		<div class="content">
		<div class="table-responsive">
			<table class="table">
			<tr>
			<th>KäyttäjaId</th><th>KayttäjäNimi</th><th>PostaustenMäärä</th><th>KommenttienMäärä</th>
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

