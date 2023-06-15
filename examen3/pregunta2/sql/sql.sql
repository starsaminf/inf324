SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `imagenes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `cR` int(11) NOT NULL,
  `cG` int(11) NOT NULL,
  `cB` int(11) NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id`, `descripcion`, `cR`, `cG`, `cB`, `color`) VALUES
(1, 'Zona boscosa fuerte', 37, 51, 53, '59A74C'),
(2, 'Zona boscosa debil', 56, 76, 69, '2CE30D'),
(3, 'Tierra arida 1', 140, 127, 102, 'E8A30F'),
(4, 'Tierra arida 2', 126, 114, 97, 'E8A30F'),
(5, 'Tierra arida 3', 115, 104, 86, 'E8A30F'),
(6, 'Tierra arida 4', 129, 121, 95, 'E8A30F'),
(7, 'Tierra arida5 ', 123, 112, 92, 'E8A30F');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;
