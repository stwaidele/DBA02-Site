SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Frage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Frage` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Frage` (
  `FID` INT NOT NULL,
  `Text` VARCHAR(1000) NULL,
  PRIMARY KEY (`FID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Antwort`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Antwort` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Antwort` (
  `AID` INT NOT NULL,
  `Text` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`AID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Antwortmoeglichkeit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Antwortmoeglichkeit` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Antwortmoeglichkeit` (
  `FID` INT NOT NULL,
  `AID` INT NOT NULL,
  PRIMARY KEY (`FID`, `AID`),
  INDEX `fk_Frage_has_Antwort_Antwort1_idx` (`AID` ASC),
  INDEX `fk_Frage_has_Antwort_Frage_idx` (`FID` ASC),
  CONSTRAINT `fk_Frage_has_Antwort_Frage`
    FOREIGN KEY (`FID`)
    REFERENCES `mydb`.`Frage` (`FID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Frage_has_Antwort_Antwort1`
    FOREIGN KEY (`AID`)
    REFERENCES `mydb`.`Antwort` (`AID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Benutzer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Benutzer` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Benutzer` (
  `UID` INT NOT NULL,
  `Password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`UID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Beantwortetmit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Beantwortetmit` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Beantwortetmit` (
  `FID` INT NOT NULL,
  `AID` INT NOT NULL,
  `Zeitstempel` DATETIME NOT NULL DEFAULT now(),
  `UID` INT NOT NULL,
  PRIMARY KEY (`FID`, `AID`),
  INDEX `fk_Frage_has_Antwort_Antwort2_idx` (`AID` ASC),
  INDEX `fk_Frage_has_Antwort_Frage1_idx` (`FID` ASC),
  INDEX `fk_Antwort_Benutzer1_idx` (`UID` ASC),
  CONSTRAINT `fk_Frage_has_Antwort_Frage1`
    FOREIGN KEY (`FID`)
    REFERENCES `mydb`.`Frage` (`FID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Frage_has_Antwort_Antwort2`
    FOREIGN KEY (`AID`)
    REFERENCES `mydb`.`Antwort` (`AID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Antwort_Benutzer1`
    FOREIGN KEY (`UID`)
    REFERENCES `mydb`.`Benutzer` (`UID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
