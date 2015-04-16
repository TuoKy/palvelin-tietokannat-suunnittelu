<?php
if (isset($_POST['edit'])) {
	$_SESSION['managePostId'] = $_POST['edit'];
    header("Location: index.php?page=editComment");
}
 elseif (isset($_POST['delete'])) {
    $dbTouch->deleteComment($_POST['delete']);
}
?>
<div class="container">
		<div class="content">
			<div class="table-responsive">
				<table class="table">
				<tr>
				<th>Otsikko</th><th>Kommentoija</th><th>Kommentti</th><th>Päivämäärä</th><th>Hallinta</th>
				</tr>
				<?php
					$tiedot = $dbTouch->listComments();
					foreach($tiedot as $plaa)
					{
						$otsikko = strip_tags($plaa['otsikko']);
						echo "
						<form id='form' method='post' action='index.php?page=manageComments'>
						<tr>
							<td> {$otsikko} </td>
							<td> {$plaa['idKayttaja']} </td>
							<td> {$plaa['sisalto']} </td>
							<td> {$plaa['luontiAika']} </td>
							<td>
								<button type='submit' name ='edit' value={$plaa['idKommentti']} class='btn btn-default'>E</button>
								<button type='submit' name ='delete' value={$plaa['idKommentti']} class='btn btn-default'>D</button>
							</td>
						</tr>
						</form>";
					}
				?>
				</table>
			</div>
		</div>
</div>