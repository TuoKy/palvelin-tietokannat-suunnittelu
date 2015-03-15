<?php
session_start();
$_SESSION['app2_islogged'] = FALSE;
unset($_SESSION['tunnus']);
header('refresh:0; index.php');
?>