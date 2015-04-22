<?php
if(isset($_POST['cancel'])){
	header("Location: index.php");
}
?>

<?php
@session_start();
?>
<div class="container">
		<div class="content">
			
				<form id="form" method="post" action="index.php?page=newPost">
					<label>Otsikko</label>
						<input type="text" name="otsikko" maxlength="36"> <br/>
					<label>Sisältö</label>	
					<textarea name="newPost" class="Post">  </textarea>
					<label>Avainsanat (erota pilkulla)</label>
					<input type="text" name="avainsanat" maxlength="38"><br/>
					<button type="submit" name ="post" class="btn btn-default">Post</button>
					<button type="submit" name ="cancel" class="btn btn-default">Cancel</button>								
				</form>
			
			<!-- KUVA / KUVAT -->
			<iframe id="form_target" name="form_target" style="display:none"></iframe>
			<form id="my_form" action="index.php?page=newPost" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
			<input name="image" type="file" onchange="$('#my_form').submit(); this.value='';">
			</form>			
		</div>
</div>					
		
<?php
if(isset($_POST['post'])){
	if (isset($_POST['otsikko']) AND $_POST['otsikko'] === ''){ 
	?>
	<script>alert("Otsikko ei saa olla tyhjä!")</script><?php
	}
	else if (isset($_POST['otsikko']) AND isset($_POST['newPost'])){		
			$otsikko = htmlentities($_POST['otsikko']);
			$otsikko = "<h2>$otsikko</h2>";		
			$dbTouch->luo_postaus($otsikko, $_POST['newPost'], $_SESSION['username']); 
		if(isset($_POST['avainsanat']))
		{
			$avainsanat = htmlentities($_POST['avainsanat']);
			$avainsanat = strtolower($avainsanat);
			$sanat = explode(",",$avainsanat);
			foreach($sanat as $plaa){
			$dbTouch->luo_Tagi($plaa);
			$dbTouch->sidoPostiin($plaa);
			}
		}		
	}
}


if(isset($_FILES)){

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



