<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
<?php include("head.txt");?>
</head>

<body>
	<!--Navbar-->
	 <?php include("navbar.php");?>
	<div class="container">
		<div class="content">
		<?php
			$tiedot = $dbTouch->kayttaja_tiedot();
			print_r ($tiedot);
			/*
			echo "<Table>";
			foreach($tiedot as $plaa)
			{
			echo "<tr> <td> {$plaa['idKayttaja']} </td> <td> {$plaa['kayttajaNimi']} </td> <td> {$plaa['postausten_lukumaara']} </td> </tr>";
			}
			echo "</table>";
			*/
		?>
		
		</div>		
	</div>
	 
</body>
</html>	 
