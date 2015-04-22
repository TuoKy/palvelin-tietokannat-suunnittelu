<?php
if (isset($_POST['edit'])) {
	$_SESSION['managePostId'] = $_POST['edit'];
    header("Location: index.php?page=editPost&postaus={$_POST['edit']}");
}
 elseif (isset($_POST['delete'])) {
	
	$tiedot = $dbTouch->showEsiintymaTagit($_POST['delete']);
    $dbTouch->deletePost($_POST['delete']);
	$esiTiedot = $dbTouch->showEsiintyma();
	
	$bool = false;
	foreach($tiedot as $rivi){
		foreach($esiTiedot as $esiRivi){
			if($rivi['idTagi'] === $esiRivi['idTagi']){
				$bool = true;
			}
		}
		if($bool != true)
		{
			$dbTouch->deleteTag($rivi['idTagi']);
		}
		$bool = false;
	}
}
?>
<div class="container">
		<div class="content">
			<div class="table-responsive">
				<table class="table">
				<tr>
				<th>Otsikko</th><th>Postaaja</th><th>Kommentit</th><th>Päivämäärä</th><th>Hallinta</th>
				</tr>
				<?php
					$tiedot = $dbTouch->post_comments();
					foreach($tiedot as $plaa)
					{
						$otsikko = strip_tags($plaa['otsikko']);
						echo "
						<form id='form' method='post' action='index.php?page=managePosts'>
						<tr>
							<td> <a href='index.php?page=showPost&post={$plaa['idPostaus']}'>{$otsikko}</a> </td>
							<td> {$plaa['kayttajaNimi']} </td>
							<td> {$plaa['kommenttien_lukumaara']} </td>
							<td> {$plaa['luontiAika']} </td>
							<td>
								<button type='submit' name ='edit' value={$plaa['idPostaus']} class='btn btn-default'>Edit</button>
								<button type='submit' name ='delete' value={$plaa['idPostaus']} class='btn btn-default'>Delete</button>
							</td>
						</tr>
						</form>";
					}
				?>
				</table>
			</div>
		</div>
</div>