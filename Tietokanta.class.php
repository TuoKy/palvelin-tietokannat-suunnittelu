<?php
require_once ("Bcrypt.class.php");

class Tietokanta {

	private $db;
	private $bcrypt;
	
    function __construct() {
		try {
			//require_once ("/home/H3543/db-init-harkkatyo.php");
			require_once ("../palvelin/myslijuttu/hurhur2.php");
			//require_once ("../php-dbconfig/db-init.php");			

			

			$this->bcrypt = new Bcrypt(15);
			

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
	//Tekijä: Leppänen
    /* Tarkistetaan olivatko annetut tunnukset oikein ja jos olivat niin palautetaan
    sisään kirjautuneen käyttäjän id. Muuten palautetaan false */
	public function kirjaudu_sisaan($kayttajaNimi, $salasana) {
		$stmt = $this->db->prepare("SELECT idKayttaja, salasana FROM Kayttaja WHERE kayttajaNimi = ?");
		$stmt->execute(array($kayttajaNimi));
		
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($this->bcrypt->verify($salasana, $row['salasana'])) {
			return $row['idKayttaja'];
		} else {
			return false;
		}
    }
	
	   //Tekijä: Leppänen
    /* Funktiolle tuodaan käyttäjän id ja se palauttaa taulukon joka sisältää kaikki tämän käyttäjän oikeudet */
	public function oikeudet($idKayttaja) {
		$stmt = $this->db->prepare("select Oikeus.oikeusNimi from Oikeus left join Rooli on Oikeus.idOikeudet = Rooli.idOikeudet where Rooli.idKayttaja = ? ORDER BY Oikeus.oikeusNimi DESC");
		$stmt->execute(array($idKayttaja));
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$oikeustaulu[$row['oikeusNimi']] = '';
		}
		return $oikeustaulu;
    }
	
	//Tekijä: Leppänen
	// Suoritetaan kun käyttäjälle halutaan lisätä jokin oikeus
	public function lisaa_rooli($idKayttaja, $idOikeudet) {
 		$stmt = $this->db->prepare("insert into Rooli (idKayttaja, idOikeudet) values(?, ?)");
 		$stmt->execute(array($idKayttaja, $idOikeudet));
    }
	
	//Tekijä: Leppänen
	public function poista_rooli($idKayttaja, $idOikeudet) {
        $stmt = $this->db->prepare("DELETE FROM Rooli WHERE  idKayttaja = ? AND idOikeudet = ?");
		$stmt->execute(array($idKayttaja, $idOikeudet));
    }
	
	//TuoKy
	public function luo_kayttaja($kayttajaNimi, $email, $salasana) {				
		$stmt = $this->db->prepare("SELECT kayttajaNimi FROM Kayttaja WHERE kayttajaNimi = ?");
		$stmt->execute(array($kayttajaNimi));
				
		if ($stmt->rowCount() == 1) {
			return false;
		} else {
			$salasana_hash = $this->bcrypt->hash($salasana);

			$stmt = $this->db->prepare("INSERT INTO Kayttaja (kayttajaNimi, email, salasana, liittymisPaiva) VALUES(?,?,?,NOW())");
			$stmt->execute(array($kayttajaNimi, $email, $salasana_hash));
			
			$stmt = $this->db->prepare("insert into Rooli (idOikeudet, idKayttaja) values( 1,
									(SELECT idKayttaja FROM Kayttaja where kayttajaNimi = ? ))");
			$stmt->execute(array($kayttajaNimi));
						
			return true;
		}
    }
	
	//Tekijä: Leppänen
	public function admin_vaihda_salasana($idKayttaja, $uusiSalasana) {
		
		$salasana_hash = $this->bcrypt->hash($uusiSalasana);
		$stmt = $this->db->prepare("UPDATE Kayttaja SET salasana=? WHERE idKayttaja=?");
		$stmt->execute(array($salasana_hash, $idKayttaja));
    }
	
    //Tekijä: Leppänen
	public function vaihda_salasana($idKayttaja, $vanhaSalasana, $uusiSalasana) {
		$stmt = $this->db->prepare("SELECT idKayttaja, salasana FROM Kayttaja WHERE idKayttaja = ?");
		$stmt->execute(array($idKayttaja));
		
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($this->bcrypt->verify($vanhaSalasana, $row['salasana'])) {
			$salasana_hash = $this->bcrypt->hash($uusiSalasana);
			$stmt = $this->db->prepare("UPDATE Kayttaja SET salasana=? WHERE idKayttaja=?");
			$stmt->execute(array($salasana_hash, $idKayttaja));

			return true;
		} else {
			return false;
		}
    } 

	//Tekijä: Leppänen
    /* Funktiolle tuodaan käyttäjän nimi sähköposti ja salasana, ja nimen perusteella päivitetään kaksi jälkimmäistä tietoa tietokantaan */
    public function muokkaa_kayttaja($idKayttaja, $email) {
		$stmt = $this->db->prepare("UPDATE Kayttaja SET email=? WHERE idKayttaja=?;");
		$stmt->execute(array($email, $idKayttaja));
    }
	
	//Tekijä: Manninen
	public function edit_post($idPostaus, $otsikko, $sisalto) {
		$stmt = $this->db->prepare("UPDATE Postaus SET otsikko=?, sisalto=?, muokattu=NOW() WHERE idPostaus=?;");
		$stmt->execute(array($otsikko, $sisalto, $idPostaus));
	}
	
	//Tekijä: Manninen
	public function edit_comment($idKommentti, $otsikko, $sisalto) {
			$stmt = $this->db->prepare("UPDATE Kommentti SET otsikko=?, sisalto=?, muokattu=NOW() WHERE idKommentti=?;");
			$stmt->execute(array($otsikko, $sisalto, $idKommentti));
	}
	
    //Tekijä: Leppänen
	public function kayttajatiedot() {
		$stmt = $this->db->query("SELECT * FROM Kayttajatiedot ORDER BY idKayttaja;");
			
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//Tekijä: Manninen
	public function show_user($idKayttaja) {
		$stmt = $this->db->query("SELECT * FROM Kayttaja WHERE idKayttaja = ?;");
		$stmt->execute(array($idKayttaja));
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function kayttaja_postaukset() {
		$stmt = $this->db->query("SELECT Kayttaja.idKayttaja, kayttajaNimi, COUNT(Postaus.idPostaus) as postausten_lukumaara FROM Kayttaja LEFT OUTER JOIN Postaus ON Postaus.idKayttaja = Kayttaja.IdKayttaja group by kayttajaNimi ORDER BY idKayttaja;");
			
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function kayttaja_kommentit() {
		$stmt = $this->db->query("SELECT Kayttaja.idKayttaja, COUNT(Kommentti.idKommentti) as kommenttien_lukumaara FROM Kayttaja LEFT OUTER JOIN Kommentti ON Kommentti.idKayttaja = Kayttaja.IdKayttaja group by idKayttaja;");
			
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	//Tekijä: Manninen
	public function post_comments() {
		$stmt = $this->db->query("SELECT Postaus.idPostaus, Postaus.otsikko, Kayttaja.kayttajaNimi, COUNT(DISTINCT Kommentti.idKommentti) as kommenttien_lukumaara, Postaus.luontiAika FROM Postaus LEFT OUTER JOIN Kommentti ON Kommentti.idPostaus = Postaus.idPostaus LEFT OUTER JOIN Kayttaja ON Kayttaja.idKayttaja = Postaus.idKayttaja GROUP BY Postaus.idPostaus ORDER BY Postaus.idPostaus DESC;");
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	//TuoKY
	public function luo_postaus($otsikko, $sisalto, $kayttajaNimi) {
		$stmt = $this->db->prepare('SELECT idKayttaja FROM Kayttaja WHERE kayttajaNimi = ?');
		$stmt->execute(array($kayttajaNimi));
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$idKayttaja = $row['idKayttaja'];
		
		$stmt = $this->db->prepare("INSERT INTO Postaus (otsikko, sisalto, idKayttaja, luontiAika, Muokattu) VALUES(?,?,?,NOW(),NOW())");
		$stmt->execute(array($otsikko, $sisalto, $idKayttaja));
		
		
    }
	//TuoKy?
	public function luo_kommentti($otsikko, $sisalto, $idKayttaja, $postId, $idKommentti) {
		
		$stmt = $this->db->prepare("INSERT INTO Kommentti (otsikko, sisalto, idKayttaja, idPostaus, luontiAika, vanhempi, tila, Muokattu) VALUES(?,?,(SELECT idKayttaja FROM Kayttaja where kayttajaNimi = ? ),?,NOW(),?,0,NOW())");
		$stmt->execute(array($otsikko, $sisalto, $idKayttaja, $postId, $idKommentti));
	}
	
	//Tekijä: Manninen
	public function showPosts() {
		$stmt = $this->db->query("SELECT * FROM Postaus order by idPostaus DESC;");
			
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}
	
    //Tekijä: Leppänen
    /* Funktiolle tuodaan käyttäjän id ja stmt muuttujan jossa on kaikki käyttäjän tekemät postaukset */
    public function kayttajan_postaukset($idKayttaja) {
		$stmt = $this->db->query("SELECT * FROM Postaus WHERE idKayttaja = ?;");
		$stmt->execute(array($idKayttaja));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
    
    //Tekijä: Leppänen
    /* Funktiolle tuodaan käyttäjän id ja stmt muuttujan jossa on kaikki käyttäjän tekemät kommentit */
    public function kayttajan_kommentit($idKayttaja) {
		$stmt = $this->db->query("SELECT * FROM Kommentti WHERE idKayttaja = ?;");
		$stmt->execute(array($idKayttaja));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
    
	//Tekijä: Manninen
	public function showPost($id) {
		$stmt = $this->db->query("SELECT * FROM Postaus WHERE idPostaus = ?;");
		$stmt->execute(array($id));
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
		
	//Tekijä: Manninen
	public function showComment($id) {
		$stmt = $this->db->query("SELECT * FROM Kommentti WHERE idKommentti = ?;");
		$stmt->execute(array($id));
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	//Tekijä: Manninen
	public function showEsiintyma() {
		$stmt = $this->db->query("SELECT * FROM Esiintyma;");
		$stmt->execute(array());
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//Tekijä: Manninen
	public function showEsiintymaTagit($id) {
		$stmt = $this->db->query("SELECT idTagi FROM Esiintyma WHERE idPostaus = ?;");
		$stmt->execute(array($id));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//Tekijä: Manninen
	public function showTag() {
		$stmt = $this->db->query("SELECT * FROM Tagi;");
		$stmt->execute(array());
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//Tekijä: Manninen
	public function listTags($idPostaus){
		$stmt = $this->db->query("SELECT Tagi.tagiNimi FROM Tagi LEFT OUTER JOIN Esiintyma ON Tagi.idTagi = Esiintyma.idTagi WHERE Esiintyma.idPostaus = ?;");
		$stmt->execute(array($idPostaus));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//Tekijä: Manninen
	public function listManageComments() {
		$stmt = $this->db->query("SELECT Kommentti.idKommentti, Kommentti.otsikko, Kommentti.sisalto, Kommentti.idPostaus, Kommentti.luontiAika, Kayttaja.kayttajaNimi FROM Kommentti LEFT OUTER JOIN Kayttaja ON Kommentti.idKayttaja = Kayttaja.idKayttaja order by luontiAika DESC;");
		$stmt->execute(array());
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//Tekijä: Manninen
	public function listComments() {
		$stmt = $this->db->query("SELECT * FROM Kommentti order by luontiAika DESC");
		$stmt->execute(array());
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	
	//Tekijä: Manninen
	public function listComments1($id) {
		$stmt = $this->db->query("SELECT * FROM Kommentti WHERE idPostaus = ? order by luontiAika DESC");
		$stmt->execute(array($id));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
    //Tekijä: Leppänen
	public function haeHenkNimi($id) {
	$stmt = $this->db->prepare("SELECT kayttajaNimi FROM Kayttaja where idKayttaja = ?");	
	$stmt->execute(array($id));
	return $stmt->fetch(PDO::FETCH_ASSOC);	
	}
	
	//TuoKy
	public function canHasTags() {
		$stmt = $this->db->query("SELECT * FROM Tagi");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	//TuoKy
	public function showPostsHasTag($nimiTagi)
	{
		$stmt = $this->db->prepare("SELECT idTagi FROM Tagi where tagiNimi = ?");
		$stmt->execute(array($nimiTagi));
		
		$temp = $stmt->fetch(PDO::FETCH_ASSOC);		
		$id = $temp['idTagi'];
		
		$stmt1 = $this->db->prepare("SELECT idPostaus FROM Esiintyma where idTagi = ?");
		$stmt1->execute(array($id));
		return $stmt1->fetchAll(PDO::FETCH_ASSOC);
		
	}
	
	//TuoKy
	public function luo_Tagi($tagi){
		$stmt = $this->db->prepare("SELECT * FROM Tagi WHERE tagiNimi = ?");
		$stmt->execute(array($tagi));
		if(!$stmt->rowCount() == 1){					
		$stmt = $this->db->prepare("INSERT INTO Tagi (tagiNimi) VALUES (?)");
		$stmt->execute(array($tagi));
		}
	}
	//TuoKy
	public function sidoPostiin($tagi){
		$stmt = $this->db->prepare("SELECT idPostaus FROM Postaus where idPostaus = (SELECT max(idPostaus) FROM Postaus)");
		$stmt->execute();
		
		$temp = $stmt->fetch(PDO::FETCH_ASSOC);
		$idP = $temp['idPostaus'];
		
		$stmt1 = $this->db->prepare("SELECT idTagi FROM Tagi where tagiNimi = ?");
		$stmt1->execute(array($tagi));
		
		$temp2 = $stmt1->fetch(PDO::FETCH_ASSOC);
		$idT = $temp2['idTagi'];
		
		$stmt2 = $this->db->prepare("INSERT INTO Esiintyma VALUES (?,?)");
		$stmt2->execute(array($idP,$idT));
	}
	
	//Tekijä: Manninen
	public function sidoMuokattuunPostiin($tagi, $idPostaus){
		$stmt1 = $this->db->prepare("SELECT idTagi FROM Tagi where tagiNimi = ?");
		$stmt1->execute(array($tagi));
		
		$temp2 = $stmt1->fetch(PDO::FETCH_ASSOC);
		$idT = $temp2['idTagi'];
		
		$stmt2 = $this->db->prepare("INSERT INTO Esiintyma VALUES (?,?)");
		$stmt2->execute(array($idPostaus,$idT));
	}
	
	//Tekijä: Manninen
	public function deleteComment($idKommentti) {	
		$stmt = $this->db->prepare('DELETE FROM Kommentti WHERE idKommentti = ?');
		$stmt->execute(array($idKommentti));
		
    }
	
	//Tekijä: Manninen
	public function deletePost($idPostaus) {
		$stmt = $this->db->prepare('DELETE FROM Postaus WHERE idPostaus = ?');
		$stmt->execute(array($idPostaus));
    }

	//Tekijä: Manninen
	public function deleteTag($idTag) {
		$stmt = $this->db->prepare('DELETE FROM Tagi WHERE idTagi = ?');
		$stmt->execute(array($idTag));
    }
	
	//Tekijä: Manninen
	public function deleteEsiintyma($idPostaus) {
		$stmt = $this->db->prepare('DELETE FROM Esiintyma WHERE idPostaus = ?');
		$stmt->execute(array($idPostaus));
	}
	
	//Tekijä: Leppänen
	public function deleteUser($idKayttaja) {	
		$stmt = $this->db->prepare('DELETE FROM Kayttaja WHERE idKayttaja = ?');
		$stmt->execute(array($idKayttaja));
    }
	
}?>