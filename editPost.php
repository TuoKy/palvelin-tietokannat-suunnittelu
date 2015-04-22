<?php
if(isset($_POST['cancel'])){
	header("Location: index.php?page=managePosts");
}
?>

<div class="container">
	<div class="content">
		<?php
			$tiedot = $dbTouch->showPost($_GET['postaus']);
			$otsikkoStripped = strip_tags($tiedot['otsikko']);
			$tags = $dbTouch->listTags($_GET['postaus']);
			$tagline = '';
			foreach($tags as $single_tag) {
				if($tagline != '') {
					$tagline .= ",".$single_tag['tagiNimi'];
				} 
				else {
					$tagline .= $single_tag['tagiNimi'];
				}
			}
			echo "
			<form id='form' method='post' action='index.php?page=editPost&postaus={$tiedot['idPostaus']}'>
				<label>Otsikko</label>
					<input type='text' name='otsikko' value='{$otsikkoStripped}' maxlength='38'><br/>
				<label>Sisältö</label>	
				<textarea class='Post' name='editPost' >{$tiedot['sisalto']}</textarea>
				<label>Avainsanat (erota pilkulla)</label>
				<input type='text' name='avainsanat' maxlength='36' value='{$tagline}'><br/>
				<button type='submit' name ='edit' class='btn btn-default'>Edit</button>
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
if(isset($_POST['edit'])){
	if (isset($_POST['otsikko']) AND $_POST['otsikko'] === ''){ 
		?>
		<script>alert("Otsikko ei saa olla tyhjä!")</script><?php
		}
	else if (isset($_POST['otsikko']) AND isset($_POST['editPost'])){
			$otsikko = htmlentities($_POST['otsikko']);
			$otsikko = "<h2>{$_POST['otsikko']}</h2>";
			$dbTouch->edit_post($_GET['postaus'], $otsikko, $_POST['editPost']);
			if(isset($_POST['avainsanat']))
			{
			$tiedot = $dbTouch->showEsiintymaTagit($_GET['postaus']);
			$dbTouch->deleteEsiintyma($_GET['postaus']);
			$esiTiedot = $dbTouch->showEsiintyma();
			$bool = false;
			foreach($tiedot as $tagiRivi){
				foreach($esiTiedot as $esiRivi){
					if($tagiRivi['idTagi'] === $esiRivi['idTagi']){
						$bool = true;
					}
				}
				if($bool != true)
				{
					$dbTouch->deleteTag($tagiRivi['idTagi']);
				}
				$bool = false;
			}
	
			$avainsanat = htmlentities($_POST['avainsanat']);
			$sanat = explode(",",$avainsanat);
			foreach($sanat as $rivi)
			{	
				$dbTouch->luo_Tagi($rivi);
				$dbTouch->sidoMuokattuunPostiin($rivi, $_GET['postaus']);
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