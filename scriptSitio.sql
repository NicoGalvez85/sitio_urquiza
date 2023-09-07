-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema pp2sitio2
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `pp2sitio2` ;

-- -----------------------------------------------------
-- Schema pp2sitio2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pp2sitio2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `pp2sitio2` ;

-- -----------------------------------------------------
-- Table `pp2sitio2`.`persona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pp2sitio2`.`persona` ;

CREATE TABLE IF NOT EXISTS `pp2sitio2`.`persona` (
  `cuil` BIGINT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `mail` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NULL DEFAULT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cuil`),
  UNIQUE INDEX `mail_UNIQUE` (`mail` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `pp2sitio2`.`accesos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pp2sitio2`.`accesos` ;

CREATE TABLE IF NOT EXISTS `pp2sitio2`.`accesos` (
  `id_accesos` INT NOT NULL AUTO_INCREMENT,
  `fecha_hora` DATETIME NOT NULL,
  `persona_cuil` BIGINT NOT NULL,
  PRIMARY KEY (`id_accesos`),
  INDEX `fk_accesos_persona1_idx` (`persona_cuil` ASC) VISIBLE,
  CONSTRAINT `fk_accesos_persona1`
    FOREIGN KEY (`persona_cuil`)
    REFERENCES `pp2sitio2`.`persona` (`cuil`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `pp2sitio2`.`publicación`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pp2sitio2`.`publicación` ;

CREATE TABLE IF NOT EXISTS `pp2sitio2`.`publicación` (
  `id_publicación` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  `persona_cuil` BIGINT NOT NULL,
  PRIMARY KEY (`id_publicación`),
  INDEX `fk_publicación_persona1_idx` (`persona_cuil` ASC) VISIBLE,
  CONSTRAINT `fk_publicación_persona1`
    FOREIGN KEY (`persona_cuil`)
    REFERENCES `pp2sitio2`.`persona` (`cuil`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `pp2sitio2`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pp2sitio2`.`rol` ;

CREATE TABLE IF NOT EXISTS `pp2sitio2`.`rol` (
  `id_rol` INT NOT NULL,
  `rol` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `pp2sitio2`.`persona_roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pp2sitio2`.`persona_roles` ;

CREATE TABLE IF NOT EXISTS `pp2sitio2`.`persona_roles` (
  `persona_cuil` BIGINT NOT NULL,
  `rol_id_rol` INT NOT NULL,
  PRIMARY KEY (`persona_cuil`, `rol_id_rol`),
  INDEX `fk_persona_has_rol_rol1_idx` (`rol_id_rol` ASC) VISIBLE,
  INDEX `fk_persona_has_rol_persona1_idx` (`persona_cuil` ASC) VISIBLE,
  CONSTRAINT `fk_persona_has_rol_persona1`
    FOREIGN KEY (`persona_cuil`)
    REFERENCES `pp2sitio2`.`persona` (`cuil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_has_rol_rol1`
    FOREIGN KEY (`rol_id_rol`)
    REFERENCES `pp2sitio2`.`rol` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO rol (id_rol,rol) value(0,'Administrador'),(1,'Regente'),(2,'Profesor'),(3,'Alumno'),(4,'Bedel'),(5,'Secretario');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-01 20:14:57
