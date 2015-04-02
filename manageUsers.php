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
				echo "<tr> <td> {$plaa['idKayttaja']} </td> <td> {$plaa['kayttajaNimi']} </td> <td> {$plaa['postausten_lukumaara']} </td> <td> $kommenttilkm </td> </tr>";
								
				}			
			?>
			</table>
		</div>		
		</div>		
</div>