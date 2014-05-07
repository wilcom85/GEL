SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Persona` (
  `idPersona` INT NOT NULL,
  `nombrePersona` VARCHAR(45) NOT NULL,
  `apellidoPersonal` VARCHAR(45) NOT NULL,
  `usuarioPersona` VARCHAR(45) NOT NULL,
  `clavePersona` VARCHAR(45) NOT NULL,
  `tipoPersonal` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPersona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Reto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Reto` (
  `idReto` INT NOT NULL AUTO_INCREMENT,
  `nombreReto` VARCHAR(45) NOT NULL,
  `numeroIteracion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idReto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Equipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Equipo` (
  `idEquipo` INT NOT NULL AUTO_INCREMENT,
  `nombreEquipo` VARCHAR(45) NOT NULL,
  `calificacionEquipo` FLOAT NOT NULL,
  PRIMARY KEY (`idEquipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Calificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Calificacion` (
  `idCalificacion` INT NOT NULL AUTO_INCREMENT,
  `fk_id_jurado` INT NOT NULL,
  `fk_id_reto` INT NOT NULL,
  `fk_id_equipo` INT NOT NULL,
  `estadoCalificacion` INT NOT NULL,
  `valorCalificacion0` INT NOT NULL,
  `valorCalificacion1` INT NOT NULL,
  `valorCalificacion2` INT NOT NULL,
  `valorCalificacion3` INT NOT NULL,
  `valorCalificacion4` INT NOT NULL,
  `valorCalificacion5` INT NOT NULL,
  `valorCalificacion6` INT NOT NULL,
  `valorCalificacion7` INT NOT NULL,
  `valorCalificacion8` INT NOT NULL,
  `valorCalificacion9` INT NOT NULL,
  `valorCalificacion10` INT NOT NULL,
  PRIMARY KEY (`idCalificacion`),
  INDEX `fk_id_jurado_idx` (`fk_id_jurado` ASC),
  INDEX `fk_id_reto_idx` (`fk_id_reto` ASC),
  INDEX `fk_id_equipo_idx` (`fk_id_equipo` ASC),
  CONSTRAINT `fk_id_jurado`
    FOREIGN KEY (`fk_id_jurado`)
    REFERENCES `mydb`.`Persona` (`idPersona`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_reto`
    FOREIGN KEY (`fk_id_reto`)
    REFERENCES `mydb`.`Reto` (`idReto`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_equipo`
    FOREIGN KEY (`fk_id_equipo`)
    REFERENCES `mydb`.`Equipo` (`idEquipo`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`CalificacionPonderada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`CalificacionPonderada` (
  `idCP` INT NOT NULL AUTO_INCREMENT,
  `valorCP0` FLOAT NOT NULL,
  `valorCP1` FLOAT NOT NULL,
  `valorCP2` FLOAT NOT NULL,
  `valorCP3` FLOAT NOT NULL,
  `valorCP4` FLOAT NOT NULL,
  `valorCP5` FLOAT NOT NULL,
  `valorCP6` FLOAT NOT NULL,
  `valorCP7` FLOAT NOT NULL,
  `valorCP8` FLOAT NOT NULL,
  `valorCP9` FLOAT NOT NULL,
  `valorCP10` FLOAT NOT NULL,
  `fk_id_Calificacion` INT NOT NULL,
  PRIMARY KEY (`idCP`),
  INDEX `fk_id_Calificacion_idx` (`fk_id_Calificacion` ASC),
  CONSTRAINT `fk_id_Calificacion`
    FOREIGN KEY (`fk_id_Calificacion`)
    REFERENCES `mydb`.`Calificacion` (`idCalificacion`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`CalificacionAspectos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`CalificacionAspectos` (
  `idCalificacionAspectos` INT NOT NULL AUTO_INCREMENT,
  `CalificacionAspectoUsabilidad` FLOAT NOT NULL,
  `CalificacionAspectoGrafico` FLOAT NOT NULL,
  `CalificacionAspectoFuncional` FLOAT NOT NULL,
  `CalificacionAspectoInnovacion` FLOAT NOT NULL,
  `CalificacionAspectoIntegracion` FLOAT NOT NULL,
  `CalificacionAspectoViabilidad` FLOAT NOT NULL,
  PRIMARY KEY (`idCalificacionAspectos`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
