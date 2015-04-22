<?php
if (isset($_POST['edit'])) {
	$_SESSION['managePostId'] = $_POST['edit'];
    header("Location: index.php?page=editComment&kommentti={$_POST['edit']}");
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
					$tiedot = $dbTouch->listManageComments();
					foreach($tiedot as $rivi)
					{
						$otsikko = strip_tags($rivi['otsikko']);
						echo "
						<form id='form' method='post' action='index.php?page=manageComments'>
						<tr>
							<td> <a href='index.php?page=showPost&post={$rivi['idPostaus']}'>{$otsikko}</a></td>
							<td> {$rivi['kayttajaNimi']} </td>
							<td> {$rivi['sisalto']} </td>
							<td> {$rivi['luontiAika']} </td>
							<td>
								<button type='submit' name ='edit' value={$rivi['idKommentti']} class='btn btn-default'>Edit</button>
								<button type='submit' name ='delete' value={$rivi['idKommentti']} class='btn btn-default'>Delete</button>
							</td>
						</tr>
						</form>";
					}
				?>
				</table>
			</div>
		</div>
</div>