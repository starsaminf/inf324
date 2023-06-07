-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2023 a las 18:46:55
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academica2`
--
CREATE DATABASE IF NOT EXISTS `academica2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `academica2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `codMateria` varchar(7) DEFAULT NULL,
  `Paralelo` varchar(3) DEFAULT NULL,
  `idEstudiante` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `codMateria` varchar(7) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `semestre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`codMateria`, `nombre`, `semestre`) VALUES
('INF-111', 'Programacion 1', 'Primero'),
('INF-121', 'Programación Orientada a Objetos', 'Segundo'),
('INF-131', 'Estructuras de Datos', 'Tercero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paralelo`
--

CREATE TABLE `paralelo` (
  `id` int(11) NOT NULL,
  `codMateria` varchar(7) DEFAULT NULL,
  `Paralelo` varchar(3) DEFAULT NULL,
  `horario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paralelo`
--

INSERT INTO `paralelo` (`id`, `codMateria`, `Paralelo`, `horario`) VALUES
(2, 'INF-111', 'A', '08:00 - 10:00'),
(4, 'INF-131', 'A', '10:00 - 12:00'),
(6, 'INF-121', 'A', '08:00 - 10:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` varchar(3) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `paterno` varchar(20) DEFAULT NULL,
  `materno` varchar(20) DEFAULT NULL,
  `ci` varchar(8) DEFAULT NULL,
  `matricula` varchar(7) DEFAULT NULL,
  `rol` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `paterno`, `materno`, `ci`, `matricula`, `rol`) VALUES
('01', 'estudiante', 'Lopez', 'Lopez', '12345741', '1787100', 'estudiante'),
('02', 'kardex', 'Rodríguez', 'Martínez', '56789012', '1787102', 'kardex'),
('03', 'estudiante2', 'Lopez', 'Lopez', '12345741', '1787100', 'estudiante'),
('04', 'estudiante3', 'Lopez', 'Lopez', '12345741', '1787100', 'estudiante');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`codMateria`);

--
-- Indices de la tabla `paralelo`
--
ALTER TABLE `paralelo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paralelo`
--
ALTER TABLE `paralelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Base de datos: `wf`
--
CREATE DATABASE IF NOT EXISTS `wf` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `wf`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujo`
--

CREATE TABLE `flujo` (
  `id` int(11) NOT NULL,
  `flujo` varchar(3) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `procesosiguiente` varchar(3) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `rol` varchar(15) DEFAULT NULL,
  `pantalla` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `flujo`
--

INSERT INTO `flujo` (`id`, `flujo`, `proceso`, `procesosiguiente`, `tipo`, `rol`, `pantalla`) VALUES
(1, 'F1', 'P1', 'P2', 'I', 'kardex', 'inicio_proceso'),
(2, 'F1', 'P2', NULL, 'F', 'kardex', 'inicio_sorteo_aleatorio'),
(3, 'F1', 'P3', 'P4', 'P', 'estudiante', 'fecha_inscripcion'),
(4, 'F1', 'P4', NULL, 'C', 'estudiante', 'verifica_fecha_inscripcion'),
(6, 'F1', 'P6', 'P7', 'P', 'estudiante', 'formulario_materias'),
(7, 'F1', 'P7', NULL, 'C', 'estudiante', 'verifica_hay_cupos'),
(8, 'F1', 'P8', NULL, 'P', 'estudiante', 'mensaje_no_hay_cupo'),
(9, 'F1', 'P9', 'P10', 'F', 'estudiante', 'fin'),
(13, 'F1', 'P5', NULL, 'P', 'estudiante', 'muestra_mensaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujocondicional`
--

CREATE TABLE `flujocondicional` (
  `id` int(11) NOT NULL,
  `codFlujo` varchar(3) DEFAULT NULL,
  `codProceso` varchar(3) DEFAULT NULL,
  `codProcesoSi` varchar(3) DEFAULT NULL,
  `codProcesoNo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `flujocondicional`
--

INSERT INTO `flujocondicional` (`id`, `codFlujo`, `codProceso`, `codProcesoSi`, `codProcesoNo`) VALUES
(1, 'F1', 'P4', 'P6', 'P5'),
(2, 'F1', 'P7', 'P9', 'P8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujousuario`
--

CREATE TABLE `flujousuario` (
  `id` int(11) NOT NULL,
  `numerotramite` int(11) DEFAULT NULL,
  `flujo` varchar(3) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `fechainicio` datetime DEFAULT NULL,
  `fechafin` datetime DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `flujousuario`
--

INSERT INTO `flujousuario` (`id`, `numerotramite`, `flujo`, `proceso`, `fechainicio`, `fechafin`, `usuario`) VALUES
(130, 1, 'F1', 'P1', '2023-06-07 12:06:49', '2023-06-07 12:06:52', 'kardex'),
(131, 2, 'F1', 'P2', '2023-06-07 12:06:52', NULL, 'kardex'),
(132, 3, 'F1', 'P4', '2023-06-07 12:06:53', '2023-06-07 12:34:00', 'estudiante'),
(133, 4, 'F1', 'P4', '2023-06-07 12:06:53', NULL, 'estudiante2'),
(134, 5, 'F1', 'P4', '2023-06-07 12:06:53', NULL, 'estudiante3'),
(135, 6, 'F1', 'P7', '2023-06-07 12:06:07', NULL, 'estudiante'),
(136, 7, 'F1', 'P10', '2023-06-07 12:06:09', NULL, 'estudiante');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `flujo`
--
ALTER TABLE `flujo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `flujocondicional`
--
ALTER TABLE `flujocondicional`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `flujousuario`
--
ALTER TABLE `flujousuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `flujo`
--
ALTER TABLE `flujo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `flujocondicional`
--
ALTER TABLE `flujocondicional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `flujousuario`
--
ALTER TABLE `flujousuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
