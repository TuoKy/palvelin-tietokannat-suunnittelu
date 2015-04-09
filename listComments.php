<?php
	require_once ("Threaded_comments.Class.php");
	$tiedot = $dbTouch->listComments($_GET['post']);			
	
	$threaded_comments = new Threaded_comments($tiedot);  
  
	$threaded_comments->print_comments();  
		
?>					
