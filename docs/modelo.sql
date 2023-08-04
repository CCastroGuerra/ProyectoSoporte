-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-08-2023 a las 13:25:26
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
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id_modelo` int NOT NULL COMMENT 'primary key',
  `nombre_modelo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `marca_id` int NOT NULL,
  `esActivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id_modelo`, `nombre_modelo`, `marca_id`, `esActivo`) VALUES
(1, 'CS500GDS91', 1, 1),
(2, 'ELITE 8300', 2, 1),
(3, 'H110 PRO-VH PLUS MS-7A15', 3, 1),
(4, 'DG43NB', 4, 1),
(5, 'FALTRON 19EN43S-B', 7, 1),
(6, '1576', 8, 1),
(7, '1113', 8, 1),
(8, 'Sin modelo', 11, 1),
(9, 'Sin modelo', 12, 1),
(10, 'Sin Modelo', 1, 1),
(11, 'Sin Modelo', 2, 1),
(12, 'Sin Modelo', 3, 1),
(13, 'Sin Modelo', 1, 0),
(14, 'Sin Modelo', 4, 1),
(15, 'Sin Modelo', 5, 1),
(16, 'Sin Modelo', 6, 1),
(17, 'Sin Modelo', 7, 1),
(18, 'Sin Modelo', 8, 1),
(19, 'Sin modelo', 13, 1),
(20, 'Sin modelo', 14, 1),
(21, 'Sin modelo', 15, 1),
(22, 'Sin modelo', 16, 1),
(23, 'Sin modelo', 17, 1),
(24, 'Sin modelo', 18, 1),
(25, 'Sin modelo', 19, 1),
(26, 'Sin modelo', 20, 1),
(27, 'Sin modelo', 21, 1),
(28, 'Sin modelo', 22, 1),
(29, 'Sin modelo', 23, 1),
(30, 'CYB C 225', 1, 1),
(31, 'CS500GDS92', 1, 1),
(32, 'VS5858', 18, 1),
(33, 'PRIME H110M-P', 22, 1),
(34, 'INSPIRON 3501', 19, 1),
(35, 'LATITUDE 3490', 19, 1),
(36, 'OPTIPLEX 390', 19, 1),
(37, 'HP PRODESK 400 G4 SFF BUSINESS PC', 6, 1),
(38, 'ELITE 8300', 2, 1),
(39, 'HP 1000', 2, 1),
(40, 'HP 280 G2 SFF BUSSINESS PC', 2, 1),
(41, 'HP 420', 2, 1),
(42, 'HP 420', 2, 1),
(43, 'HP 450 NOTEBOOK', 2, 1),
(44, 'HP COMPAQ', 2, 1),
(45, 'HP COMPAQ ELITE 8300', 2, 1),
(46, 'HP COMPAQ ELITE 8300 SF', 2, 1),
(47, 'HP COMPAQ ELITE 8300 SFF', 2, 1),
(48, 'HP COMPAQ ELITE 8300 SFF - SRP LTNA', 2, 1),
(49, 'HP COMPAQ ELITE 8300 SMALL', 2, 1),
(50, 'HP ELITEDESK 800 G1 SFF', 2, 1),
(51, 'HP PRODESK', 2, 1),
(52, 'HP PRODESK 600 G1 SFF', 2, 1),
(53, 'HP PRODESK 600 G2 SFF', 2, 1),
(54, 'HP Z230 TOWER WORKSTATION', 2, 1),
(55, 'PRODESK 400 G4 SFF', 2, 1),
(56, 'PRODESK 600 G2 SFF', 2, 1),
(57, 'DG43NB', 3, 1),
(58, 'DH61HO', 3, 1),
(59, 'DH61WW', 3, 1),
(60, 'G31-M7 TE', 3, 1),
(61, 'H110 PRO-VH PLUS (MS-7A15)', 3, 1),
(62, 'PRIME H110M-P', 3, 1),
(63, 'PRIME H310M-E', 3, 1),
(64, '81AX', 4, 1),
(65, 'B570', 4, 1),
(66, 'HP COMPAQ ELITE 8300', 4, 1),
(67, 'LENOVO 82C4', 4, 1),
(68, 'LNVNB161216', 4, 1),
(69, 'THINKBOOK 15 G2 ITL', 4, 1),
(70, 'THINKCENTRE', 4, 1),
(71, 'THINKCENTRE M72E', 4, 1),
(72, 'THINKPAD L15 GEN1', 4, 1),
(73, 'MOD. MIC C 378', 14, 1),
(74, 'HP PRODESK 400 G4 SFF BUSINESS PC', 23, 1),
(75, 'IOP240100', 20, 1),
(76, 'M Series', 15, 1),
(77, 'M82', 15, 1),
(78, 'COMMANDER GX', 13, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `marca_id` (`marca_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id_modelo` int NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=79;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
