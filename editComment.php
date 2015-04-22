<?php
if(isset($_POST['cancel'])){
	header("Location: index.php?page=manageComments");
}
?>

<div class="container">
	<div class="content">
		<?php
			$tiedot = $dbTouch->showComment($_GET['kommentti']);
			$otsikkoStripped = strip_tags($tiedot['otsikko']);
			echo "
			<form id='form' method='post' action='index.php?page=editComment&kommentti={$tiedot['idKommentti']}'>
				<label>Otsikko</label>
					<input type='text' name='otsikko' value='{$otsikkoStripped}' maxlength='38'><br/>
				<label>Sisältö</label>	
				<textarea class='Post' name='editComment' >{$tiedot['sisalto']}</textarea>
				<button type='submit' name ='edit' class='btn btn-default'>Edit</button>
				<button type='submit' name ='cancel' class='btn btn-default'>Cancel</button>								
			</form>
			"
		?>
		
		<!-- KUVA / KUVAT -->
		<iframe id="form_target" name="form_target" style="display:none"></iframe>
		<form id="my_form" action="index.php?page=editComment" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
		<input name="image" type="file" onchange="$('#my_form').submit(); this.value='';">
		</form>			
	</div>
</div>		
		
<?php
if(isset($_POST['edit'])){
	if (isset($_POST['otsikko']) AND isset($_POST['editComment'])){
		$otsikko = htmlentities($_POST['otsikko']);
		$otsikko = "<h3>{$_POST['otsikko']}</h3>";
		$dbTouch->edit_comment($_GET['kommentti'], $otsikko, $_POST['editComment']);
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