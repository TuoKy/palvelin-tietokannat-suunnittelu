<!DOCTYPE html>
<html>
<head>
	<title>NewPost</title>
<?php include("head.txt");?>
 <script src="bootstrap-wysiwyg.js.js"></script> 
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
			<script>
			$('#editor').wysiwyg();
			</script>
			    <div class="btn-toolbar" data-role="editor-toolbar"
					data-target="#editor">    
				</div> 
			<button type="submit" name ="register" class="btn btn-default">Register</button>
			<button type="submit" name ="cancel" class="btn btn-default">Cancel</button>
			</form>
		</div>	
				
		</div>
</body>
</html>

