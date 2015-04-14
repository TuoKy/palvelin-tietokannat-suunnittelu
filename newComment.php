<?php
require_once ("Tietokanta.class.php");
session_start();

$dbTouch = new Tietokanta();

if(isset($_POST['post']) AND $_SESSION['app2_islogged'] == true){
if (isset($_POST['otsikko']) AND isset($_POST['newComment'])){		
		$otsikko = "<h3>{$_POST['otsikko']}</h3>";		
		$dbTouch->luo_kommentti($otsikko, $_POST['newComment'], $_SESSION['username'], $_SESSION['postId'], $_POST['idKommentti']); 
}
header("Location: index.php?page=showPost&post={$_SESSION['postId']}");
}
else if (isset($_POST['post']) AND $_SESSION['app2_islogged'] == false)
	 echo "Ei oikeuksia / virhe";
?>