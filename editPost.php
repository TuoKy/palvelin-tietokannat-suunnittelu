<div class="container">
	<div class="content">
		<?php
			$tiedot = $dbTouch->showPost($_GET['post']);
			$otsikko = strip_tags($tiedot['otsikko']);
			echo "
			<form id='form' method='postaus' action='index.php?page=editPost'>
				<label>Otsikko</label>
					<input type='text' name='otsikko' value='{$otsikko}'><br/>
				<label>Sisältö</label>	
				<textarea class='Post' name='editPost' >{$tiedot['sisalto']}</textarea>
				<label>Avainsanat (erota pilkulla)</label>
				<input type='text' name='avainsanat'><br/>
				<button type='submit' name ='postaus' class='btn btn-default'>Edit</button>
				<button type='submit' name ='cancel' class='btn btn-default'>Cancel</button>								
			</form>
			"
		?>
		
		<!-- KUVA / KUVAT -->
		<iframe id="form_target" name="form_target" style="display:none"></iframe>
		<form id="my_form" action="index.php?page=editPost" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
		<input name="image" type="file" onchange="$('#my_form').submit(); this.value='';">
		</form>			
	</div>
</div>		
		
<?php
if(isset($_POST['postaus']) AND $_SESSION['app2_islogged'] == true){
if (isset($_POST['otsikko']) AND isset($_POST['editPost'])){		
		$otsikko = "<h2>{$_POST['otsikko']}</h2>";		
		$dbTouch->edit_post($_GET['post'], $otsikko, $_POST['editPost']);
}
else
 echo "Ei oikeuksia / virhe";
}
else if (isset($_POST['postaus']) AND $_SESSION['app2_islogged'] == false)
	 echo "Ei oikeuksia / virhe";

if(isset($_FILES) AND $_SESSION['app2_islogged'] == true){

$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
@$detectedType = exif_imagetype($_FILES['image']['tmp_name']);
$error = !in_array($detectedType, $allowedTypes);
 
	if(!$error){
		$path = 'pictures/';
		$path1 = 'http://student.labranet.jamk.fi/~H3408/palvelin-tietokannat-suunnittelu/'; // tämä pitää muuttaa
		@$image = $_FILES['image'];
		$name = $image['name'];
		move_uploaded_file($_FILES['image']['tmp_name'], $path.$name); 
		$weburl = $path1. $path .$name;
		?>	
		<script>
		top.$('.mce-btn.mce-open').parent().find('.mce-textbox').val('<?php echo $weburl ?> ').closest('.mce-window').find('.mce-primary');
		</script>
		<?php		
	}
}
?>