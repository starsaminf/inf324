-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:33065
-- Tiempo de generación: 16-06-2023 a las 19:55:23
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
-- Base de datos: `proceso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujocondicion`
--

CREATE TABLE `flujocondicion` (
  `codFlujo` varchar(3) NOT NULL,
  `codProceso` varchar(4) NOT NULL,
  `codProcesoSI` varchar(4) NOT NULL,
  `codProcesoNo` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `flujocondicion`
--

INSERT INTO `flujocondicion` (`codFlujo`, `codProceso`, `codProcesoSI`, `codProcesoNo`) VALUES
('F1', 'P5', 'P6', 'P7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `codFlujo` varchar(3) DEFAULT NULL,
  `codProceso` varchar(4) DEFAULT NULL,
  `codProcesoSiguiente` varchar(4) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `codRol` varchar(4) DEFAULT NULL,
  `Pantalla` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`codFlujo`, `codProceso`, `codProcesoSiguiente`, `tipo`, `codRol`, `Pantalla`) VALUES
('F1', 'P1', 'P2', 'I', 'A', 'revision.inc.php'),
('F1', 'P2', 'P3', 'p', 'A', 'resultado.inc.php'),
('F1', 'P3', 'P4', 'p', 'A', 'informe.inc.php'),
('F1', 'P4', 'P5', 'p', 'A', 'envioinf.inc.php'),
('F1', 'P5', 'null', 'p', 'E', 'revisioninf.inc.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `nroTramite` int(11) DEFAULT NULL,
  `codFlujo` varchar(3) DEFAULT NULL,
  `codProceso` varchar(4) DEFAULT NULL,
  `codUsuario` varchar(10) DEFAULT NULL,
  `fechaini` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seguimiento`
--

INSERT INTO `seguimiento` (`nroTramite`, `codFlujo`, `codProceso`, `codUsuario`, `fechaini`, `fechafin`) VALUES
(100, 'F1', 'P1', 'more', '0000-00-00', '0000-00-00'),
(100, 'F1', 'P2', 'more', '0000-00-00', '0000-00-00'),
(100, 'F1', 'P3', 'more', '0000-00-00', '0000-00-00'),
(100, 'F1', 'P3', 'more', '0000-00-00', NULL),
(100, 'F1', 'P1', 'more', '0000-00-00', NULL),
(100, 'F1', 'P1', 'more', '0000-00-00', NULL),
(100, 'F1', 'P1', 'mari', '0000-00-00', NULL),
(1, 'F1', 'P1', 'ricardo', '0000-00-00', '0000-00-00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
