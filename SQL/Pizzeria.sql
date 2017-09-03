
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `pizza_cut` ;
-- -----------------------------------------------------
-- Schema pizza_cut
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pizza_cut` DEFAULT CHARACTER SET utf8 ;
USE `pizza_cut` ;

-- -----------------------------------------------------
-- Table `pizza_cut`.`Tipo_Cuentas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pizza_cut`.`Tipo_Cuentas` ;


CREATE TABLE IF NOT EXISTS `pizza_cut`.`Tipo_Cuentas` (
  `idtipo_cuenta` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtipo_cuenta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizza_cut`.`Cuentas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pizza_cut`.`Cuentas` ;


CREATE TABLE IF NOT EXISTS `pizza_cut`.`Cuentas` (
  `idcuenta` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL UNIQUE,
  `clave` VARCHAR(255) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `idtipo_cuenta` INT NOT NULL,
  PRIMARY KEY (`idcuenta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizza_cut`.`Estados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pizza_cut`.`Estados` ;

CREATE TABLE IF NOT EXISTS `pizza_cut`.`Estados` (
  `idestado` INT NOT NULL AUTO_INCREMENT,
  `descripcion_estados` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idestado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizza_cut`.`Tipo_Items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pizza_cut`.`Tipo_Items` ;

CREATE TABLE IF NOT EXISTS `pizza_cut`.`Tipo_Items` (
  `idtipo_item` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtipo_item`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizza_cut`.`Items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pizza_cut`.`Items` ;

CREATE TABLE IF NOT EXISTS `pizza_cut`.`Items` (
  `iditem` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(255) NOT NULL,
  `nombre_item` VARCHAR(45) NOT NULL,
  `idtipo_item` INT NOT NULL,
  `precio` FLOAT UNSIGNED NOT NULL,
  PRIMARY KEY (`iditem`),
  CONSTRAINT `idtipo_item`
    FOREIGN KEY (`idtipo_item`)
    REFERENCES `pizza_cut`.`Tipo_Items` (`idtipo_item`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `idtipo_item_idx` ON `pizza_cut`.`Items` (`idtipo_item` ASC);


-- -----------------------------------------------------
-- Table `pizza_cut`.`Pedidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pizza_cut`.`Pedidos` ;

CREATE TABLE IF NOT EXISTS `pizza_cut`.`Pedidos` (
  `idpedido` INT NOT NULL AUTO_INCREMENT,
  `precio_pagar` FLOAT UNSIGNED NOT NULL,
  `idestado_p` INT NOT NULL,
  `idcuenta_p` INT NOT NULL,
  `datetime_p` DATETIME NOT NULL,
  PRIMARY KEY (`idpedido`),
  CONSTRAINT `idestados_p`
    FOREIGN KEY (`idestado_p`)
    REFERENCES `pizza_cut`.`Estados` (`idestado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idCuenta_p`
    FOREIGN KEY (`idcuenta_p`)
    REFERENCES `pizza_cut`.`Cuentas` (`idcuenta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `idestado_idx` ON `pizza_cut`.`Pedidos` (`idestado_p` ASC);

CREATE INDEX `idcuenta_idx` ON `pizza_cut`.`Pedidos` (`idcuenta_p` ASC);

-- -----------------------------------------------------
-- Table `pizza_cut`.`Pedidos_has_Items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pizza_cut`.`Pedidos_has_Items` ;

CREATE TABLE IF NOT EXISTS `pizza_cut`.`Pedidos_has_Items` (
  `idpedidos_has_item` INT NOT NULL AUTO_INCREMENT,
  `idpedido_phi` INT NOT NULL,
  `iditem_phi` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `precio_parcial` FLOAT NULL DEFAULT NULL,
  PRIMARY KEY (`idpedidos_has_item`),
  CONSTRAINT `iditem_phi`
    FOREIGN KEY (`iditem_phi`)
    REFERENCES `pizza_cut`.`Items` (`iditem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idpedido_phi`
    FOREIGN KEY (`idpedido_phi`)
    REFERENCES `pizza_cut`.`Pedidos` (`idpedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `iditem_idx` ON `pizza_cut`.`Pedidos_has_Items` (`iditem_phi` ASC);

CREATE INDEX `idpedido_idx` ON `pizza_cut`.`Pedidos_has_Items` (`idpedido_phi` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- ---------------------------------------------------------
-- LLENANDO TABLAS xd
-- ---------------------------------------------------------

INSERT INTO tipo_items (descripcion) VALUES ("pizzas"),("gaseosas");

INSERT INTO tipo_cuentas (descripcion) VALUES ("DefaultUser"), ("Admin"), ("Master");

INSERT INTO cuentas (nombre,apellido,direccion,email,clave,telefono,idtipo_cuenta)   
    VALUES
    ("Julia","Scotto","Castex 3515","juliscotto@gmail.com", "dc76e9f0c0006e8f919e0c515c66dbba3982f785","12345646", 
    (SELECT idtipo_cuenta FROM Tipo_Cuentas WHERE descripcion = "Master")),

    ("Florencia","Vela","Cramer 1667","flor.p.vela@gmail.com", "dc76e9f0c0006e8f919e0c515c66dbba3982f785","12345646", 
    (SELECT idtipo_cuenta FROM Tipo_Cuentas WHERE descripcion = "Master")),

    ("Tomas","Poetita","Amsterdam","putito@gmail.com", "","12345646", 
    (SELECT idtipo_cuenta FROM Tipo_Cuentas WHERE descripcion = "Admin")),

    ("Eliseo","Morenito","Puerto Madero xdxd","eliseomoreno13@gmail.com", "7c4a8d09ca3762af61e59520943dc26494f8941b","12345646", 
    (SELECT idtipo_cuenta FROM Tipo_Cuentas WHERE descripcion = "DefaultUser")),

    ("Tomas","Vukasovic","Far far away","tomas.vukasovic@comunidad.ub.edu.ar", "7c4a8d09ca3762af61e59520943dc26494f8941b","12345646", 
    (SELECT idtipo_cuenta FROM Tipo_Cuentas WHERE descripcion = "DefaultUser")),

    ("Ignacio","Mendoza","Tigre, con su abuela","nacho.fernandez@live.com.ar", "7c4a8d09ca3762af61e59520943dc26494f8941b","12345646", 
    (SELECT idtipo_cuenta FROM Tipo_Cuentas WHERE descripcion = "DefaultUser")),
    
    ("Leonardo","Antola","Juramento y Algo mas","leonardoantola@gmail.com", "7c4a8d09ca3762af61e59520943dc26494f8941b","12345646", 
    (SELECT idtipo_cuenta FROM Tipo_Cuentas WHERE descripcion = "DefaultUser")),
    
    ("Gabriela","Castaneda","Palpa","gabriela.castaneda@comunidad.ub.edu.ar", "7c4a8d09ca3762af61e59520943dc26494f8941b","12345646", 
    (SELECT idtipo_cuenta FROM Tipo_Cuentas WHERE descripcion = "DefaultUser")),
    
    ("Matias","Gutierrez","Munro? xd ni idea","matueg1996@gmail.com", "7c4a8d09ca3762af61e59520943dc26494f8941b","12345646", 
    (SELECT idtipo_cuenta FROM Tipo_Cuentas WHERE descripcion = "DefaultUser"));

INSERT INTO items (descripcion, nombre_item, idtipo_item,precio)   
    VALUES
    ("Masa a la piedra, queso muzarella, salsa de tomate y aceitunas",
    "La Titiosky",
    (SELECT idtipo_item FROM tipo_items WHERE descripcion = "pizzas"),
    230
    ),

    ("La pizza perfecta. Tan perfecta como esta página.",
    "El 10 de Ing de SW 2",
    (SELECT idtipo_item FROM tipo_items WHERE descripcion = "pizzas"),
    10
    ),

    ("Pizza dulce de chocolate Kinder y Kit Kat con leche condensada.",
    "UML - Unica, Magnifica, Lujosa",
    (SELECT idtipo_item FROM tipo_items WHERE descripcion = "pizzas"),
    1230
    ),

    ("Masa a la piedra quemada, aceitunas negras. Muy Grande. Crujiente por fuera pero tierna por dentro. Para 8 personas.",
    "Combo Eliseo Moreno",
    (SELECT idtipo_item FROM tipo_items WHERE descripcion = "pizzas"),
    4
    ),

    ("Pizza de media masa con doble panceta, doble cheddar y repleta de huevos fritos. Tamaño extra grande, para 16 personas.",
    "Achievement Unlocked: Colesterol al 100%",
    (SELECT idtipo_item FROM tipo_items WHERE descripcion = "pizzas"),
    230
    ),

    ("2,5L",
    "Sprite 2,5L",
    (SELECT idtipo_item FROM tipo_items WHERE descripcion = "gaseosas"),
    60
    ),
    ("2L",
    "Paso de los Toros 2L",
    (SELECT idtipo_item FROM tipo_items WHERE descripcion = "gaseosas"),
    50
    ),
    ("2,5L",
    "Fanta 2,5L",
    (SELECT idtipo_item FROM tipo_items WHERE descripcion = "gaseosas"),
    60
    );

    INSERT INTO Estados (descripcion_estados) 
    VALUES 
    ("Sin Confirmar"),
    ("Confirmado"),
    ("En Camino"),
    ("Completado"),
    ("Cancelado");

    INSERT INTO pedidos (precio_pagar, idestado_p, idcuenta_p, datetime_p) 
    VALUES 
    (550,(SELECT idestado FROM Estados WHERE descripcion_estados = "Sin Confirmar"),
    (SELECT idcuenta FROM cuentas WHERE nombre = "Julia" AND apellido = "Scotto"),
    (SELECT NOW())),

    (650,(SELECT idestado FROM Estados WHERE descripcion_estados = "Sin Confirmar"),
    (SELECT idcuenta FROM cuentas WHERE nombre = "Florencia" AND apellido = "Vela"),
    (SELECT NOW())),

    (200,(SELECT idestado FROM Estados WHERE descripcion_estados = "Sin Confirmar"),
    (SELECT idcuenta FROM cuentas WHERE nombre = "Tomas" AND apellido = "Poetita"),
    (SELECT NOW())),

    (150,(SELECT idestado FROM Estados WHERE descripcion_estados = "Cancelado"),
    (SELECT idcuenta FROM cuentas WHERE nombre = "Ignacio" AND apellido = "Mendoza"),
    (SELECT NOW())),

    (700,(SELECT idestado FROM Estados WHERE descripcion_estados = "Confirmado"),
    (SELECT idcuenta FROM cuentas WHERE nombre = "Tomas" AND apellido = "Vukasovic"),
    (SELECT NOW()));
    
INSERT INTO pedidos_has_items (idpedido_phi,iditem_phi,cantidad,precio_parcial)
	VALUES 
    (1, 2, 10, 550),
	(2, 2, 10, 650),
    (3, 2, 10, 200),
    (4, 1, 3, 100),
    (4, 2, 1, 50),
    (5, 6, 2, 700);

-- ---------------------------------------------------------
-- SELECT ALL
-- ---------------------------------------------------------
 -- SELECT * FROM tipo_items;
 -- SELECT * FROM tipo_cuentas;
 -- SELECT * FROM cuentas;
 -- SELECT * FROM items;
 -- SELECT * FROM Estados;
 -- SELECT * FROM pedidos;
 -- SELECT * FROM pedidos_has_items;
 
 
 -- asdasdasd query
 
--  SELECT idpedido as "Nro pedido", nombre_item AS Pedido, direccion AS Direccion, 
-- precio_pagar AS Monto, descripcion_estados AS Estado
-- FROM pedidos, Pedidos_has_Items, Items, cuentas, estados 
-- WHERE idpedido = idpedido_phi AND idcuenta = idcuenta_p AND idestado = idestado_p
-- AND iditem = iditem_phi;
