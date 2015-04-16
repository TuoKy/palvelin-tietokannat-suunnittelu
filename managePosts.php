<?php
if (isset($_POST['edit'])) {
	$_SESSION['managePostId'] = $_POST['edit'];
    header("Location: index.php?page=editPost&post={$_POST['edit']}");
}
 elseif (isset($_POST['delete'])) {
    $dbTouch->deletePost($_POST['delete']);
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
								<button type='submit' name ='edit' value={$plaa['idPostaus']} class='btn btn-default'>E</button>
								<button type='submit' name ='delete' value={$plaa['idPostaus']} class='btn btn-default'>D</button>
							</td>
						</tr>
						</form>";
					}
				?>
				</table>
			</div>
		</div>
</div>