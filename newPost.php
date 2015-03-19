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
						<div class="row-fluid">							
							<div id="wysiwygEditor">
								<div>
									<textarea class="input-xlarge" name="editor" id="editor" style="width: 100%; height: 200px; outline: none;"></textarea>
								</div>
								<div style="margin-top: 20px;">
									<button type="submit" name ="post" class="btn btn-default">Post</button>
									<button type="submit" name ="cancel" class="btn btn-default">Cancel</button>
								</div>
				</form>
							</div>
							

						</div>
			</div>					
		</div>
</div>
</body>
</html>

