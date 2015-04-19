<div class="container">		
			<?php
			if (isset($_GET['tagi'])){
				$tiedot = $dbTouch->showPostsHasTag($_GET['tagi']);	
				foreach($tiedot as $id)
				{
				$plaa = $dbTouch->showPost($id['idPostaus']);	
				echo "<div class='content'>";
				echo "<a href='index.php?page=showPost&post={$plaa['idPostaus']}'>{$plaa['otsikko']}</a>";
				echo "{$plaa['sisalto']}  Kirjoittaja:{$plaa['idKayttaja']} <br> Luotu: {$plaa['luontiAika']}<br> Muokattu: {$plaa['muokattu']} ";
				echo "</div>";
				}
			}			
			else{
				$tiedot = $dbTouch->showPosts();
				//print_r ($tiedot);	
				foreach($tiedot as $plaa)
				{
				echo "<div class='content'>";
				echo "<a href='index.php?page=showPost&post={$plaa['idPostaus']}'>{$plaa['otsikko']}</a>";
				echo "{$plaa['sisalto']}  Kirjoittaja:{$plaa['idKayttaja']} <br> Luotu: {$plaa['luontiAika']}<br> Muokattu: {$plaa['muokattu']} ";
				echo "</div>";
				}
			}				
			?>					
</div>