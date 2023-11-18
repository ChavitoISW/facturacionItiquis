-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2020 a las 17:45:43
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ceic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla000`
--

CREATE TABLE `tabla000` (
  `trans_compra` char(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `cedula` char(20) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `telefono` varchar(60) NOT NULL,
  `monto` varchar(20) NOT NULL,
  `usuario` char(20) NOT NULL,
  `estado` char(1) NOT NULL,
  `concepto` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla001`
--

CREATE TABLE `tabla001` (
  `trans_compra` char(20) CHARACTER SET utf8 NOT NULL,
  `idcurso` bigint(20) NOT NULL,
  `curso` varchar(600) CHARACTER SET utf8 NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla de cursos matriculados';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla002`
--

CREATE TABLE `tabla002` (
  `cedula` char(20) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `estado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tabla002`
--

INSERT INTO `tabla002` (`cedula`, `nombre`, `usuario`, `clave`, `tipo`, `estado`) VALUES
('0-0000-0000', 'Internet', 'comercio', 'power2kWEB', '1', '1'),
('1-0507-0839', 'Jose HernÃ¡ndez Zamora', '1-0507-0839', '105070839', '1', '1'),
('9-9999-9999', 'Administrador', 'admin', 'power2kWEB', '7', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablabit`
--

CREATE TABLE `tablabit` (
  `usuario` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` varchar(5000) COLLATE utf8_spanish_ci NOT NULL,
  `formapago` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `compago` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla de bitacora';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablamontos`
--

CREATE TABLE `tablamontos` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(5000) COLLATE utf8_spanish_ci NOT NULL,
  `grupo` int(11) NOT NULL,
  `cupo` float NOT NULL,
  `cuporeal` float NOT NULL,
  `monto` float NOT NULL,
  `descuento` float NOT NULL,
  `modalidad` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `instructor` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `horario` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `lugar` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `programacion` int(11) NOT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla de montos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablaprogramaciones`
--

CREATE TABLE `tablaprogramaciones` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla de programaciones';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tabla000`
--
ALTER TABLE `tabla000`
  ADD PRIMARY KEY (`trans_compra`),
  ADD KEY `tabla001_1_idx` (`usuario`);

--
-- Indices de la tabla `tabla001`
--
ALTER TABLE `tabla001`
  ADD PRIMARY KEY (`trans_compra`,`idcurso`);

--
-- Indices de la tabla `tabla002`
--
ALTER TABLE `tabla002`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `tablabit`
--
ALTER TABLE `tablabit`
  ADD PRIMARY KEY (`usuario`,`fecha`);

--
-- Indices de la tabla `tablamontos`
--
ALTER TABLE `tablamontos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tablaprogramaciones`
--
ALTER TABLE `tablaprogramaciones`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
