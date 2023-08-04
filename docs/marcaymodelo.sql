-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-08-2023 a las 15:38:41
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
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `id_componentes` int NOT NULL COMMENT 'primary key',
  `tipo_componentes_id` int DEFAULT NULL,
  `clase_componentes_id` int DEFAULT NULL,
  `marca_id` int DEFAULT NULL,
  `modelo_id` int DEFAULT NULL,
  `serie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `margesi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `componentes_capacidad` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `estado_id` int DEFAULT NULL,
  `producto_id` int DEFAULT NULL,
  `tipo_alimentacion` int NOT NULL DEFAULT '1',
  `tipo_conector` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'VGA',
  `es_activo` int NOT NULL DEFAULT '1',
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `fecha_modify` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `componentes`
--

INSERT INTO `componentes` (`id_componentes`, `tipo_componentes_id`, `clase_componentes_id`, `marca_id`, `modelo_id`, `serie`, `margesi`, `componentes_capacidad`, `estado_id`, `producto_id`, `tipo_alimentacion`, `tipo_conector`, `es_activo`, `fecha_alta`, `fecha_borrado`, `fecha_modify`) VALUES
(1, 6, 2, 28, 5, '304NDUNB5382', '', '0', 3, NULL, 2, 'VGA', 1, '2023-08-04 14:35:19', NULL, '2023-08-04 15:07:48'),
(2, 6, 2, 18, 81, 'ADV4021N22A030699', '', '0', 1, NULL, 2, 'VGA', 1, '2023-08-04 14:38:42', NULL, '2023-08-04 15:08:29'),
(3, 6, 2, 19, 90, 'CM-07XJH5-FCC00-07G-A22I-A08', '', '0', 1, NULL, 1, 'VGA', 1, '2023-08-04 14:45:10', NULL, '2023-08-04 15:08:44'),
(4, 6, 2, 27, 104, 'V2001848', '740881870011', '0', 3, NULL, 1, 'VGA', 1, '2023-08-04 14:47:28', NULL, '2023-08-04 15:21:36'),
(5, 6, 2, 28, 108, '201NTTQ0F897', '740880370051', '0', 1, NULL, 2, 'HDMI', 1, '2023-08-04 14:50:12', NULL, '2023-08-04 15:21:00'),
(6, 2, 2, 1, 1, 'test67238768gug', '', '0', 1, NULL, 1, 'VGA', 1, '2023-08-04 15:09:58', NULL, NULL);

--
-- Disparadores `componentes`
--
DELIMITER $$
CREATE TRIGGER `COMPONENTE_ISACTIVO_BEFORE_LASTUPDATE` BEFORE UPDATE ON `componentes` FOR EACH ROW BEGIN
	IF(old.es_activo <> new.es_activo) THEN
    	IF(new.es_activo = 0) THEN 
        	SET new.fecha_borrado = CURRENT_TIMESTAMP;
         ELSE SET new.fecha_borrado = null;
        END IF;
    END IF;

END
$$
DELIMITER ;

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
(7, 'LG', 4, 1),
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
(23, 'Prodesk', 4, 1),
(24, 'AOC', 1, 1),
(25, 'BEN Q', 1, 1),
(26, 'HP-Monitores', 1, 1),
(27, 'Lenovo-Monitores', 1, 1),
(28, 'LG-Monitores', 1, 1),
(29, 'NOC', 1, 1),
(30, 'Samsung', 1, 1),
(31, 'VIEWSONIC', 1, 1),
(32, 'WIDE', 1, 1),
(33, 'GENERICO', 4, 1);

--
-- Disparadores `marca`
--
DELIMITER $$
CREATE TRIGGER `despuesdenuevamarca` AFTER INSERT ON `marca` FOR EACH ROW BEGIN
    insert into modelo (nombre_modelo,marca_id,`esActivo`) values("Sin modelo",new.id_marca,1);
END
$$
DELIMITER ;

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
(5, 'FALTRON 19EN43S-B', 28, 1),
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
(78, 'COMMANDER GX', 13, 1),
(79, '19EN43SA', 18, 1),
(80, '919WVA', 18, 1),
(81, 'ADV-4021N', 18, 1),
(82, 'Sin modelo', 24, 1),
(83, 'E2070S', 24, 1),
(84, 'E2070SWHN', 24, 1),
(85, 'E5070S', 24, 1),
(86, 'Sin modelo', 25, 1),
(87, 'G6I5HDPL', 25, 1),
(88, '19EN43SA', 19, 1),
(89, 'DELL FLAT PANEL', 19, 1),
(90, 'E2016HV', 19, 1),
(91, 'HP LV1911', 19, 1),
(92, 'LV1911', 19, 1),
(93, 'Sin modelo', 26, 1),
(94, 'Z221', 26, 1),
(95, 'V202', 26, 1),
(96, 'V193b', 26, 1),
(97, 'LV1911', 26, 1),
(98, 'HP V202', 26, 1),
(99, 'HP V193b', 26, 1),
(100, 'HP LV1911', 26, 1),
(101, 'HEWLETT-PACKARD', 26, 1),
(102, 'Sin modelo', 27, 1),
(103, 'LED BACKLIGHT', 27, 1),
(104, 'THINKVISION', 27, 1),
(105, 'Sin modelo', 28, 1),
(106, '19EN43S-B', 28, 1),
(107, '19M38A-B', 28, 1),
(108, '20MK400H', 28, 1),
(109, 'E1951SR', 28, 1),
(110, 'FALTROJN W1943SB-PF', 28, 1),
(111, 'FALTRON E1951', 28, 1),
(112, 'FALTRON W1943SB', 28, 1),
(113, 'FLATRON 19EN43S-B', 28, 1),
(114, 'FLATRON E1951', 28, 1),
(115, 'FLATRON E1951S-BN', 28, 1),
(116, 'FLATRON E1951SZ', 28, 1),
(117, 'FLATRON W1943SS', 28, 1),
(118, 'FLATRON W2043T', 28, 1),
(119, 'HP LV1911', 28, 1),
(120, 'LED 19EN43', 28, 1),
(121, 'FALTRON IPS236', 28, 1),
(122, 'Sin modelo', 29, 1),
(123, 'E2070SWHN', 29, 1),
(124, 'LED BACKLIGHT', 29, 1),
(125, 'Sin modelo', 30, 1),
(126, 'S20D300', 30, 1),
(127, 'SYNCMASTER 933', 30, 1),
(128, 'SYNCMASTER 933NW', 30, 1),
(129, 'Sin modelo', 31, 1),
(130, 'VS14768', 31, 1),
(131, 'Sin modelo', 32, 1),
(132, 'IDP2400WD', 32, 1),
(133, 'Sin modelo', 33, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id_componentes`),
  ADD KEY `tipo_componentes_id` (`tipo_componentes_id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `modelo_id` (`modelo_id`),
  ADD KEY `estado_id` (`estado_id`),
  ADD KEY `clase_componentes_id` (`clase_componentes_id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`),
  ADD KEY `categoria_marca_id` (`categoria_marca_id`);

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
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id_componentes` int NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id_modelo` int NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=134;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD CONSTRAINT `componentes_ibfk_1` FOREIGN KEY (`tipo_componentes_id`) REFERENCES `tipo_componentes` (`id_tipo_componentes`),
  ADD CONSTRAINT `componentes_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_productos`),
  ADD CONSTRAINT `componentes_ibfk_3` FOREIGN KEY (`modelo_id`) REFERENCES `modelo` (`id_modelo`),
  ADD CONSTRAINT `componentes_ibfk_4` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `componentes_ibfk_5` FOREIGN KEY (`clase_componentes_id`) REFERENCES `clase_componentes` (`id_clase_componentes`);

--
-- Filtros para la tabla `marca`
--
ALTER TABLE `marca`
  ADD CONSTRAINT `marca_ibfk_1` FOREIGN KEY (`categoria_marca_id`) REFERENCES `categoria_marca` (`id_categoria_marca`);

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
