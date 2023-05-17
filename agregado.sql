-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-05-2023 a las 18:43:37
-- Versión del servidor: 8.0.31
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operadores`
--

DROP TABLE IF EXISTS `operadores`;
CREATE TABLE IF NOT EXISTS `operadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_categoria` int NOT NULL,
  `id_marca` int NOT NULL,
  `cantidad` int NOT NULL,
  `valor` float NOT NULL,
  `caducidad` date NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_marca` (`id_marca`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



/* SP */



/* SP INSERTAR */

/* SP INSERTAR PRODUCTO */

DELIMITER $$
CREATE PROCEDURE insertar_producto(
  IN nombre VARCHAR(100),
  IN id_categoria INT,
  IN id_marca INT,
  IN cantidad INT,
  IN valor float,
  IN caducidad DATE,
  IN estado int
)
BEGIN
  INSERT INTO productos (nombre, id_categoria, id_marca, cantidad, valor, caducidad, estado) 
  VALUES (nombre, id_categoria, id_marca, cantidad, valor, caducidad, estado);
END $$
DELIMITER ;

/* SP INSERTAR CATEGORIA */

DELIMITER $$

CREATE PROCEDURE insertar_categoria(
    IN p_nombre varchar(200),
	IN estado int
)
BEGIN
    INSERT INTO categorias (nombre, estado) VALUES (p_nombre, estado);
END $$

DELIMITER ;


/* SP INSERTAR MARCA */

DELIMITER $$

CREATE PROCEDURE insertar_marca(
    IN nombre varchar(200),
	IN estado int
)
BEGIN
    INSERT INTO marcas (nombre, estado) VALUES (nombre, estado);
END $$

DELIMITER ;



/* SP DELETE PRODUCTO */

DELIMITER $$
CREATE PROCEDURE sp_eliminar_producto(
    IN producto_id INT,
    IN nuevo_estado INT
)
BEGIN

    UPDATE productos
    SET estado = nuevo_estado
    WHERE id = producto_id;
END$$

DELIMITER ;

/* SP DELETE CATEGORIA */
DELIMITER $$
CREATE PROCEDURE sp_eliminar_categoria(
    IN categoria_id INT,
    IN nuevo_estado INT
)
BEGIN

    UPDATE productos
    SET estado = nuevo_estado
    WHERE id = marca_id;
END$$

DELIMITER ;



/* SP DELETE MARCA */

DELIMITER $$
CREATE PROCEDURE sp_eliminar_marca(
    IN marca_id INT,
    IN nuevo_estado INT
)
BEGIN

    UPDATE productos
    SET estado = nuevo_estado
    WHERE id = marca_id;
END$$

DELIMITER ;





DELIMITER $$
CREATE PROCEDURE `InsertarOperador` (
IN `p_usuario` VARCHAR(200), 
IN `p_pass` VARCHAR(200), 
IN `p_estado` INT)  
 BEGIN
    INSERT INTO operadores (usuario, pass, estado)
    VALUES (p_usuario, p_pass, p_estado);
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_eliminar_operador(
    IN operador_id INT,
    IN nuevo_estado INT
)
BEGIN

    UPDATE operadores
    SET estado = nuevo_estado
    WHERE id = operadores_id;
END$$

DELIMITER ;