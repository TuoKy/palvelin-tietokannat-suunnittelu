<div class="container">		
	<?php
		$_SESSION['postId']=$_GET['post'];
		$tiedot = $dbTouch->showPost($_GET['post']);			
		foreach($tiedot as $plaa){
			echo "<div class='content'>";
			echo "<a href='index.php?page=showPost&post={$plaa['idPostaus']}'>{$plaa['otsikko']}</a>";
			echo "{$plaa['sisalto']}  Kirjoittaja:{$plaa['idKayttaja']} <br> Luotu: {$plaa['luontiAika']}<br> Muokattu: {$plaa['muokattu']}";
			echo "<span class='right'><button type='button' class='btn btn-default' data-toggle='collapse' data-target='#comment'>Kommentoi</button></span><br>";
			echo "</div>";
		}
		$comment=0;
	?>
		<div id="comment" class="collapse">
			<div class="content">			
			<form method="post" action="newComment.php?comment=<?php echo $comment['idKommentti']?>">
			<label>Otsikko</label>
				<input type="text" name="otsikko"> <br/>
			<label>Sisältö</label>	
				<textarea name="newComment" class="Comment" >  </textarea>
				<input type="hidden" name="idKommentti" value="<?php echo $comment['idKommentti'] ?>">
					<button type="submit" name ="post" class="btn btn-default">Post</button>								
			</form>					
			</div>	
		</div>			
	<?php			
		 //Kommenttien listaus
	require_once ("Threaded_comments.Class.php");
	$tiedot = $dbTouch->listComments($_GET['post']);			
	
	$threaded_comments = new Threaded_comments($tiedot);  
  
	$threaded_comments->print_comments();  	
	?>					
</div>