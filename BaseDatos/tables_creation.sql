-- MySQL Script generated by MySQL Workbench
-- Thu Oct 27 12:29:16 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema PetHero
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema PetHero
-- -----------------------------------------------------
CREATE database IF NOT EXISTS `PetHero`;
USE `PetHero` ;

-- -----------------------------------------------------
-- Table `PetHero`.`TipoAnimal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`TipoAnimal` (
  `idTipoAnimal` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  `raza` VARCHAR(45) NOT NULL,
  `tamanio` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipoAnimal`),
  UNIQUE INDEX `raza_UNIQUE` (`raza` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`Ciudades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`Ciudades` (
  `idCiudades` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `codigoPostal` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`idCiudades`),
  UNIQUE INDEX `codigoPostal_UNIQUE` (`codigoPostal` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`Usuarios` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `mail` VARCHAR(45) NOT NULL,
  `contrasenia` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `numeroTelefono` VARCHAR(45) NOT NULL,
  `fechaDeNacimiento` DATE NOT NULL,
  `idCiudad` INT NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `FK_UsuarioCiudad_idx` (`idCiudad` ASC) ,
  UNIQUE INDEX `mail_UNIQUE` (`mail` ASC) ,
  UNIQUE INDEX `numeroTelefono_UNIQUE` (`numeroTelefono` ASC) ,
  CONSTRAINT `FK_UsuarioCiudad`
    FOREIGN KEY (`idCiudad`)
    REFERENCES `PetHero`.`Ciudades` (`idCiudades`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`ImagenAnimal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`ImagenAnimal` (
  `idImagenAnimal` INT NOT NULL AUTO_INCREMENT,
  `urlImagen` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idImagenAnimal`),
  UNIQUE INDEX `urlImagen_UNIQUE` (`urlImagen` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`VideoAnimal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`VideoAnimal` (
  `idVideoAnimal` INT NOT NULL AUTO_INCREMENT,
  `urlVideo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idVideoAnimal`),
  UNIQUE INDEX `urlVideo_UNIQUE` (`urlVideo` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`CartaVacunacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`CartaVacunacion` (
  `idCartaVacunacion` INT NOT NULL AUTO_INCREMENT,
  `urlImagen` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCartaVacunacion`),
  UNIQUE INDEX `urlImagen_UNIQUE` (`urlImagen` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`Animales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`Animales` (
  `idAnimales` INT NOT NULL AUTO_INCREMENT,
  `idTipoAnimal` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `edad` INT NOT NULL,
  `sexo` VARCHAR(15) NOT NULL,
  `idImagenPerfil` INT NOT NULL,
  `idVideo` INT NULL,
  `idCartaVacunacion` INT NOT NULL,
  `idDuenio` INT NOT NULL,
  `observaciones` VARCHAR(150) NULL DEFAULT '\"\"',
  PRIMARY KEY (`idAnimales`),
  INDEX `FK_AnimalTipo_idx` (`idTipoAnimal` ASC) ,
  INDEX `FK_AnimalDuenio_idx` (`idDuenio` ASC) ,
  INDEX `FK_AnimalImagenPerfil_idx` (`idImagenPerfil` ASC) ,
  INDEX `FK_AnimalVideo_idx` (`idVideo` ASC) ,
  INDEX `FK_AnimalVacuna_idx` (`idCartaVacunacion` ASC) ,
  UNIQUE INDEX `idImagenPerfil_UNIQUE` (`idImagenPerfil` ASC) ,
  UNIQUE INDEX `idVideo_UNIQUE` (`idVideo` ASC) ,
  UNIQUE INDEX `idCartaVacunacion_UNIQUE` (`idCartaVacunacion` ASC) ,
  CONSTRAINT `FK_AnimalTipo`
    FOREIGN KEY (`idTipoAnimal`)
    REFERENCES `PetHero`.`TipoAnimal` (`idTipoAnimal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_AnimalDuenio`
    FOREIGN KEY (`idDuenio`)
    REFERENCES `PetHero`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_AnimalImagenPerfil`
    FOREIGN KEY (`idImagenPerfil`)
    REFERENCES `PetHero`.`ImagenAnimal` (`idImagenAnimal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_AnimalVideo`
    FOREIGN KEY (`idVideo`)
    REFERENCES `PetHero`.`VideoAnimal` (`idVideoAnimal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_AnimalVacuna`
    FOREIGN KEY (`idCartaVacunacion`)
    REFERENCES `PetHero`.`CartaVacunacion` (`idCartaVacunacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`Guardianes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`Guardianes` (
  `idGuardian` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `valoracion` INT NULL DEFAULT 0,
  `fechaInicio` DATE NULL,
  `fechaFin` DATE NULL,
  `saldoAcumulado` FLOAT NULL DEFAULT 0,
  `tamanioAceptado` VARCHAR(45) NOT NULL,
  `direccionCuidado` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(150) NULL,
  PRIMARY KEY (`idGuardian`),
  INDEX `FK_GuardianUsuario_idx` (`idUsuario` ASC) ,
  UNIQUE INDEX `idUsuario_UNIQUE` (`idUsuario` ASC) ,
  CONSTRAINT `FK_GuardianUsuario`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `PetHero`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`Reservas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`Reservas` (
  `idReserva` INT NOT NULL AUTO_INCREMENT,
  `idGuardian` INT NOT NULL,
  `idAnimal` INT NOT NULL,
  `fechaInicio` DATE NOT NULL,
  `fechaFin` DATE NOT NULL,
  `precio` FLOAT NOT NULL,
  `estado` VARCHAR(30) NULL DEFAULT 'pendiente',
  PRIMARY KEY (`idReserva`),
  INDEX `FK_ReservaGuardian_idx` (`idGuardian` ASC) ,
  INDEX `FK_ReservaAnimal_idx` (`idAnimal` ASC) ,
  CONSTRAINT `FK_ReservaGuardian`
    FOREIGN KEY (`idGuardian`)
    REFERENCES `PetHero`.`Guardianes` (`idGuardian`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_ReservaAnimal`
    FOREIGN KEY (`idAnimal`)
    REFERENCES `PetHero`.`Animales` (`idAnimales`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`Tarjetas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`Tarjetas` (
  `idTarjetas` INT NOT NULL AUTO_INCREMENT,
  `numeroTarjeta` DOUBLE NOT NULL,
  `cvv` INT(3) NOT NULL,
  `fechaVencimiento` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idTarjetas`),
  UNIQUE INDEX `numeroTarjeta_UNIQUE` (`numeroTarjeta` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`Pagos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`Pagos` (
  `idPagos` INT NOT NULL AUTO_INCREMENT,
  `idReserva` INT NOT NULL,
  `total` FLOAT NOT NULL,
  `idTarjeta` INT NOT NULL,
  PRIMARY KEY (`idPagos`),
  INDEX `FK_PagoReserva_idx` (`idReserva` ASC) ,
  INDEX `FK_PagoTarjeta_idx` (`idTarjeta` ASC) ,
  UNIQUE INDEX `idReserva_UNIQUE` (`idReserva` ASC) ,
  CONSTRAINT `FK_PagoReserva`
    FOREIGN KEY (`idReserva`)
    REFERENCES `PetHero`.`Reservas` (`idReserva`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PagoTarjeta`
    FOREIGN KEY (`idTarjeta`)
    REFERENCES `PetHero`.`Tarjetas` (`idTarjetas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`Factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`Factura` (
  `idFactura` INT NOT NULL AUTO_INCREMENT,
  `idPago` INT NOT NULL,
  `fechaFactura` DATE NOT NULL,
  `razonSocial` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idFactura`),
  INDEX `FK_FacturaPago_idx` (`idPago` ASC) ,
  UNIQUE INDEX `idPago_UNIQUE` (`idPago` ASC) ,
  CONSTRAINT `FK_FacturaPago`
    FOREIGN KEY (`idPago`)
    REFERENCES `PetHero`.`Pagos` (`idPagos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PetHero`.`UsuarioxTarjeta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`UsuarioxTarjeta` (
  `idUsuarioxTarjeta` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `idTarjeta` INT NOT NULL,
  PRIMARY KEY (`idUsuarioxTarjeta`),
  INDEX `FK_UsuarioTarjeta_idx` (`idUsuario` ASC) ,
  INDEX `FK_TarjetaUsuario_idx` (`idTarjeta` ASC) ,
  CONSTRAINT `FK_UsuarioTarjeta`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `PetHero`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_TarjetaUsuario`
    FOREIGN KEY (`idTarjeta`)
    REFERENCES `PetHero`.`Tarjetas` (`idTarjetas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `PetHero`.`SolicitudCambio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`SolicitudCambio` (
	`idSolicitudCambio` INT NOT NULL AUTO_INCREMENT,
    `idUsuario` INT NOT NULL,
    `fecha` DATETIME NOT NULL,
    `estado` INT DEFAULT 0,
    PRIMARY KEY(`idSolicitudCambio`),
    CONSTRAINT `FK_SolicitudUsuario`
		FOREIGN KEY(`idUsuario`)
        REFERENCES `PetHero`.`Usuarios` (`idUsuario`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `PetHero`.`Chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`Chat` (
  `idChat` INT NOT NULL AUTO_INCREMENT,
  `idDuenio` INT NOT NULL,
  `idGuardian` INT NOT NULL,
  PRIMARY KEY (`idChat`),
  INDEX `chat_duenio_idx` (`idDuenio` ASC) VISIBLE,
  INDEX `chat_guardian_idx` (`idGuardian` ASC) VISIBLE,
  CONSTRAINT `chat_duenio`
    FOREIGN KEY (`idDuenio`)
    REFERENCES `PetHero`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `chat_guardian`
    FOREIGN KEY (`idGuardian`)
    REFERENCES `PetHero`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `PetHero`.`Mensaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PetHero`.`Mensaje` (
  `idMensaje` INT NOT NULL AUTO_INCREMENT,
  `idRemitente` INT NOT NULL,
  `texto` VARCHAR(250) NOT NULL,
  `idChat` INT NOT NULL,
  PRIMARY KEY (`idMensaje`),
	FOREIGN KEY (`idChat`)
    REFERENCES `PetHero`.`Chat` (`idChat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
