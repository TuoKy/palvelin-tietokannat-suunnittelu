<div class="container">		
			<?php
				$tiedot = $dbTouch->showPost($_GET['post']);			
				foreach($tiedot as $plaa)
				{
				echo "<div class='content'>";
				echo "<a href='index.php?page=showPost&post={$plaa['idPostaus']}'>{$plaa['otsikko']}</a>";
				echo "{$plaa['sisalto']}  Kirjoittaja:{$plaa['idKayttaja']} <br> Luotu: {$plaa['luontiAika']}<br> Muokattu: {$plaa['muokattu']} ";
				echo "</div>";
				}
			 //Kommenttien listaus
			 include("listComments.php");	
			?>					
</div>