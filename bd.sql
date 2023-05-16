-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-05-2023 a las 02:33:57
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdarreglada`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_categoria` (IN `p_id` INT, IN `p_estado` INT)   BEGIN
  UPDATE operadores
  SET estado = p_estado
  WHERE id = p_id;

  IF p_estado = 1 THEN
    SELECT id, usuario, pass, estado
    FROM operadores
    WHERE id = p_id;
  END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_marca` (IN `p_id` INT, IN `p_estado` INT)   BEGIN
  UPDATE marcas
  SET estado = p_estado
  WHERE id = p_id;

  IF p_estado = 0 THEN
    SELECT 'El registro ha sido eliminado.';
  ELSE
    SELECT * FROM marcas WHERE id = p_id;
  END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarOperador` (IN `p_usuario` VARCHAR(200), IN `p_pass` VARCHAR(200), IN `p_estado` INT)   BEGIN
    INSERT INTO operadores (usuario, pass, estado)
    VALUES (p_usuario, p_pass, p_estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_categoria` (IN `p_nombre` VARCHAR(200), IN `estado` INT)   BEGIN
    INSERT INTO categorias (nombre, estado) VALUES (p_nombre, estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_marca` (IN `p_nombre` VARCHAR(200), IN `estado` INT)   BEGIN
    INSERT INTO marcas (nombre, estado) VALUES (p_nombre, estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_producto` (IN `nombre` VARCHAR(100), IN `id_categoria` INT, IN `id_marca` INT, IN `cantidad` INT, IN `valor` FLOAT, IN `caducidad` DATE, IN `estado` INT)   BEGIN
  INSERT INTO productos (nombre, id_categoria, id_marca, cantidad, valor, caducidad, estado) 
  VALUES (nombre, id_categoria, id_marca, cantidad, valor, caducidad, estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_categorias` ()   BEGIN
  SELECT *
  FROM categorias
  WHERE estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_marcas` ()   BEGIN
    SELECT *
    FROM marcas
    WHERE estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_productos` ()   BEGIN
  SELECT p.id, p.nombre as nombre, c.nombre as categoria, m.nombre as marca, p.cantidad, p.valor, p.caducidad
  FROM productos p
  INNER JOIN categorias c ON p.id_categoria = c.id
  INNER JOIN marcas m ON p.id_marca = m.id
  WHERE p.estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_productos_por_categoria` (IN `p_nombre_cat` VARCHAR(50))   BEGIN
  SELECT p.id, p.nombre as nombre, c.nombre as categoria, m.nombre as marca, p.cantidad, p.valor, p.caducidad
  FROM productos p
  INNER JOIN categorias c ON p.id_categoria = c.id
  INNER JOIN marcas m ON p.id_marca = m.id
  WHERE c.nombre = p_nombre_cat
  AND p.estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_productos_por_marca` (IN `p_nombre_marca` VARCHAR(50))   BEGIN
  SELECT p.id, p.nombre as nombre, c.nombre as categoria, m.nombre as marca, p.cantidad, p.valor, p.caducidad
  FROM productos p
  INNER JOIN categorias c ON p.id_categoria = c.id
  INNER JOIN marcas m ON p.id_marca = m.id
  WHERE m.nombre = p_nombre_marca
  AND p.estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarMarca` (IN `marca_id` INT, IN `marca_nombre` VARCHAR(200))   BEGIN
    UPDATE marcas SET
        nombre = marca_nombre
    WHERE id = marca_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_categoria` (IN `p_id` INT, IN `p_nombre` VARCHAR(200))   BEGIN
    UPDATE categorias SET
        nombre = p_nombre
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_producto` (IN `p_id` INT, IN `p_nombre` VARCHAR(100), IN `p_id_categoria` INT, IN `p_id_marca` INT, IN `p_cantidad` INT, IN `p_valor` FLOAT, IN `p_caducidad` DATE)   BEGIN
    UPDATE productos SET
        nombre = p_nombre,
        id_categoria = p_id_categoria,
        id_marca = p_id_marca,
        cantidad = p_cantidad,
        valor = p_valor,
        caducidad = p_caducidad
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_producto` (IN `producto_id` INT, IN `nuevo_estado` INT)   BEGIN
    UPDATE productos
    SET estado = nuevo_estado
    WHERE id = producto_id;

    IF nuevo_estado = 0 THEN
        SELECT NULL AS nombre, NULL AS id_categoria, NULL AS id_marca, NULL AS cantidad, NULL AS valor, NULL AS caducidad;
    ELSE
        SELECT nombre, id_categoria, id_marca, cantidad, valor, caducidad
        FROM productos
        WHERE id = producto_id;
    END IF;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operadores`
--

CREATE TABLE `operadores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `operadores`
--

INSERT INTO `operadores` (`id`, `usuario`, `pass`, `estado`) VALUES
(1, 'cesquivel', '1104', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `operadores`
--
ALTER TABLE `operadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
