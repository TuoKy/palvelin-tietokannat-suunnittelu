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
						<input type="text" name="otsikko"><br />
					<label>Sisältö</label>	
					<textarea name="newPost" ></textarea>					
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
require_once ("Tietokanta.class.php");
if($_SESSION['username'] == "admin" AND isset($_POST['post'])){
if (isset($_POST['otsikko']) AND isset($_POST['newPost'])){			
			$dbTouch = new Tietokanta();
			$dbTouch->luo_postaus($_POST['otsikko'], $_POST['newPost'], $_SESSION['username']); 
}
else
 echo "haistavittu";
 }
?>	
