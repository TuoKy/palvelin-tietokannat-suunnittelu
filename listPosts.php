<div class="container">
		
			<?php
				$tiedot = $dbTouch->showPosts();
				//print_r ($tiedot);	
				foreach($tiedot as $plaa)
				{
				echo "<div class='content'>";
				echo "{$plaa['otsikko']} {$plaa['sisalto']}  Kirjoittaja:{$plaa['idKayttaja']} <br> Luotu: {$plaa['luontiAika']}<br> Muokattu: {$plaa['muokattu']} ";
				echo "</div>";
				}	
			?>	
				
</div>