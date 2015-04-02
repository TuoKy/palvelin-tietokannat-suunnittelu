<?php
session_start();
$_SESSION['app2_islogged'] = FALSE;
unset($_SESSION['tunnus']);
unset($_SESSION['username']);
unset($_SESSION['idKayttaja']);
header('refresh:0; index.php');
?>