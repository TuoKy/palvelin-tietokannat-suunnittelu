<?php

class Tietokanta {
    //private $stmt;
	private $db;
	
    function __construct() {
		try {
			//require_once ("/home/H3543/db-init-harkkatyo.php");
			//require_once ("../palvelin/myslijuttu/hurhur2.php");
			require_once ("../php-dbconfig/db-init.php");

			
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
		$stmt = $this->db->prepare("SELECT idKayttaja FROM Kayttaja WHERE kayttajaNimi = ? AND salasana = ?");
		$stmt->execute(array($kayttajaNimi, $salasana));
		
		if ($stmt->rowCount() == 1) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['idKayttaja'];
		} else {
			return false;
		}
    }
	
	public function oikeudet($idKayttaja) {
		$stmt = $this->db->prepare("SELECT idOikeudet FROM Rooli  WHERE idKayttaja = ? ");
		$stmt->execute(array($idKayttaja));
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$oikeustaulu[$row['idOikeudet']] = '';
		}
		return $oikeustaulu;
    }
	
	public function luo_kayttaja($kayttajaNimi, $email, $salasana) {				
		$stmt = $this->db->prepare("SELECT kayttajaNimi FROM Kayttaja WHERE kayttajaNimi = ?");
		$stmt->execute(array($kayttajaNimi));
				
		if ($stmt->rowCount() == 1) {
			return false;
		} else {
			$stmt = $this->db->prepare("INSERT INTO Kayttaja (kayttajaNimi, email, salasana, liittymisPaiva) VALUES(?,?,?,NOW())");
			$stmt->execute(array($kayttajaNimi, $email, $salasana));
			
			$stmt = $this->db->prepare("insert into Rooli (idOikeudet, idKayttaja) values( 1,
									(SELECT idKayttaja FROM Kayttaja where kayttajaNimi = ? ))");
										//insert into Rooli (idOikeudet, idKayttaja) values( 1,
										//(SELECT idKayttaja FROM Kayttaja where kayttajaNimi = 'ankka' ))
			$stmt->execute(array($kayttajaNimi));
						
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
	
	public function edit_post($idPostaus, $otsikko, $sisalto) {
		$stmt = $this->db->prepare("UPDATE Postaus SET otsikko=?, sisalto=?, muokattu=NOW() WHERE $idPostaus=?");
		$stmt->execute(array($otsikko, $sisalto, $idPostaus));
	}
	
	public function kayttajatiedot() {
		$stmt = $this->db->query("SELECT * FROM Kayttajatiedot ORDER BY idKayttaja;");
			
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function show_user($idKayttaja) {
		$stmt = $this->db->query("SELECT * FROM Kayttaja WHERE $idKayttaja = ?;");
		$stmt->execute(array($idKayttaja));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function kayttaja_postaukset() {
		$stmt = $this->db->query("SELECT Kayttaja.idKayttaja, kayttajaNimi, COUNT(Postaus.idPostaus) as postausten_lukumaara FROM Kayttaja LEFT OUTER JOIN Postaus ON Postaus.idKayttaja = Kayttaja.IdKayttaja group by kayttajaNimi ORDER BY idKayttaja;");
			
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function kayttaja_kommentit() {
		$stmt = $this->db->query("SELECT Kayttaja.idKayttaja, COUNT(Kommentti.idKommentti) as kommenttien_lukumaara FROM Kayttaja LEFT OUTER JOIN Kommentti ON Kommentti.idKayttaja = Kayttaja.IdKayttaja group by idKayttaja;");
			
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public function post_comments() {
		$stmt = $this->db->query("SELECT Postaus.idPostaus, Postaus.otsikko, Kayttaja.kayttajaNimi, COUNT(DISTINCT Kommentti.idKommentti) as kommenttien_lukumaara, Postaus.luontiAika FROM Postaus LEFT OUTER JOIN Kommentti ON Kommentti.idPostaus = Postaus.idPostaus LEFT OUTER JOIN Kayttaja ON Kayttaja.idKayttaja = Postaus.idKayttaja GROUP BY Postaus.otsikko ORDER BY Postaus.idPostaus DESC;");
		
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
	
	public function showPosts() {
		$stmt = $this->db->query("SELECT * FROM Postaus order by idPostaus DESC;");
			
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}
	
	public function showPost($id) {
		$stmt = $this->db->query("SELECT * FROM Postaus WHERE idPostaus = ?;");
		$stmt->execute(array($id));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function listComments($id) {
		$stmt = $this->db->query("SELECT * FROM Kommentti WHERE idPostaus = $id");
		$stmt->execute(array($id));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
		
	public function deleteUser($idKayttaja) {	
		$stmt = $this->db->prepare('DELETE FROM Kayttaja WHERE idKayttaja = ?');
		$stmt->execute(array($idKayttaja));
		
    }
	
	public function deleteComment($idKommentti) {	
		$stmt = $this->db->prepare('DELETE FROM Kommentti WHERE idKommentti = ?');
		$stmt->execute(array($idKommentti));
		
    }
	
	public function deletePost($idPostaus) {
		$stmt = $this->db->prepare('DELETE FROM Postaus WHERE idPostaus = ?');
		$stmt->execute(array($idPostaus));
		
    }

	
}?>