<div class="container">
		<div class="content">
		<div class="table-responsive">
			<table class="table">
			<tr>
			<th>KäyttäjaId</th><th>KayttäjäNimi</th><th>PostaustenMäärä</th><th>KommenttienMäärä</th>
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

