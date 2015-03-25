<div class="container">
		<div class="content">
		<div class="table-responsive">
			<table class="table">
			<tr>
			<th>KäyttäjaId</th><th>KayttäjäNimi</th><th>PostaustenMäärä</th><th>KommenttienMäärä</th>
			</tr>
			<?php
				$tiedot = $dbTouch->kayttaja_tiedot();
				//print_r ($tiedot);			
				foreach($tiedot as $plaa)
				{
				echo "<tr> <td> {$plaa['idKayttaja']} </td> <td> {$plaa['kayttajaNimi']} </td> <td> {$plaa['postausten_lukumaara']} </td> <td> {$plaa['kommenttien_lukumaara']} </td> </tr>";
				}			
			?>
			</table>
		</div>		
		</div>		
</div>

