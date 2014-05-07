SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `ViveGobMovil` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `ViveGobMovil` ;

-- -----------------------------------------------------
-- Table `ViveGobMovil`.`Personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ViveGobMovil`.`Personas` (
  `idPersona` INT NOT NULL,
  `nombrePersona` VARCHAR(45) NOT NULL,
  `apellido Persona` VARCHAR(45) NOT NULL,
  `usuarioPersona` VARCHAR(45) NOT NULL,
  `clavePersona` VARCHAR(45) NOT NULL,
  `fk_id_tipoPersona` INT NOT NULL,
  PRIMARY KEY (`idPersona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ViveGobMovil`.`TipoPersona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ViveGobMovil`.`TipoPersona` (
  `idTipoPersona` INT NOT NULL,
  `tipoPersona` VARCHAR(45) NULL,
  PRIMARY KEY (`idTipoPersona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ViveGobMovil`.`Retos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ViveGobMovil`.`Retos` (
  `idReto` INT NOT NULL AUTO_INCREMENT,
  `nombreReto` VARCHAR(45) NOT NULL,
  `iteracionReto` INT NOT NULL,
  PRIMARY KEY (`idReto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ViveGobMovil`.`Equipos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ViveGobMovil`.`Equipos` (
  `idEquipo` INT NOT NULL AUTO_INCREMENT,
  `nombreEquipo` VARCHAR(45) NOT NULL,
  `fk_id_retoEquipo` INT NOT NULL,
  PRIMARY KEY (`idEquipo`),
  INDEX `fk_id_retoEquipo_idx` (`fk_id_retoEquipo` ASC),
  CONSTRAINT `fk_id_retoEquipo`
    FOREIGN KEY (`fk_id_retoEquipo`)
    REFERENCES `ViveGobMovil`.`Retos` (`idReto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ViveGobMovil`.`EquiposJurados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ViveGobMovil`.`EquiposJurados` (
  `idEquipoJurado` INT NOT NULL AUTO_INCREMENT,
  `fk_id_juradoEquipoJurado` INT NOT NULL,
  `fk_id_equipoEquipoJurado` INT NOT NULL,
  `tipoJurado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEquipoJurado`),
  INDEX `fk_id_juradoEquipoJurado_idx` (`fk_id_juradoEquipoJurado` ASC),
  INDEX `fk_id_equipoEquipoJurado_idx` (`fk_id_equipoEquipoJurado` ASC),
  CONSTRAINT `fk_id_juradoEquipoJurado`
    FOREIGN KEY (`fk_id_juradoEquipoJurado`)
    REFERENCES `ViveGobMovil`.`Personas` (`idPersona`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_id_equipoEquipoJurado`
    FOREIGN KEY (`fk_id_equipoEquipoJurado`)
    REFERENCES `ViveGobMovil`.`Equipos` (`idEquipo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ViveGobMovil`.`Aspectos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ViveGobMovil`.`Aspectos` (
  `idAspecto` INT NOT NULL AUTO_INCREMENT,
  `nombreAspecto` VARCHAR(45) NOT NULL,
  `pesoAspecto` INT NOT NULL,
  PRIMARY KEY (`idAspecto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ViveGobMovil`.`Criterios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ViveGobMovil`.`Criterios` (
  `idCriterio` INT NOT NULL AUTO_INCREMENT,
  `descripcionCriterio` VARCHAR(500) NOT NULL,
  `fk_id_aspectoCriterio` INT NOT NULL,
  `valorCriterio` FLOAT NOT NULL,
  PRIMARY KEY (`idCriterio`),
  INDEX `fk_id_aspectoCriterio_idx` (`fk_id_aspectoCriterio` ASC),
  CONSTRAINT `fk_id_aspectoCriterio`
    FOREIGN KEY (`fk_id_aspectoCriterio`)
    REFERENCES `ViveGobMovil`.`Aspectos` (`idAspecto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ViveGobMovil`.`Calificaciones_EquiposJurados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ViveGobMovil`.`Calificaciones_EquiposJurados` (
  `idCalificacion_EquipoJurado` INT NOT NULL,
  `fk_id_Criterio_Calificacion_EquipoJurado` INT NOT NULL,
  `fk_id__EquipoJurado` INT NOT NULL,
  `valorCalificacion_CalificacionEquipoJurado` FLOAT NOT NULL,
  PRIMARY KEY (`idCalificacion_EquipoJurado`),
  INDEX `fk_id_EquipoJurado_idx` (`fk_id__EquipoJurado` ASC),
  INDEX `fk_id_Criterio_Calificacion_EquipoJurado_idx` (`fk_id_Criterio_Calificacion_EquipoJurado` ASC),
  CONSTRAINT `fk_id_Criterio_Calificacion_EquipoJurado`
    FOREIGN KEY (`fk_id_Criterio_Calificacion_EquipoJurado`)
    REFERENCES `ViveGobMovil`.`Criterios` (`idCriterio`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_id_EquipoJurado`
    FOREIGN KEY (`fk_id__EquipoJurado`)
    REFERENCES `ViveGobMovil`.`EquiposJurados` (`idEquipoJurado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
