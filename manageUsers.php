<div class="container">
		<div class="content">
		<div class="table-responsive">
			<table class="table">
			<tr>
			<th>K‰ytt‰jaId</th><th>Kaytt‰j‰Nimi</th><th>PostaustenM‰‰r‰</th><th>KommenttienM‰‰r‰</th>
			</tr>
			<?php
				$tiedot = $dbTouch->kayttaja_postaukset();	
				$kommentit = $dbTouch->kayttaja_kommentit();	
				foreach($tiedot as $plaa)
				{
					foreach($kommentit as $boo)
					{
						if($plaa['idKayttaja'] == $boo['idKayttaja']) {
							$kommenttilkm = $boo['kommenttien_lukumaara'];
						}
					}
				echo "
					<form id="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
					<tr>
						<td> {$plaa['idKayttaja']} </td>
						<td> {$plaa['kayttajaNimi']} </td>
						<td> {$plaa['postausten_lukumaara']} </td>
						<td> $kommenttilkm </td>
						<td>
							<button type="submit" name ="edit" value={$plaa['idKayttaja']} class="btn btn-default">Edit</button>
							<button type="submit" name ="delete" value={$plaa['idKayttaja']} class="btn btn-default">Delete</button>
							<button type="submit" name ="info" value={$plaa['idKayttaja']} class="btn btn-default">Info</button>
						</td>
					</tr>
					</form>";
								
				}			
			?>
			</table>
		</div>		
		</div>		
</div>