<?php
require_once ("Bcrypt.class.php");

try {

	require_once ("/home/H3543/db-init-harkkatyo.php");
	//require_once ("../palvelin/myslijuttu/hurhur2.php");
	//require_once ("../php-dbconfig/db-init.php");			
	
    $bcrypt = new Bcrypt(15);
          
	$db = new PDO('mysql:host=mysql.labranet.jamk.fi;dbname='. DB_NAME .';charset=utf8', USER_NAME, PASSWORD);
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $ex) {
	echo "ErrMsg to enduser!<hr>\n";
	echo "CatchErrMsg: " . $ex->getMessage() . "<hr>\n";
}


$stmt = $db->query("SELECT * FROM Kayttaja;");
$temp = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($temp as $row) {
    $salasana_hash = $bcrypt->hash($row['salasana']);
    var_dump($salasana_hash);
    var_dump($row);
    
    $stmt = $db->prepare("UPDATE Kayttaja SET salasana=? WHERE idKayttaja=?");
	$stmt->execute(array($salasana_hash, $row['idKayttaja']));
}