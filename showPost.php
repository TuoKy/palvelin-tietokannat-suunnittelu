<div class="container">		
	<?php
		$_SESSION['postId']=$_GET['post'];
		$rivi = $dbTouch->showPost($_GET['post']);		
		echo "<div class='content'>";
		echo "<a href='index.php?page=showPost&post={$rivi['idPostaus']}'>{$rivi['otsikko']}</a>";
		echo "{$rivi['sisalto']}  Kirjoittaja:{$rivi['idKayttaja']} <br> Luotu: {$rivi['luontiAika']}<br> Muokattu: {$rivi['muokattu']}";
		if (@$_SESSION['app2_islogged'] != false) echo "<span class='right'><button type='button' class='btn btn-default' data-toggle='collapse' data-target='#comment'>Kommentoi</button></span><br>";
		echo "</div>";
			
		$comment=0;
	?>

		<div id="comment" class="collapse">
			<div class="content">			
			<form method="post" action="newComment.php?comment=<?php echo $comment['idKommentti']?>">
			<label>Otsikko</label>
				<input type="text" maxlength="36" name="otsikko" required> <br/>
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
	$tiedot = $dbTouch->listComments1($_GET['post']);			
	
	$threaded_comments = new Threaded_comments($tiedot);  
  
	$threaded_comments->print_comments();  	
	?>					
</div>