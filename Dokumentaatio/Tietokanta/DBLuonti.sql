-- -----------------------------------------------------
-- Seuraavat 3 rivia ovat scripteja ilmeisesti
-- -----------------------------------------------------
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema GenericName
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema GenericName
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `GenericName` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `GenericName` ;

-- -----------------------------------------------------
-- Table `GenericName`.`Kayttaja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GenericName`.`Kayttaja` (
  `idKayttaja` INT NOT NULL AUTO_INCREMENT,
  `kayttajaNimi` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `salasana` VARCHAR(255) NOT NULL,
  `liittymisPaiva` DATETIME NULL,
  PRIMARY KEY (`idKayttaja`),
  UNIQUE INDEX `kayttajaNimi_UNIQUE` (`kayttajaNimi` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GenericName`.`Postaus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GenericName`.`Postaus` (
  `idPostaus` INT NOT NULL AUTO_INCREMENT,
  `otsikko` VARCHAR(45) NULL,
  `sisalto` LONGTEXT NULL,
  `idKayttaja` INT NULL,
  `luontiAika` DATETIME NOT NULL,
  `muokattu` DATETIME NULL,
  PRIMARY KEY (`idPostaus`),
  INDEX `fk_Merkinta_Kayttaja_idx` (`idKayttaja` ASC),
  CONSTRAINT `fk_Merkinta_Kayttaja`
    FOREIGN KEY (`idKayttaja`)
    REFERENCES `GenericName`.`Kayttaja` (`idKayttaja`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GenericName`.`Kommentti`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GenericName`.`Kommentti` (
  `idKommentti` INT NOT NULL AUTO_INCREMENT,
  `otsikko` VARCHAR(45) NOT NULL,
  `sisalto` TEXT NULL,
  `idKayttaja` INT NULL,
  `idPostaus` INT NOT NULL,
  `luontiAika` DATETIME NULL,
  `vanhempi` INT NULL,
  `tila` VARCHAR(30) NULL,
  `muokattu` DATETIME NULL,
  PRIMARY KEY (`idKommentti`),
  INDEX `fk_Kommnetti_Kayttaja1_idx` (`idKayttaja` ASC),
  INDEX `fk_Kommnetti_Merkinta1_idx` (`idPostaus` ASC),
  CONSTRAINT `fk_Kommnetti_Kayttaja1`
    FOREIGN KEY (`idKayttaja`)
    REFERENCES `GenericName`.`Kayttaja` (`idKayttaja`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Kommnetti_Merkinta1`
    FOREIGN KEY (`idPostaus`)
    REFERENCES `GenericName`.`Postaus` (`idPostaus`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GenericName`.`Oikeus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GenericName`.`Oikeus` (
  `idOikeudet` INT NOT NULL,
  `oikeusNimi` VARCHAR(45) NOT NULL,
  `oikeusKuvaus` VARCHAR(45) NULL,
  PRIMARY KEY (`idOikeudet`),
  UNIQUE INDEX `oikeusNimi_UNIQUE` (`oikeusNimi` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GenericName`.`Rooli`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GenericName`.`Rooli` (
  `idOikeudet` INT NOT NULL,
  `idKayttaja` INT NOT NULL,
  `aktiivinen` BIT NULL,
  `banniLoppu` DATETIME NULL,
  INDEX `fk_Oikeudet_has_Kayttaja_Kayttaja1_idx` (`idKayttaja` ASC),
  INDEX `fk_Oikeudet_has_Kayttaja_Oikeudet1_idx` (`idOikeudet` ASC),
  PRIMARY KEY (`idOikeudet`, `idKayttaja`),
  CONSTRAINT `fk_Oikeudet_has_Kayttaja_Oikeudet1`
    FOREIGN KEY (`idOikeudet`)
    REFERENCES `GenericName`.`Oikeus` (`idOikeudet`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Oikeudet_has_Kayttaja_Kayttaja1`
    FOREIGN KEY (`idKayttaja`)
    REFERENCES `GenericName`.`Kayttaja` (`idKayttaja`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GenericName`.`Tagi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GenericName`.`Tagi` (
  `idTagi` INT NOT NULL AUTO_INCREMENT,
  `tagiNimi` VARCHAR(45) NOT NULL,
  `tagiKuvaus` VARCHAR(45) NULL,
  PRIMARY KEY (`idTagi`),
  UNIQUE INDEX `tagiNimi_UNIQUE` (`tagiNimi` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GenericName`.`Esiintyma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GenericName`.`Esiintyma` (
  `idPostaus` INT NOT NULL,
  `idTagi` INT NOT NULL,
  PRIMARY KEY (`idPostaus`, `idTagi`),
  INDEX `fk_Postaus_has_Tagi_Tagi1_idx` (`idTagi` ASC),
  INDEX `fk_Postaus_has_Tagi_Postaus1_idx` (`idPostaus` ASC),
  CONSTRAINT `fk_Postaus_has_Tagi_Postaus1`
    FOREIGN KEY (`idPostaus`)
    REFERENCES `GenericName`.`Postaus` (`idPostaus`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Postaus_has_Tagi_Tagi1`
    FOREIGN KEY (`idTagi`)
    REFERENCES `GenericName`.`Tagi` (`idTagi`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- -----------------------------------------------------
-- Nama Temput tekee view:n nimelta Kayttajatiedot
-- -----------------------------------------------------
create view Kayttajatiedot_valitaulu as
SELECT Kayttaja.idKayttaja, kayttajaNimi, COUNT(Postaus.idPostaus) as postausten_lukumaara
FROM Kayttaja
LEFT OUTER JOIN Postaus
ON Postaus.idKayttaja = Kayttaja.IdKayttaja
group by kayttajaNimi;

create view Kayttajatiedot as
SELECT Kayttajatiedot_valitaulu.idKayttaja, kayttajaNimi, postausten_lukumaara, COUNT(Kommentti.idKommentti) as kommenttiLkm
FROM Kayttajatiedot_valitaulu
LEFT OUTER JOIN Kommentti
ON Kommentti.idKayttaja = Kayttajatiedot_valitaulu.IdKayttaja
group by idKayttaja;

insert into Kayttaja (kayttajaNimi, salasana, email, liittymisPaiva) values 
('admin','admin','pekanputka@gmail.com',NOW()),
('petismatis','salasana1234','petis@hotmail.com',NOW()),
('Pandaspede','panda1','panda@live.fi',NOW()),
('Penapontikka','viina','kilju@live.fi',NOW());

insert into Postaus (idKayttaja, luontiAika, muokattu, otsikko, sisalto) values
('1',NOW(),NULL,'<h2>Kyllikki Mansikkamaki sano </h2>','<p>Iltakurssit olivat aikanaan oiva koulutusmuoto sisalle seuratoimintaan ja nuorisoseura-aatteeseen. Sotatalven 1943 iltakurssilaiset. Ohjaajana oli Kyllikki Mansikkamaki Nurmosta. (Juhani Yli-Rantalan arkisto) </p> '),
('1',NOW(),NULL,'<h2>Jean Sibeliuksen salatut tarinat</h2>','<p>Sibeliuksen keskeisimmat teokset ovat hanen seitseman sinfoniaansa. Sinfonioiden lisaksi hanen tunnetuimmat teoksensa ovat viulukonsertto seka orkesteriteokset Finlandia, Karelia-sarja, Tuonelan joutsen (osa Lemminkainen-sarjaa) ja Valse triste. Hanen muihin teoksiinsa kuuluu muun muassa vokaali-, kuoro- ja pianomusiikkia, naytelmamusiikkia ja kamarimusiikkia. Sibeliuksen viimeiset suurimuotoiset teokset olivat seitsemas sinfonia (1924), nayttamoteos Myrsky (1926) ja savelruno Tapiola (1926). Suomessa Sibeliuksen syntymapaiva 8. joulukuuta on liputuspaiva, suomalaisen musiikin paiva.</p>'),
('2',NOW(),NULL,'<h2>Ari-Pekan uusimmat uutiset</h2>','<p>Suomalainen olympiauimari  kaapista ulos - *Vihdoin voin olla oma* itseni Olympiatason uimari Ari-Pekka Liukkonen kertoi olevansa homoseksuaali Ylen suorassa Urheiluviikonloppu-ohjelmassa ja sita ennen Ylen Urheilun haastattelussa tanaan. Tasan viikon paasta 25 vuotta tayttava Liukkonen on tiettavasti ensimmainen suomalainen huippumiesurheilija, joka on tullut julkisesti ulos kaapista uransa aikana.</p>'),
('3',NOW(),NOW(),'<h2>ASD paivitys</h2>','<p>ASD</p>'),
('1',NOW(),NULL,'<h2>ASD paivitys2</h2>','<p>ASD2</p>'),
('1',NOW(),NULL,'<h2>ASD paivitys3</h2>','<p>ASD3</p>'),
('1',NOW(),NOW(),'<h2>ASD paivitys4</h2>','<p>ASD4</p>'),
('2',NOW(),NOW(),'<h2>ASD paivitys5</h2>','<p>ASD5</p>');

insert into Kommentti (idKayttaja, idPostaus, luontiAika, vanhempi, tila, muokattu, otsikko, sisalto) values 
('1','1',NOW(), NULL, '0', NULL, '<h3>asd</h3>','<p>Tama on minun eka kommenttini, pls be gentle.'),
('2','1',NOW(),'1', '0', NULL, '<h3>asd</h3>','<p>Mene pois, taalla ei kaivata ensimmaisia kommentoijia'),
('3','1',NOW(),'2','1', NULL, '<h3>asd</h3>','<p>H***T S*****A KAIKKI POIS'),
('1','3',NOW(), NULL, '0', NULL, '<h3>asd</h3>','<p>Oih, olipas mukava postaus, tykkasin ja laikkasin facebookissa. Twiittasin myos <3!'),
('3','3',NOW(), NULL, '0',NOW(), '<h3>asd</h3>','<p>Sibelius oli hieno mies!');

insert into Oikeus (idOikeudet, oikeusNimi, oikeusKuvaus) values
('1', 'Guest', 'Saa tehda kommentteja'),
('2', 'User', 'Saa tehda postauksia'),
('3', 'Admin', 'Nakee admin valikot');

insert into Rooli (idOikeudet, idKayttaja) values
('1', '1'),
('2', '1'),
('3', '1'),
('1', '2'),
('1', '3'),
('1', '4');

insert into Tagi (idTagi, tagiNimi, tagiKuvaus) values
('1', 'kissa', 'Kissat on kivoja'),
('2', 'koirat', 'Koirat on kivoja'),
('3', 'murha', 'on vastuuton taivas');

insert into Esiintyma (idPostaus, idTagi) values
('1', '1'),
('2', '2'),
('3', '3');