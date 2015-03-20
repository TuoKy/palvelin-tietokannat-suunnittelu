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
				<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<label>Otsikko</label>
						<input type="text" name="otsikko"><br/>
					<label>Sisältö</label>	
					<textarea name="newPost" ></textarea>
					<label>Avainsanat (erota pilkulla)</label>
						<input type="text" name="avainsanat"><br/>
					<button type="submit" name ="post" class="btn btn-default">Post</button>
					<button type="submit" name ="cancel" class="btn btn-default">Cancel</button>								
				</form>
			</div>							
		</div>
</div>					
		
</div>
</body>
</html>
<?php
if(isset($_POST['post'])){
if (isset($_POST['otsikko']) AND isset($_POST['newPost'])){	
	
		$otsikko = "<h2>{$_POST['otsikko']}</h2>";
		
			$dbTouch = new Tietokanta();
			$dbTouch->luo_postaus($otsikko, $_POST['newPost'], $_SESSION['username']); 
}
else
 echo "Ei oikeuksia / virhe";
 }
?>	
