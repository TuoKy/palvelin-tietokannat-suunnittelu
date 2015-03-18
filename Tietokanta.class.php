<?php

class Tietokanta {
    private $stmt;
	private $db;
	
    function __construct() {
		try {
			//require_once ("/home/H3543/db-init.php");
			require_once ("../palvelin/myslijuttu/hurhur.php");
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		} catch(PDOException $ex) {
			echo "ErrMsg to enduser!<hr>\n";
			echo "CatchErrMsg: " . $ex->getMessage() . "<hr>\n";
		}
	}
		
    function __destruct() {
		
    }
	
	public function kirjaudu_sisaan($kayttajaNimi, $salasana) {
		$stmt = $db->prepare("SELECT kayttajaNimi FROM Kayttaja WHERE kayttajaNimi = ? AND salasana = ?");
		$stmt->execute(array($kayttajaNimi, $salasana));
		
		if ($stmt->rowCount() == 1) {
			return true;
		} else {
			return false;
		}
    }
	
	
	public function luo_kayttaja($kayttajaNimi, $email, $salasana) {
		$stmt = $db->prepare("SELECT kayttajaNimi FROM Kayttaja WHERE kayttajaNimi = ?");
		$stmt->execute(array($kayttajaNimi));
		
		$date = date('Y-m-d H:i:s');
		
		if ($stmt->rowCount() == 1) {
			return false;
		} else {
			$stmt = $db->prepare("INSERT INTO Kayttaja VALUES(?,?,?,?)");
			$stmt->execute(array($kayttajaNimi, $email, $salasana, $date));

			return true;
		}
    }
	
	public function vaihda_salasana($kayttajaNimi, $vanhaSalasana, $uusiSalasana) {
		$stmt = $db->prepare("SELECT kayttajaNimi FROM Kayttaja WHERE kayttajaNimi = ? AND salasana = ?");
		$stmt->execute(array($kayttajaNimi, $vanhaSalasana));
		
		if ($stmt->rowCount() == 1) {
			$stmt = $db->prepare("UPDATE Kayttaja SET salasana=? WHERE kayttajaNimi=?");
			$stmt->execute(array($uusiSalasana, $kayttajaNimi));
			
			return true;
		} else {
			return false;
		}
    } 

	//KESKEN
    public function muokkaa_kayttaja($kayttajaNimi, $email) {
		$stmt = $db->prepare("UPDATE Kayttaja SET email=? WHERE kayttajaNimi=?");
		$stmt->execute(array($email, $kayttajaNimi));
    } 
}?>