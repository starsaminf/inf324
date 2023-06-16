-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:33065
-- Tiempo de generación: 16-06-2023 a las 19:55:06
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
-- Base de datos: `bd_academicos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id` int(11) DEFAULT NULL,
  `nombrecompleto` varchar(30) DEFAULT NULL,
  `coddepto` varchar(2) DEFAULT NULL,
  `promedio` float DEFAULT NULL,
  `cidentidad` varchar(7) DEFAULT NULL,
  `cnacimiento` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `nombrecompleto`, `coddepto`, `promedio`, `cidentidad`, `cnacimiento`) VALUES
(25, 'Mayo', '03', 50, 'no', 'no'),
(31, 'Mollo123', '02', 45, NULL, NULL),
(32, 'Julia', '02', 78, '', ''),
(34, 'Mercedes', '04', 87, NULL, NULL),
(36, 'Cameron', '04', 88, NULL, NULL),
(40, 'vin diesil', '03', 90, NULL, NULL),
(21, 'Steve', '03', 75, 'si', 'si');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
