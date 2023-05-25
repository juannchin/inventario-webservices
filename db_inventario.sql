-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2023 a las 04:43:18
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_inventario`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_categoria` (IN `categoria_id` INT, IN `nuevo_nombre` VARCHAR(200), IN `nuevo_estado` INT)  BEGIN
    UPDATE categorias
    SET nombre = nuevo_nombre
    WHERE id = categoria_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_marca` (IN `marca_id` INT, IN `nuevo_nombre` VARCHAR(200), IN `nuevo_estado` INT)  BEGIN
  UPDATE marcas
  SET nombre = nuevo_nombre
  WHERE id = marca_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_operador` (IN `p_id` INT, IN `p_usuario` VARCHAR(200), IN `p_pass` VARCHAR(200), IN `p_estado` INT)  BEGIN
  UPDATE operadores
  SET usuario = p_usuario,
      pass = p_pass,
      estado = p_estado
  WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_producto` (IN `producto_id` INT, IN `nuevo_nombre` VARCHAR(100), IN `nueva_categoria_id` INT, IN `nueva_marca_id` INT, IN `nueva_cantidad` INT, IN `nuevo_valor` FLOAT, IN `nueva_caducidad` DATE, IN `nuevo_estado` INT)  BEGIN
  UPDATE productos
  SET nombre = nuevo_nombre,
      id_categoria = nueva_categoria_id,
      id_marca = nueva_marca_id,
      cantidad = nueva_cantidad,
      valor = nuevo_valor,
      caducidad = nueva_caducidad
  WHERE id = producto_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarOperador` (IN `p_usuario` VARCHAR(200), IN `p_pass` VARCHAR(200), IN `p_estado` INT)  BEGIN
    INSERT INTO operadores (usuario, pass, estado)
    VALUES (p_usuario, p_pass, p_estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_categoria` (IN `p_nombre` VARCHAR(200), IN `estado` INT)  BEGIN
    INSERT INTO categorias (nombre, estado) VALUES (p_nombre, estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_marca` (IN `nombre` VARCHAR(200), IN `estado` INT)  BEGIN
    INSERT INTO marcas (nombre, estado) VALUES (nombre, estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_producto` (IN `nombre` VARCHAR(100), IN `id_categoria` INT, IN `id_marca` INT, IN `cantidad` INT, IN `valor` FLOAT, IN `caducidad` DATE, IN `estado` INT)  BEGIN
  INSERT INTO productos (nombre, id_categoria, id_marca, cantidad, valor, caducidad, estado) 
  VALUES (nombre, id_categoria, id_marca, cantidad, valor, caducidad, estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_categorias` ()  BEGIN
  SELECT *
  FROM categorias
  WHERE estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_marcas` ()  BEGIN
    SELECT *
    FROM marcas
    WHERE estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_operadores` ()  BEGIN
    SELECT *
    FROM operadores
    WHERE estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_productos` ()  BEGIN
  SELECT p.id, p.nombre as nombre, c.nombre as categoria, m.nombre as marca, p.cantidad, p.valor, p.caducidad
  FROM productos p
  INNER JOIN categorias c ON p.id_categoria = c.id
  INNER JOIN marcas m ON p.id_marca = m.id
  WHERE p.estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_categoria` (IN `categoria_id` INT, IN `nuevo_estado` INT)  BEGIN

    UPDATE categorias
    SET estado = nuevo_estado
    WHERE id = categoria_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_marca` (IN `marca_id` INT, IN `nuevo_estado` INT)  BEGIN

    UPDATE marcas
    SET estado = nuevo_estado
    WHERE id = marca_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_operador` (IN `operador_id` INT, IN `nuevo_estado` INT)  BEGIN

    UPDATE operadores
    SET estado = nuevo_estado
    WHERE id = operadores_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_producto` (IN `producto_id` INT, IN `nuevo_estado` INT)  BEGIN

    UPDATE productos
    SET estado = nuevo_estado
    WHERE id = producto_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`) VALUES
(1, 'Jabones', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `estado`) VALUES
(1, 'MAXI ESPUMA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operadores`
--

CREATE TABLE `operadores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `operadores`
--

INSERT INTO `operadores` (`id`, `usuario`, `pass`, `estado`) VALUES
(1, 'maddie', '1234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` float NOT NULL,
  `caducidad` date NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `id_categoria`, `id_marca`, `cantidad`, `valor`, `caducidad`, `estado`) VALUES
(1, 'Japon de lavar', 1, 1, 12, 13.6, '2023-05-11', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `operadores`
--
ALTER TABLE `operadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_marca` (`id_marca`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `operadores`
--
ALTER TABLE `operadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
