<?php

class Tietokanta {
    //private $stmt;
	private $db;
	
    function __construct() {
		try {
			//require_once ("/home/H3543/db-init-harkkatyo.php");
			require_once ("../palvelin/myslijuttu/hurhur2.php");
			//require_once ("../php-dbconfig/db-init.php");
			
			$this->db = new PDO('mysql:host=mysql.labranet.jamk.fi;dbname='. DB_NAME .';charset=utf8', USER_NAME, PASSWORD);
			
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
		$stmt = $this->db->prepare("SELECT kayttajaNimi FROM Kayttaja WHERE kayttajaNimi = ? AND salasana = ?");
		$stmt->execute(array($kayttajaNimi, $salasana));
		
		if ($stmt->rowCount() == 1) {
			return true;
		} else {
			return false;
		}
    }
	
	
	public function luo_kayttaja($kayttajaNimi, $email, $salasana) {
		$stmt = $this->db->prepare("SELECT kayttajaNimi FROM Kayttaja WHERE kayttajaNimi = ?");
		$stmt->execute(array($kayttajaNimi));
		
		if ($stmt->rowCount() == 1) {
			return false;
		} else {
			$stmt = $this->db->prepare("INSERT INTO Kayttaja (kayttajaNimi, email, salasana, liittymisPaiva) VALUES(?,?,?,NOW())");
			$stmt->execute(array($kayttajaNimi, $email, $salasana));

			return true;
		}
    }
	
	public function vaihda_salasana($kayttajaNimi, $vanhaSalasana, $uusiSalasana) {
		$stmt = $this->db->prepare("SELECT kayttajaNimi FROM Kayttaja WHERE kayttajaNimi = ? AND salasana = ?");
		$stmt->execute(array($kayttajaNimi, $vanhaSalasana));
		
		if ($stmt->rowCount() == 1) {
			$stmt = $this->db->prepare("UPDATE Kayttaja SET salasana=? WHERE kayttajaNimi=?");
			$stmt->execute(array($uusiSalasana, $kayttajaNimi));
			
			return true;
		} else {
			return false;
		}
    } 

    public function muokkaa_kayttaja($kayttajaNimi, $email) {
		$stmt = $this->db->prepare("UPDATE Kayttaja SET email=? WHERE kayttajaNimi=?");
		$stmt->execute(array($email, $kayttajaNimi));
    }
	
	public function kayttaja_tiedot() {
		$stmt = $this->db->query("SELECT Kayttaja.idKayttaja, kayttajaNimi, COUNT(Postaus.idPostaus) as postausten_lukumaara, COUNT(idKommentti) as kommenttien_lukumaara FROM Kayttaja INNER JOIN Postaus ON Postaus.idKayttaja = Kayttaja.IdKayttaja LEFT OUTER JOIN Kommentti ON Kommentti.idKayttaja = Kayttaja.IdKayttaja group by kayttajaNimi;");
			
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	
	public function luo_postaus($otsikko, $sisalto, $kayttajaNimi) {
		$stmt = $this->db->prepare('SELECT idKayttaja FROM Kayttaja WHERE kayttajaNimi = ?');
		$stmt->execute(array($kayttajaNimi));
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$idKayttaja = $row['idKayttaja'];
		
		$stmt = $this->db->prepare("INSERT INTO Postaus (otsikko, sisalto, idKayttaja, luontiAika, Muokattu) VALUES(?,?,?,NOW(),NOW())");
		$stmt->execute(array($otsikko, $sisalto, $idKayttaja));
    }
	
	
	
}?>