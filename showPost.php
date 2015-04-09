<div class="container">		
	<?php
	
		$tiedot = $dbTouch->showPost($_GET['post']);			
		foreach($tiedot as $plaa){
			echo "<div class='content'>";
			echo "<a href='index.php?page=showPost&post={$plaa['idPostaus']}'>{$plaa['otsikko']}</a>";
			echo "{$plaa['sisalto']}  Kirjoittaja:{$plaa['idKayttaja']} <br> Luotu: {$plaa['luontiAika']}<br> Muokattu: {$plaa['muokattu']}";
			echo "<span class='right'><button type='button' class='btn btn-default' name='comment'>Kommentoi</button></span><br>";
			echo "</div>";
		}
		
		if(isset($_POST['comment'])){		
		include("newComment.php");		
		}			
				
		 //Kommenttien listaus
		include("listComments.php");	
	?>					
</div>