<!DOCTYPE html>
<html>
<head>
	<title>NewPost</title>
<?php include("head.txt");?>
 
</head>
<!--Navbar-->
<?php include("navbar.php");?>
<div class="container">
		<div class="content">
			<div class="formContainer">
				<form id="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<label>Otsikko</label>
						<input type="text" name="otsikko"> <br/>
					<label>Sisältö</label>	
					<textarea name="newPost" >  </textarea>
					<label>Avainsanat (erota pilkulla)</label>
					<input type="text" name="avainsanat"><br/>
					<button type="submit" name ="post" class="btn btn-default">Post</button>
					<button type="submit" name ="cancel" class="btn btn-default">Cancel</button>								
				</form>
			</div>
			<!-- KUVA / KUVAT -->
			<iframe id="form_target" name="form_target" style="display:none"></iframe>
			<form id="my_form" action="<?php echo $_SERVER['PHP_SELF'];?>" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
			<input name="image" type="file" onchange="$('#my_form').submit(); this.value='';">
			</form>			
		</div>
</div>					
		
</div>
</body>
</html>
<?php
if(isset($_POST['post']) AND $_SESSION['app2_islogged'] == true){
if (isset($_POST['otsikko']) AND isset($_POST['newPost'])){		
		$otsikko = "<h2>{$_POST['otsikko']}</h2>";		
		$dbTouch->luo_postaus($otsikko, $_POST['newPost'], $_SESSION['username']); 
}
else
 echo "Ei oikeuksia / virhe";
 }

if(isset($_FILES)){

$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
@$detectedType = exif_imagetype($_FILES['image']['tmp_name']);
$error = !in_array($detectedType, $allowedTypes);
 
if(!$error){
@$image = $_FILES['image'];
$path = 'Pictures';
$path1 = 'http://student.labranet.jamk.fi/~H3408/palvelin-tietokannat-suunnittelu/'; // tämä pitää muuttaa
$tmpName = $image['tmp_name'];
$ext = array_pop(explode('.',$image['name']));
$name = $image['name'];
move_uploaded_file($tmpName, $path . '/'.$name);
$weburl = $path1.'/Pictures/'.$name;
echo "";
?>	
<script>
top.$('.mce-btn.mce-open').parent().find('.mce-textbox').val('<?php echo $weburl ?> ').closest('.mce-window').find('.mce-primary');
</script>
<?php
}
}
?>



