-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-08-2023 a las 13:24:56
-- Versión del servidor: 8.0.33
-- Versión de PHP: 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_fechasyrel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int NOT NULL COMMENT 'primary key',
  `nombre_marca` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoria_marca_id` int DEFAULT NULL,
  `esActivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre_marca`, `categoria_marca_id`, `esActivo`) VALUES
(1, 'XTECH', 4, 1),
(2, 'HP', 4, 1),
(3, 'INTEL', 4, 1),
(4, 'LENOVO', 4, 1),
(5, 'CYBERLINK', 1, 1),
(6, 'HALION', 1, 1),
(7, 'LG', 1, 1),
(8, 'MICROSOFT', 5, 1),
(11, 'ADATA', 4, 1),
(12, 'Western digital', 2, 1),
(13, 'Vastec', 4, 1),
(14, 'Micropnics', 4, 1),
(15, 'Thinkcentre', 4, 1),
(16, 'Enkore Apex', 4, 1),
(17, 'Cybertel', 4, 1),
(18, 'Advance', 4, 1),
(19, 'Dell', 4, 1),
(20, 'Thermaltake', 4, 1),
(21, 'Teros', 4, 1),
(22, 'AsusTek', 4, 1),
(23, 'Prodesk', 4, 1);

--
-- Disparadores `marca`
--
DELIMITER $$
CREATE TRIGGER `despuesdenuevamarca` AFTER INSERT ON `marca` FOR EACH ROW BEGIN
    insert into modelo (nombre_modelo,marca_id,`esActivo`) values("Sin modelo",new.id_marca,1);
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`),
  ADD KEY `categoria_marca_id` (`categoria_marca_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `marca`
--
ALTER TABLE `marca`
  ADD CONSTRAINT `marca_ibfk_1` FOREIGN KEY (`categoria_marca_id`) REFERENCES `categoria_marca` (`id_categoria_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
