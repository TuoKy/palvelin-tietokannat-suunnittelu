<div class="container">		
			<?php
			if (isset($_GET['tagi'])){
			//saa id:t postauksiin jolla tagi
				$tiedot = $dbTouch->showPostsHasTag($_GET['tagi']);	
				foreach($tiedot as $id)
				{
					//haei kaikki data missä id on $id
				$plaa = $dbTouch->showPost($id['idPostaus']);
				$nimi = $dbTouch->haeHenkNimi($plaa['idKayttaja']);				
				echo "<div class='content'>";
				echo "<a href='index.php?page=showPost&post={$plaa['idPostaus']}'>{$plaa['otsikko']}</a>";
				echo "{$plaa['sisalto']}  Kirjoittaja: {$nimi['kayttajaNimi']} <br> Luotu: {$plaa['luontiAika']}<br> Muokattu: {$plaa['muokattu']} ";
				echo "</div>";
				}
			}			
			else{
				$tiedot = $dbTouch->showPosts();
				//print_r ($tiedot);	
				foreach($tiedot as $plaa)
				{
				$nimi = $dbTouch->haeHenkNimi($plaa['idKayttaja']);
				echo "<div class='content'>";
				echo "<a href='index.php?page=showPost&post={$plaa['idPostaus']}'>{$plaa['otsikko']}</a>";
				echo "{$plaa['sisalto']}  Kirjoittaja: {$nimi['kayttajaNimi']} <br> Luotu: {$plaa['luontiAika']}<br> Muokattu: {$plaa['muokattu']} ";
				echo "</div>";
				}
			}				
			?>					
</div>