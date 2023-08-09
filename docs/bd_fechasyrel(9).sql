-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2023 a las 15:58:37
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_equipo` (IN `p_id` INT, IN `p_serie` VARCHAR(50), IN `p_margesi` VARCHAR(50), IN `p_marca_id` INT, IN `p_modelo_id` INT, IN `p_tipo_equipo_id` INT, IN `p_area_id` INT, IN `p_clientes_id` INT, IN `p_estado_id` INT, IN `p_ip` VARCHAR(50), IN `p_mac` VARCHAR(50), IN `p_nomeq` VARCHAR(50), IN `p_usloc` VARCHAR(50))   BEGIN
  SET @v_codigo = CONCAT('E', LPAD((SELECT COUNT(*) + 1 FROM equipos), 6, '0'));
 
  INSERT INTO equipos (
    id_equipos, 
    cod_equipo, 
    serie, 
    margesi, 
    marca_id, 
    modelo_id, 
    tipo_equipo_id, 
    area_id, 
    clientes_id, 
    estado_id, 
    ip, 
    mac,
    nombre_equipo,
    usuario_local
  )
  VALUES (
    p_id,
    @v_codigo,
    p_serie,
    p_margesi,
    p_marca_id,
    p_modelo_id,
    p_tipo_equipo_id,
    p_area_id,
    p_clientes_id,
    p_estado_id,
    p_ip,
    p_mac,
    p_nomeq,
    p_usloc
  )ON DUPLICATE KEY UPDATE
    serie = (p_serie),
    margesi = (p_margesi),
    marca_id = (p_marca_id),
    modelo_id = (p_modelo_id),
    tipo_equipo_id = (p_tipo_equipo_id),
    area_id = (p_area_id),
    clientes_id = (p_clientes_id),
    estado_id = (p_estado_id),
    ip = (p_ip),
    mac = (p_mac),
    nombre_equipo = (p_nomeq),
    usuario_local = (p_usloc);

  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_productos` (IN `p_nombre` VARCHAR(100), IN `p_tipo` INT, IN `p_presentacion` INT, IN `p_cantidad` INT, IN `p_almacen` INT, IN `p_descripcion` VARCHAR(200))   BEGIN
  DECLARE v_codigo VARCHAR(10);
  
  SET v_codigo = (SELECT CONCAT('P', LPAD(COUNT(*) + 1, 3, '0')) FROM productos);
  
  INSERT INTO productos(
    codigo_productos,
    nombre_productos,
    tipo_productos,
    presentacion_productos,
    cantidad_productos,
    almacen_id,
    descripcion_productos,
    esActivo
  )
  VALUES (
    v_codigo,
    p_nombre,
    p_tipo,
    p_presentacion,
    p_cantidad,
    p_almacen,
    p_descripcion,
    1
  );
  
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL COMMENT 'primary key',
  `inventario_id` int(11) DEFAULT NULL,
  `fecha_entrada` timestamp NULL DEFAULT NULL,
  `fecha_salida` timestamp NULL DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL COMMENT 'primary key',
  `nombre_area` varchar(50) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `nombre_area`, `esActivo`) VALUES
(2, 'ADMINISTRACION', 1),
(3, 'ADMISION', 1),
(4, 'ADOLESCENCIA', 1),
(5, 'ALMACEN GENERAL', 1),
(6, 'ANATOMIA PATOLOGICA', 1),
(7, 'ARCHIVOS', 1),
(8, 'ATENCION INMEDIATA', 1),
(9, 'BANCO DE SANGRE', 1),
(10, 'BIOQUIMICA', 1),
(11, 'CAJA', 1),
(12, 'IMAGEN INSTITUCIONAL', 1),
(13, 'CENTRO ESTETICO', 1),
(14, 'CIRUGIA', 1),
(15, 'CONSULTORIO', 0),
(16, 'CONSULTORIO 10', 1),
(17, 'area 10', 0),
(18, 'CONSULTORIO 15', 1),
(19, 'CONSULTORIO 4', 1),
(20, 'CONSULTORIO 6', 1),
(21, 'CONSULTORIO 7', 1),
(22, 'CONSULTORIO 8', 1),
(23, 'CONSULTORIO 9', 1),
(24, 'CONTROL INTERNO', 1),
(25, 'CONTROL PARENTAL', 1),
(26, 'CONTROL PATRIMONIAL', 1),
(27, 'DAÑOS NO TRANSMISIBLES', 1),
(28, 'DIRECCION', 1),
(29, 'AREA 402', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bajas`
--

CREATE TABLE `bajas` (
  `id_bajas` int(11) NOT NULL COMMENT 'primary key',
  `equipo_id` int(11) DEFAULT NULL,
  `tipo_baja` int(11) NOT NULL COMMENT '1 = Temporal\r\n2 = Permanente',
  `motivo` text NOT NULL,
  `esActivo` int(11) NOT NULL DEFAULT 1,
  `fecha_baja` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bajas`
--

INSERT INTO `bajas` (`id_bajas`, `equipo_id`, `tipo_baja`, `motivo`, `esActivo`, `fecha_baja`) VALUES
(3, 1, 1, 'D', 0, '2023-07-25 16:16:43'),
(4, 1, 1, 'JJ', 0, '2023-07-25 16:18:01'),
(5, 1, 1, 'GG', 0, '2023-07-25 16:19:49'),
(6, 1, 2, 'GG', 1, '2023-07-25 16:20:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL COMMENT 'primary key',
  `nombre_categoria` varchar(100) NOT NULL,
  `esActivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_marca`
--

CREATE TABLE `categoria_marca` (
  `id_categoria_marca` int(11) NOT NULL COMMENT 'primary key',
  `nombre_categoria_marca` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_marca`
--

INSERT INTO `categoria_marca` (`id_categoria_marca`, `nombre_categoria_marca`) VALUES
(1, 'MONITORES '),
(2, 'COMPONENTES'),
(3, 'SUMINISTROS E IMPRESORAS'),
(4, 'VARIOS'),
(5, 'TECLADO'),
(6, 'MOUSE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_componentes`
--

CREATE TABLE `clase_componentes` (
  `id_clase_componentes` int(11) NOT NULL COMMENT 'primary key',
  `nombre_clase` varchar(50) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clase_componentes`
--

INSERT INTO `clase_componentes` (`id_clase_componentes`, `nombre_clase`, `esActivo`) VALUES
(1, 'Externo', 1),
(2, 'Interno', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `id_componentes` int(11) NOT NULL COMMENT 'primary key',
  `tipo_componentes_id` int(11) DEFAULT NULL,
  `clase_componentes_id` int(11) DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `modelo_id` int(11) DEFAULT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `margesi` varchar(50) DEFAULT NULL,
  `componentes_capacidad` varchar(250) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `tipo_alimentacion` int(11) DEFAULT 1 COMMENT '1->CABLE DE PODER\r\n2-> TRANFORMADOR\r\n\r\n',
  `tipo_conector` varchar(100) DEFAULT 'VGA',
  `es_activo` int(11) NOT NULL DEFAULT 1,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `fecha_modify` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `componentes`
--

INSERT INTO `componentes` (`id_componentes`, `tipo_componentes_id`, `clase_componentes_id`, `marca_id`, `modelo_id`, `serie`, `margesi`, `componentes_capacidad`, `estado_id`, `producto_id`, `tipo_alimentacion`, `tipo_conector`, `es_activo`, `fecha_alta`, `fecha_borrado`, `fecha_modify`) VALUES
(3, 3, 1, 2, 2, 'CL16', NULL, '16', 1, NULL, 1, 'VGA', 0, '2023-07-11 20:15:57', '2023-07-31 17:12:25', '2023-08-03 16:49:19'),
(4, 6, 1, 7, 5, '304NDUNB5382', NULL, '10', 3, NULL, NULL, NULL, 0, '2023-07-17 18:00:51', '2023-07-31 17:16:07', '2023-07-31 17:16:07'),
(5, 7, 1, 8, 6, '0065818951042', '123123', '10', 1, NULL, 1, 'vga', 0, '2023-07-18 13:56:22', '2023-07-31 17:26:53', '2023-08-08 17:08:16'),
(6, 8, 2, 8, 7, 'X821908-014', NULL, '12', 1, NULL, 1, 'VGA', 1, '2023-07-18 13:56:52', NULL, '2023-08-03 16:49:32'),
(7, 2, 2, 1, 1, '#123456', '123', '0', 1, NULL, 0, '', 0, '2023-07-25 15:24:26', '2023-07-31 17:20:00', '2023-08-04 15:05:04'),
(8, 6, 1, 2, 12, '6CM32332L90', NULL, '0', 3, NULL, NULL, NULL, 0, '2023-08-03 15:26:27', '2023-08-03 15:27:58', '2023-08-03 15:27:58'),
(9, 6, 1, 2, 2, '432423432', NULL, '', 3, NULL, 2, 'HDMI', 1, '2023-08-03 17:04:48', NULL, '2023-08-03 17:12:59'),
(10, 2, 1, 3, 8, '34324234', '', '0', 3, NULL, 1, 'VGA', 0, '2023-08-04 15:10:31', '2023-08-07 15:06:41', '2023-08-07 15:06:41'),
(11, 5, 1, 4, 4, '214124124', '6557777', '0', 3, NULL, 2, 'DISPLAY PORT', 1, '2023-08-04 15:16:36', NULL, NULL);

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
-- Estructura de tabla para la tabla `detalles_translado`
--

CREATE TABLE `detalles_translado` (
  `id_detalles_translado` int(11) NOT NULL,
  `id_translado` int(11) NOT NULL,
  `area_origen` int(11) NOT NULL,
  `area_destino` int(11) NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '1-Translado o 2-Intercambio',
  `equipo_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_translado`
--

INSERT INTO `detalles_translado` (`id_detalles_translado`, `id_translado`, `area_origen`, `area_destino`, `tipo`, `equipo_id`) VALUES
(4, 4, 3, 26, 1, 'E000008'),
(5, 5, 3, 18, 1, 'E000003');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipos` int(11) NOT NULL COMMENT 'primary key',
  `cod_equipo` varchar(50) DEFAULT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `margesi` varchar(50) DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `modelo_id` int(11) DEFAULT NULL,
  `tipo_equipo_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `mac` varchar(50) DEFAULT NULL,
  `nombre_equipo` varchar(50) DEFAULT NULL,
  `usuario_local` varchar(50) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modify` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `es_activo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipos`, `cod_equipo`, `serie`, `margesi`, `marca_id`, `modelo_id`, `tipo_equipo_id`, `area_id`, `clientes_id`, `estado_id`, `ip`, `mac`, `nombre_equipo`, `usuario_local`, `fecha_alta`, `fecha_modify`, `fecha_borrado`, `es_activo`) VALUES
(1, 'E000001', '22120022119', '740899500150', 1, 1, 1, 5, 3, 1, '192.168.10.1', 'EC-A8-6B-76-30-03', NULL, NULL, '2023-07-14 17:33:26', '2023-07-25 16:20:28', NULL, 0),
(2, 'E000002', 'MXL3272LVCsdasda', '454545454545', 2, 2, 3, 4, 2, 1, '192.168.10.86', '88-51-FB-64-64-7D', 'PC-002', 'HLMP', '2023-07-17 16:03:20', '2023-08-07 15:07:10', NULL, 1),
(3, 'E000003', '22120023849', '740899500137', 1, 1, 4, 3, 3, 1, '192.168.10.72', 'EC-A8-6B-76-E7-CD', NULL, NULL, '2023-07-18 15:55:39', '2023-08-07 15:38:27', NULL, 1),
(4, 'E000004', 'R5X7Z00016', '742223580028', 9, 9, 2, 3, 3, 3, 'USB', '', NULL, NULL, '2023-07-19 14:09:21', '2023-08-02 16:43:42', NULL, 1),
(5, 'E000005', '1234568', '455434', 9, 9, 1, 18, 3, 1, '', '', NULL, NULL, '2023-07-31 17:07:12', NULL, NULL, 1),
(6, 'E000006', 'adasda', '545', 8, 7, 1, 11, 1, 1, '192.168.10.25', '2F:4G:5T:1S', NULL, NULL, '2023-07-31 17:10:59', NULL, NULL, 1),
(7, 'E000007', '45345', '5535', 7, 5, 2, 4, 1, 1, '', '', NULL, NULL, '2023-07-31 17:12:16', NULL, NULL, 1),
(8, 'E000008', '24234234', '01020304', 4, 4, 1, 26, 1, 1, '', '', NULL, NULL, '2023-07-31 17:15:01', '2023-08-03 14:40:13', NULL, 1),
(9, 'E000009', '432423432', '324324234', 8, 6, 1, 3, 3, 1, '', '', NULL, NULL, '2023-07-31 17:15:37', NULL, NULL, 1),
(10, 'E000010', '43432432', '6747657657', 8, 7, 2, 13, 2, 2, '', '', NULL, NULL, '2023-07-31 17:17:21', NULL, NULL, 1),
(11, 'E000011', '42342344', '545435', 8, 6, 1, 28, 3, 1, '', '', NULL, NULL, '2023-07-31 17:19:05', NULL, NULL, 1),
(12, 'E000012', '32132133', '2131242343', 7, 5, 1, 13, 2, 1, '', '', NULL, NULL, '2023-07-31 17:19:44', NULL, NULL, 1),
(13, 'E000013', '12312312321', '2313123123', 9, 9, 1, 10, 1, 1, '', '', NULL, NULL, '2023-07-31 17:23:03', NULL, NULL, 1),
(14, 'E000014', '22120022', '740899500150', 3, 3, 1, 5, 3, 1, '', '', NULL, NULL, '2023-07-31 17:24:07', NULL, NULL, 1),
(15, 'E000015', '24234234', '01020304', 4, 4, 1, 3, 1, 1, '', '', NULL, NULL, '2023-07-31 17:26:09', NULL, NULL, 1),
(16, 'E000016', '3123123', '1231', 2, 2, 1, 13, 3, 1, '', '', NULL, NULL, '2023-07-31 17:30:12', NULL, NULL, 1),
(17, 'E000017', 'C9G97LT#ABM', '74089950023 ', 2, 11, 1, 11, 3, 3, '192.168.10.14', '88-51-FB-62-BC-97', NULL, NULL, '2023-08-03 15:27:39', NULL, NULL, 1),
(18, 'E000018', '4124124', '23432423', 8, 6, 1, 16, 1, 1, '192.168.10.14', 'EC-A8-6B-76-30-03', 'ejemplo nombre', 'pc-nose/55', '2023-08-03 17:59:29', NULL, NULL, 1),
(19, 'E000019', '1214546', '4234235', 4, 4, 1, 16, 2, 1, '192.12.1.0', '88-51-FB-64-64-7D', 'PC-002', 'HLMP', '2023-08-07 15:05:01', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_componentes`
--

CREATE TABLE `equipo_componentes` (
  `id_equipo_componentes` int(11) NOT NULL COMMENT 'primary key',
  `equipo_id` int(11) DEFAULT NULL,
  `serie_id` varchar(50) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modify` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `esActivo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipo_componentes`
--

INSERT INTO `equipo_componentes` (`id_equipo_componentes`, `equipo_id`, `serie_id`, `fecha_alta`, `fecha_modify`, `fecha_borrado`, `esActivo`) VALUES
(1, 1, 'CL16', '2023-07-14 17:48:44', '2023-07-18 13:31:09', NULL, 0),
(3, 2, 'CL16', '2023-07-17 16:03:43', '2023-07-18 15:42:55', NULL, 1),
(6, 1, '304NDUNB5382', '2023-07-18 13:47:07', NULL, NULL, 1),
(7, 1, '0065818951042', '2023-07-18 13:57:43', NULL, NULL, 1),
(8, 1, 'X821908-014', '2023-07-18 13:57:43', NULL, NULL, 1),
(10, 3, '304NDUNB5382', '2023-07-18 15:55:48', NULL, NULL, 1),
(11, 3, 'X821908-014', '2023-07-18 16:44:35', '2023-07-31 17:31:52', NULL, 0),
(12, 5, '304NDUNB5382', '2023-07-31 17:07:34', '2023-07-31 17:08:05', NULL, 0),
(13, 7, 'CL16', '2023-07-31 17:12:25', NULL, NULL, 1),
(14, 9, '304NDUNB5382', '2023-07-31 17:16:07', NULL, NULL, 1),
(15, 12, '#123456', '2023-07-31 17:20:00', NULL, NULL, 1),
(16, 14, 'X821908-014', '2023-07-31 17:24:24', NULL, NULL, 1),
(17, 8, '0065818951042', '2023-07-31 17:26:53', NULL, NULL, 1),
(18, 17, '6CM32332L90', '2023-08-03 15:27:58', NULL, NULL, 1),
(19, 19, '34324234', '2023-08-07 15:06:41', NULL, NULL, 1);

--
-- Disparadores `equipo_componentes`
--
DELIMITER $$
CREATE TRIGGER `DESP_AGREGARENEQUIPO` AFTER INSERT ON `equipo_componentes` FOR EACH ROW BEGIN 
	set @id = (
	        select
	            id_componentes
	        from componentes
	        where
	            serie = new.serie_id
	    );
	UPDATE componentes set es_activo = 0 where id_componentes=@id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `DESP_ELIMINARDEEQUIPO` AFTER UPDATE ON `equipo_componentes` FOR EACH ROW BEGIN 
	IF (new.esActivo = 0) THEN
	update componentes
	set es_activo = 1
	where serie = new.serie_id;
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL COMMENT 'primary key',
  `nombre_estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(1, 'BUENO'),
(2, 'MALO'),
(3, 'REGULAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL COMMENT 'primary key',
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL COMMENT 'primary key',
  `nombre_marca` varchar(50) DEFAULT NULL,
  `categoria_marca_id` int(11) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
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
(33, 'GENERICO', 4, 1),
(34, 'TEST2', 4, 0);

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
  `id_modelo` int(11) NOT NULL COMMENT 'primary key',
  `nombre_modelo` varchar(50) DEFAULT NULL,
  `marca_id` int(11) NOT NULL,
  `esActivo` int(11) NOT NULL
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
(133, 'Sin modelo', 33, 1),
(134, 'Sin modelo', 34, 1),
(135, 'TEST2', 11, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id_movimientos` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo_movimientos` int(1) NOT NULL COMMENT '1 = Entrada\r\n2 = Salida',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_movimientos`, `producto_id`, `cantidad`, `tipo_movimientos`, `fecha`) VALUES
(1, 1, 1, 2, '2023-07-11 22:45:50'),
(14, 26, 1, 2, '2023-07-21 15:09:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permisos` int(11) NOT NULL COMMENT 'primary key',
  `nombre_permisos` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_secciones`
--

CREATE TABLE `permisos_secciones` (
  `id_permisos_secciones` int(11) NOT NULL COMMENT 'primary key',
  `permisos_id` int(11) NOT NULL,
  `secciones_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_personal` int(11) NOT NULL COMMENT 'primary key',
  `nombre_personal` varchar(50) NOT NULL,
  `apellidos_personal` varchar(50) NOT NULL,
  `dni_personal` varchar(8) NOT NULL,
  `correo_personal` varchar(50) NOT NULL,
  `telefono_personal` varchar(50) NOT NULL,
  `cargo_personal` varchar(50) NOT NULL,
  `estado_personal` int(11) NOT NULL DEFAULT 1,
  `esActivo_personal` int(11) NOT NULL DEFAULT 1,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `erase_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `nombre_personal`, `apellidos_personal`, `dni_personal`, `correo_personal`, `telefono_personal`, `cargo_personal`, `estado_personal`, `esActivo_personal`, `create_time`, `modify_time`, `erase_time`) VALUES
(1, 'Manuel', 'Carcamo', '77654321', 'admin@hlmp.com', '211014', '1', 1, 1, '2023-07-11 13:54:24', '2023-07-11 20:35:15', NULL),
(2, 'Cristian', 'Viera', '78956412', 'cristianViera@gmail.com', '987420132', '4', 1, 1, '2023-07-11 20:34:57', NULL, NULL),
(3, 'luis', 'Talledo Benites', '01234567', 'lusisb@gmail.com', '985674231', '4', 1, 1, '2023-07-12 13:35:15', NULL, NULL),
(4, 'Carlos', 'Lopez Guerrero', '74586712', 'carlosguerrero@gmail.com', '975412570', '2', 1, 1, '2023-08-08 15:20:44', NULL, NULL);

--
-- Disparadores `personal`
--
DELIMITER $$
CREATE TRIGGER `PERSONAL_ISACTIVO_BEFORE_LASTUPDATE` BEFORE UPDATE ON `personal` FOR EACH ROW BEGIN
	IF(old.esActivo_personal <> new.esActivo_personal) THEN
    	IF(new.esActivo_personal = 0) THEN 
        	SET new.erase_time = CURRENT_TIMESTAMP;
         ELSE SET new.erase_time = null;
        END IF;
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `id_presentacion` int(11) NOT NULL COMMENT 'primary key',
  `nombre_presentacion` varchar(50) NOT NULL,
  `es_activo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id_presentacion`, `nombre_presentacion`, `es_activo`) VALUES
(1, 'UNID', 1),
(2, 'BLISTERSX5 UNID', 1),
(3, 'KIT', 1),
(4, 'MILLAR', 1),
(5, 'CAJAX100 UNID', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimientos`
--

CREATE TABLE `procedimientos` (
  `id_procedimientos` int(11) NOT NULL COMMENT 'primary key',
  `nombre_procedimientos` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL COMMENT 'primary key',
  `codigo_productos` varchar(10) DEFAULT NULL,
  `nombre_productos` varchar(100) DEFAULT NULL,
  `tipo_productos` int(11) NOT NULL,
  `presentacion_productos` int(11) NOT NULL,
  `cantidad_productos` int(11) DEFAULT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `descripcion_productos` varchar(200) DEFAULT NULL,
  `esActivo` int(11) NOT NULL DEFAULT 1,
  `fecha_crea` timestamp NULL DEFAULT current_timestamp(),
  `fecha_modi` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `codigo_productos`, `nombre_productos`, `tipo_productos`, `presentacion_productos`, `cantidad_productos`, `almacen_id`, `descripcion_productos`, `esActivo`, `fecha_crea`, `fecha_modi`) VALUES
(1, 'P001', 'UISP Switch EdgeSwitch PoE + 48', 4, 1, 4, 1, '- SKU: ES-48-500W\r\n- Switch PoE + de capa 2/3 con (48) puertos Gigabit RJ45, (2) puertos SFP+, (2) puertos SFP  y una fuente de alimentacion de 500w.\r\nCARACTERÍSTICAS:\r\n-(48) Puertos Gigabit RJ45\r\n-(2', 1, '2023-07-11 22:45:50', '2023-07-17 17:54:59'),
(2, 'P002', 'Switch Enterprise 8 PoE', 4, 1, 3, 1, '-SKU: USW-Enterprise-8-PoE\r\n-switch PoE  de capa 3 de ocho puertos.\r\nCARACTERISTICAS\r\n-(8) puertos PoE + RJ45 de 2,5 GbE\r\n-(2) puertos 10G SFP+\r\n-Disponibilidad PoE total de 120 W', 1, '2023-07-11 15:05:59', '2023-07-17 17:54:59'),
(3, 'P003', 'Switch PoE 4 Puertos DS-3E0105P-E/M', 4, 1, 4, 1, '-Ideal para cámara IP, Access Point, Telefono IP de cualquier marca.\r\n-Modelo DS-3E0105P-E/M(B).\r\nCaracteristicas principales\r\n- 4 x 10/100 Base-T PoE 802.3af/at.\r\n- 1,2 - Puerto uplink 100 Mbps', 1, '2023-07-11 15:14:29', '2023-07-17 17:54:59'),
(4, 'P004', 'FUENTE DE PODER 650W', 2, 1, 4, 1, '-Fuente de alimentacion 650W\r\n-ATX, 220V.\r\n-140mm(W) x 150mm(L) x 86mm(H)\r\n-Conectores\r\n-1 x conector p(20 + 4) pines\r\n-1 x conector p8(4 + 4) pines\r\n', 1, '2023-07-11 15:18:15', '2023-07-17 17:54:59'),
(5, 'P005', 'ESTABILIZADOR 1200 VA', 1, 1, 40, 1, '-Voltaje de entrada: 220V\r\n-Voltaje de salida: 220V\r\n-Margen de Voltaje salida 207-253VAC\r\n-Potencia pico 1200 VA\r\n-Margen de Voltaje 172-278VAC', 1, '2023-07-11 15:22:54', '2023-07-17 17:54:59'),
(6, 'P006', 'DISCO DURO SOLIDO', 2, 1, 40, 1, '-Capacidad: 480GB\r\n-Tecnología de almacenamiento: SSD\r\n-Interfaces: SATAIII\r\n-Ubicación del disco: Interno\r\n-Factor de forma: 2.5\"\r\n-Ancho: 100mm\r\n-Altura: 69.9mm\r\n-Profundidad: 6.7mm\r\n-Peso: 45.36g\r\n', 1, '2023-07-11 15:26:38', '2023-07-17 17:54:59'),
(7, 'P007', 'MEMORIA RAM DDR3 4GB', 2, 1, 20, 1, '-CAPACIDAD: 4GB\r\n-TIPO:DDR3\r\n-VALOCIDAD: 1333Mhz\r\n-CARACTERISTICAS: CAS LATENCY CL9\r\n-VOLTAJE 1.5V\r\n-RECOMENDADO: PC\r\n-NUMERO PARTE: HX313C9FB/4', 1, '2023-07-11 15:30:11', '2023-07-17 17:54:59'),
(8, 'P008', 'TARJETA DE VIDEO', 2, 1, 1, 1, '-Version GT 730 2GB DDR3\r\n-Tamaño de la memoria 2 GB\r\n-Tipo de memoria gráfica GDDR3\r\n-Interfaz con la placa madre PCI-Express 2.0\r\n-Bus de memoria bit', 1, '2023-07-11 15:48:43', '2023-07-17 17:54:59'),
(9, 'P009', 'MOUSE USB ESTANDAR', 2, 1, 100, 1, '-Tipo de sensor Óptico\r\n-Resolución del sensor 1000 dpi\r\n-Con cable Sí', 1, '2023-07-11 16:00:44', '2023-07-17 17:54:59'),
(10, 'P010', 'TECLADO USB ESTÁNDAR', 2, 1, 100, 1, '-Teclas semi planas duraderas hasta 5 millones de pulsaciones.\r\n-Compatible con todos los sistemas windows\r\n-Conexión USB Plug and Play.', 1, '2023-07-11 16:03:00', '2023-07-17 17:54:59'),
(11, 'P011', 'ADAPTADOR DE CORRIENTE PARA MONITOR LG', 2, 1, 10, 1, '-Fuente poder certificado LG 19v 2,1A\r\n-Para monitores LG DE 0,8A A 3.0A de consumo de corriente\r\n-Potencia 40W', 1, '2023-07-11 16:05:20', '2023-07-17 17:54:59'),
(12, 'P012', 'DISCO DURO EXTERNO', 2, 1, 1, 1, '-Capacidad de almacenamiento 4 TB\r\n-Interface de cionexion USB 2.0, USB 3.0\r\n-Fuente de alimentación USB\r\n-Dimensiones: largo: 10.9 cm, 7.80 cm, alto: 1.95 cm\r\n-Plataforma de trabajo windows 10, windo', 1, '2023-07-11 16:09:13', '2023-07-17 17:54:59'),
(13, 'P013', 'USB', 1, 1, 3, 1, '-Capacidad de almacenamiento de 16GB.\r\n-Conectividad USB 3.0\r\n-Tipo de conector: USB-A', 1, '2023-07-11 16:10:42', '2023-07-17 17:54:59'),
(14, 'P014', 'ALCOHOL ISOPROPILICO', 4, 1, 3, 1, '-BOTELLA DE 1000 ML - 1 LITRO CON TAPA ROSCA\r\n-ALCOHOL ISOPROPILICO - Para limpieza de computadoras, cabezales, fotocopiadoras, impresoras, discos compactos, artefactos electrodomesticos y otros.\r\n-Co', 1, '2023-07-11 16:13:59', '2023-07-17 17:54:59'),
(15, 'P015', 'PASTA TÉRMICA GRIS REFIGERANTE', 4, 1, 20, 1, '-Adecuado para CPU, chipsets en placa base, tarjeta VGA, etc.\r\n-Las plantillas Zif Socket aseguran el área de aplicación correcta con varios tipos de socket de CPU.\r\n-Produce una capa uniforme cuando ', 1, '2023-07-11 16:17:11', '2023-07-17 17:54:59'),
(16, 'P016', 'SILICONA SPRAY', 4, 1, 10, 1, '-SILICONA SPRAY 750ML BRILLO/LIMPIEZA\r\n-Contenido d e750 ml de silicona con protección anti-estática.\r\n-Boquilla de spray para una adecuada aplicación del producto.\r\n-Diseño cilíndrico para cómoda suj', 1, '2023-07-11 16:19:56', '2023-07-17 17:54:59'),
(17, 'P017', 'LIMPIA CONTACTOS', 4, 2, 10, 1, '-Garantía: 1 año\r\n-Altura del Producto: 16.5 cm\r\n-Ancho del Producto: 6.5 cm\r\n-Profundidad del Producto: 6.5 cm', 1, '2023-07-11 16:28:38', '2023-07-17 17:54:59'),
(18, 'P018', 'Pilas CR-2032', 4, 2, 10, 1, '-Garantia: 1 año\r\n-Altura del producto: 16.5 cm\r\n-Ancho del producto: 6,5 cm\r\n-Profundidad del producto: 6.5 cm', 1, '2023-07-11 16:29:17', '2023-07-17 17:54:59'),
(19, 'P019', 'KIT DESARMADORES Y ALICATES', 3, 3, 2, 1, '-SKU: 91-529LA', 1, '2023-07-11 16:30:53', '2023-07-17 17:54:59'),
(20, 'P020', 'KIT MINI DESARMADOR', 3, 3, 2, 1, '-Mini Desarmador 30 en 1\r\n-Kit de desarmador con 30 puntas', 1, '2023-07-11 16:32:12', '2023-07-17 17:54:59'),
(21, 'P021', 'TORNILLOS SUJETA COOLER', 4, 4, 1, 1, '-Tornillos de 7/32(5.5mm)', 1, '2023-07-11 16:33:52', '2023-07-17 17:54:59'),
(22, 'P022', 'SOPLETE INDUSTRIAL', 3, 1, 0, 1, '-Soplador Aspiradora 800w Industrial Auto Casa Hotel Aire Pc.\r\n-Modelo TB2086', 1, '2023-07-11 16:35:26', '2023-07-17 17:54:59'),
(23, 'P023', 'KIT DE TALADRO', 3, 3, 1, 1, '-Incluye batería: Si', 1, '2023-07-11 16:37:48', '2023-07-17 17:54:59'),
(24, 'P024', 'GUANTES DE NITRILO', 3, 5, 3, 1, 'Tipo :Protector', 1, '2023-07-11 17:08:57', '2023-07-17 17:54:59'),
(25, 'P025', 'CINTILLO O PRECINTOS', 3, 4, 10, 1, '-Material: Plástico ', 1, '2023-07-11 17:11:04', '2023-07-17 17:54:59'),
(26, 'P026', 'TONER', 4, 1, 10, 1, 'TONER PARA IMPRESORAS', 1, '2023-07-20 13:31:01', '2023-08-07 16:06:50'),
(27, 'P027', 'toner pruena', 5, 3, 2, 1, 'es una prueba', 1, '2023-08-07 17:55:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL COMMENT 'primary key',
  `nombre_roles` varchar(50) DEFAULT NULL,
  `esActivo` int(11) NOT NULL DEFAULT 1,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `nombre_roles`, `esActivo`, `create_time`, `modify_time`) VALUES
(1, 'Administrador', 1, '2023-07-11 13:56:56', '2023-08-04 14:40:00'),
(2, 'Secretaria', 1, '2023-07-11 13:57:05', NULL),
(3, 'Técnico', 1, '2023-07-11 13:57:15', NULL),
(4, 'Practicante', 1, '2023-07-11 13:57:25', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `id_roles_permisos` int(11) NOT NULL COMMENT 'primary key',
  `roles_id` int(11) NOT NULL,
  `permisos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `id_rol_usuario` int(11) NOT NULL COMMENT 'primary key',
  `rol_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `esActivo` int(11) NOT NULL DEFAULT 1,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `erase_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`id_rol_usuario`, `rol_id`, `usuario_id`, `esActivo`, `create_time`, `modify_time`, `erase_time`) VALUES
(1, 1, 1, 1, '2023-07-11 14:01:21', '2023-08-04 17:22:57', NULL),
(2, 2, 2, 1, '2023-08-04 17:00:08', '2023-08-07 14:08:09', NULL),
(3, 4, 4, 1, '2023-08-08 15:24:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id_secciones` int(11) NOT NULL COMMENT 'primary key',
  `nombre_secciones` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicios` int(11) NOT NULL COMMENT 'primary key',
  `nombre_servicios` varchar(50) DEFAULT NULL,
  `tipoTrabajo` int(11) DEFAULT 2 COMMENT '1 -> Cambio de tinta\r\n0 -> Otro trabajo',
  `esActivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicios`, `nombre_servicios`, `tipoTrabajo`, `esActivo`) VALUES
(1, 'Formateo', 0, 1),
(2, 'Cambio de Tinta', 1, 1),
(3, 'Limpieza', 0, 1),
(4, 'Mantenimiento Preventivo', 0, 1),
(5, 'Cambio de pasta termica', 0, 1),
(6, 'Cambio de Cinta', 3, 1),
(7, 'Cambio de Toner', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_procedimientos`
--

CREATE TABLE `servicios_procedimientos` (
  `id_servicios_procedimientos` int(11) NOT NULL COMMENT 'primary key',
  `nombre_servicios_procedimientos` varchar(50) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `procedimientos_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_componentes`
--

CREATE TABLE `temp_componentes` (
  `id_temp_componentes` int(11) NOT NULL COMMENT 'primary key',
  `id_equipo_componentes` int(11) DEFAULT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `serie_comp` varchar(50) NOT NULL,
  `margesi` varchar(50) NOT NULL,
  `esActivo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_servicios`
--

CREATE TABLE `temp_servicios` (
  `id_temp_servicios` int(11) NOT NULL,
  `id_trabajo_servicio` int(11) DEFAULT NULL,
  `trabajo_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) NOT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `esActivo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_componentes`
--

CREATE TABLE `tipo_componentes` (
  `id_tipo_componentes` int(11) NOT NULL COMMENT 'primary key',
  `nombre_tipo_componente` varchar(50) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_componentes`
--

INSERT INTO `tipo_componentes` (`id_tipo_componentes`, `nombre_tipo_componente`, `esActivo`) VALUES
(2, 'Disco Duro', 1),
(3, 'Memoria Ram', 1),
(4, 'Procesador', 1),
(5, 'Ventilación', 1),
(6, 'Monitor', 1),
(7, 'Teclado', 1),
(8, 'Mouse', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_equipo`
--

CREATE TABLE `tipo_equipo` (
  `id_tipo_equipo` int(11) NOT NULL COMMENT 'primary key',
  `nombre_tipo_equipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_equipo`
--

INSERT INTO `tipo_equipo` (`id_tipo_equipo`, `nombre_tipo_equipo`) VALUES
(1, 'COMPUTADORA DE ESCRITORIO'),
(2, 'IMPRESORA'),
(3, 'LAPTOP'),
(4, 'TODO EN UNO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos`
--

CREATE TABLE `trabajos` (
  `id_trabajos` int(11) NOT NULL COMMENT 'primary key',
  `tecnico_id` int(11) DEFAULT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `falla` text DEFAULT NULL,
  `solucion` text DEFAULT NULL,
  `recomendacion` text DEFAULT NULL,
  `codigo_productos` varchar(50) DEFAULT NULL,
  `es_activo` int(11) DEFAULT 1,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modify` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `fecha_borrado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabajos`
--

INSERT INTO `trabajos` (`id_trabajos`, `tecnico_id`, `equipo_id`, `responsable_id`, `area_id`, `falla`, `solucion`, `recomendacion`, `codigo_productos`, `es_activo`, `fecha_alta`, `fecha_modify`, `fecha_borrado`) VALUES
(6, 2, 4, 3, 3, 'jj', '', '', 'P026', 1, '2023-07-31 17:02:22', '2023-07-31 17:57:16', NULL),
(7, 2, 4, 3, 3, 'jj', '', '', 'P026', 1, '2023-07-31 17:57:10', NULL, NULL),
(8, 2, 8, 1, 3, 'se apagó', '', '', '', 1, '2023-08-02 17:36:42', NULL, NULL),
(9, 2, 17, 3, 11, 'La pantalla parpadea', 'Cambio de led', '', '', 1, '2023-08-03 15:29:20', NULL, NULL),
(10, 2, 12, 2, 13, 'Pantalla azul', '', '', '', 1, '2023-08-07 16:02:30', NULL, NULL),
(11, 2, 2, 2, 4, 'as', '', '', '', 1, '2023-08-08 13:47:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo_servicio`
--

CREATE TABLE `trabajo_servicio` (
  `id_trabajo_servicio` int(11) NOT NULL COMMENT 'primary key',
  `trabajo_id` int(11) NOT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) NOT NULL,
  `esActivo` int(11) NOT NULL DEFAULT 1,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `erase_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabajo_servicio`
--

INSERT INTO `trabajo_servicio` (`id_trabajo_servicio`, `trabajo_id`, `equipo_id`, `servicio_id`, `esActivo`, `create_time`, `modify_time`, `erase_time`) VALUES
(6, 6, 4, 7, 1, '2023-07-31 17:02:29', NULL, NULL),
(7, 6, 4, 7, 1, '2023-07-31 17:57:16', NULL, NULL),
(8, 8, 8, 1, 1, '2023-08-02 17:37:02', NULL, NULL),
(9, 9, 17, 1, 1, '2023-08-03 15:29:40', NULL, NULL),
(10, 9, 17, 3, 1, '2023-08-03 15:32:35', NULL, NULL),
(11, 7, 4, 6, 1, '2023-08-03 15:43:26', NULL, NULL),
(12, 10, 12, 1, 1, '2023-08-07 16:03:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `translado`
--

CREATE TABLE `translado` (
  `id_translado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `observacion` varchar(100) NOT NULL,
  `tecnico_id` int(11) NOT NULL,
  `tipo_movimiento` int(11) NOT NULL COMMENT '1-> Translado\r\n2-> Intercambio',
  `anulado` int(11) DEFAULT 0 COMMENT '1->anulado\r\n0->activo\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `translado`
--

INSERT INTO `translado` (`id_translado`, `fecha`, `observacion`, `tecnico_id`, `tipo_movimiento`, `anulado`) VALUES
(4, '2023-08-03 14:40:01', '', 2, 1, 0),
(5, '2023-08-07 15:38:27', 'Se requiere equipo', 2, 1, 1),
(6, '2023-08-07 15:58:00', '', 2, 1, 0),
(7, '2023-08-09 13:18:28', '', 2, 1, 0),
(8, '2023-08-09 13:22:52', '', 2, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL COMMENT 'primary key',
  `nombre_usuario` varchar(50) NOT NULL,
  `usuario_password` varchar(50) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `esActivo` int(11) NOT NULL DEFAULT 1,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `erase_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `usuario_password`, `personal_id`, `esActivo`, `create_time`, `modify_time`, `erase_time`) VALUES
(1, 'admin123', 'HonoyFTjGWjvk', 1, 1, '2023-07-11 13:55:27', '2023-08-07 14:25:23', NULL),
(2, 'luis123', 'HoTUleTAp57ac', 3, 1, '2023-08-04 16:59:22', NULL, NULL),
(4, 'carlosprueba123', 'HoCj7PoHSdn4I', 4, 1, '2023-08-08 15:22:54', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `bajas`
--
ALTER TABLE `bajas`
  ADD PRIMARY KEY (`id_bajas`),
  ADD KEY `equipo_id` (`equipo_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `categoria_marca`
--
ALTER TABLE `categoria_marca`
  ADD PRIMARY KEY (`id_categoria_marca`);

--
-- Indices de la tabla `clase_componentes`
--
ALTER TABLE `clase_componentes`
  ADD PRIMARY KEY (`id_clase_componentes`);

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
-- Indices de la tabla `detalles_translado`
--
ALTER TABLE `detalles_translado`
  ADD PRIMARY KEY (`id_detalles_translado`),
  ADD KEY `id_translado` (`id_translado`),
  ADD KEY `equipo_id` (`equipo_id`),
  ADD KEY `area_origen` (`area_origen`),
  ADD KEY `area_destino` (`area_destino`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipos`),
  ADD UNIQUE KEY `cod_equipo` (`cod_equipo`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `clientes_id` (`clientes_id`),
  ADD KEY `tipo_equipo_id` (`tipo_equipo_id`),
  ADD KEY `marca_id` (`marca_id`) USING BTREE,
  ADD KEY `modelo_id` (`modelo_id`) USING BTREE;

--
-- Indices de la tabla `equipo_componentes`
--
ALTER TABLE `equipo_componentes`
  ADD PRIMARY KEY (`id_equipo_componentes`),
  ADD KEY `componentes_id` (`serie_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `producto_id` (`producto_id`);

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
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id_movimientos`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permisos`);

--
-- Indices de la tabla `permisos_secciones`
--
ALTER TABLE `permisos_secciones`
  ADD PRIMARY KEY (`id_permisos_secciones`),
  ADD KEY `permisos_id` (`permisos_id`),
  ADD KEY `secciones_id` (`secciones_id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_personal`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`id_presentacion`);

--
-- Indices de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
  ADD PRIMARY KEY (`id_procedimientos`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`),
  ADD KEY `presentacion_productos` (`presentacion_productos`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`id_roles_permisos`),
  ADD KEY `roles_id` (`roles_id`),
  ADD KEY `permisos_id` (`permisos_id`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`id_rol_usuario`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id_secciones`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicios`);

--
-- Indices de la tabla `servicios_procedimientos`
--
ALTER TABLE `servicios_procedimientos`
  ADD PRIMARY KEY (`id_servicios_procedimientos`),
  ADD KEY `servicio_id` (`servicio_id`),
  ADD KEY `procedimientos_id` (`procedimientos_id`);

--
-- Indices de la tabla `temp_componentes`
--
ALTER TABLE `temp_componentes`
  ADD PRIMARY KEY (`id_temp_componentes`);

--
-- Indices de la tabla `temp_servicios`
--
ALTER TABLE `temp_servicios`
  ADD PRIMARY KEY (`id_temp_servicios`);

--
-- Indices de la tabla `tipo_componentes`
--
ALTER TABLE `tipo_componentes`
  ADD PRIMARY KEY (`id_tipo_componentes`);

--
-- Indices de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  ADD PRIMARY KEY (`id_tipo_equipo`);

--
-- Indices de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  ADD PRIMARY KEY (`id_trabajos`),
  ADD KEY `equipo_id` (`equipo_id`);

--
-- Indices de la tabla `trabajo_servicio`
--
ALTER TABLE `trabajo_servicio`
  ADD PRIMARY KEY (`id_trabajo_servicio`),
  ADD KEY `trabajo_id` (`trabajo_id`),
  ADD KEY `trabajo_servicio_ibfk_2` (`servicio_id`);

--
-- Indices de la tabla `translado`
--
ALTER TABLE `translado`
  ADD PRIMARY KEY (`id_translado`),
  ADD KEY `tecnico_id` (`tecnico_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `personal_id` (`personal_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `bajas`
--
ALTER TABLE `bajas`
  MODIFY `id_bajas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `categoria_marca`
--
ALTER TABLE `categoria_marca`
  MODIFY `id_categoria_marca` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clase_componentes`
--
ALTER TABLE `clase_componentes`
  MODIFY `id_clase_componentes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id_componentes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalles_translado`
--
ALTER TABLE `detalles_translado`
  MODIFY `id_detalles_translado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `equipo_componentes`
--
ALTER TABLE `equipo_componentes`
  MODIFY `id_equipo_componentes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimientos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permisos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `permisos_secciones`
--
ALTER TABLE `permisos_secciones`
  MODIFY `id_permisos_secciones` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_personal` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
  MODIFY `id_procedimientos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  MODIFY `id_roles_permisos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `id_rol_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_secciones` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicios` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicios_procedimientos`
--
ALTER TABLE `servicios_procedimientos`
  MODIFY `id_servicios_procedimientos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `temp_componentes`
--
ALTER TABLE `temp_componentes`
  MODIFY `id_temp_componentes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT de la tabla `temp_servicios`
--
ALTER TABLE `temp_servicios`
  MODIFY `id_temp_servicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `tipo_componentes`
--
ALTER TABLE `tipo_componentes`
  MODIFY `id_tipo_componentes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  MODIFY `id_tipo_equipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  MODIFY `id_trabajos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `trabajo_servicio`
--
ALTER TABLE `trabajo_servicio`
  MODIFY `id_trabajo_servicio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `translado`
--
ALTER TABLE `translado`
  MODIFY `id_translado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bajas`
--
ALTER TABLE `bajas`
  ADD CONSTRAINT `bajas_ibfk_1` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id_equipos`);

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
-- Filtros para la tabla `detalles_translado`
--
ALTER TABLE `detalles_translado`
  ADD CONSTRAINT `detalles_translado_ibfk_1` FOREIGN KEY (`id_translado`) REFERENCES `translado` (`id_translado`),
  ADD CONSTRAINT `detalles_translado_ibfk_2` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`cod_equipo`),
  ADD CONSTRAINT `detalles_translado_ibfk_3` FOREIGN KEY (`area_origen`) REFERENCES `area` (`id_area`),
  ADD CONSTRAINT `detalles_translado_ibfk_4` FOREIGN KEY (`area_destino`) REFERENCES `area` (`id_area`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id_area`),
  ADD CONSTRAINT `equipos_ibfk_2` FOREIGN KEY (`clientes_id`) REFERENCES `personal` (`id_personal`),
  ADD CONSTRAINT `equipos_ibfk_3` FOREIGN KEY (`tipo_equipo_id`) REFERENCES `tipo_equipo` (`id_tipo_equipo`),
  ADD CONSTRAINT `fk_marca` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id_marca`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_productos`);

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

--
-- Filtros para la tabla `permisos_secciones`
--
ALTER TABLE `permisos_secciones`
  ADD CONSTRAINT `permisos_secciones_ibfk_1` FOREIGN KEY (`permisos_id`) REFERENCES `permisos` (`id_permisos`),
  ADD CONSTRAINT `permisos_secciones_ibfk_2` FOREIGN KEY (`secciones_id`) REFERENCES `secciones` (`id_secciones`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`presentacion_productos`) REFERENCES `presentacion` (`id_presentacion`);

--
-- Filtros para la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id_roles`),
  ADD CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`permisos_id`) REFERENCES `permisos` (`id_permisos`);

--
-- Filtros para la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD CONSTRAINT `rol_usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_roles`),
  ADD CONSTRAINT `rol_usuario_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `servicios_procedimientos`
--
ALTER TABLE `servicios_procedimientos`
  ADD CONSTRAINT `servicios_procedimientos_ibfk_1` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id_servicios`),
  ADD CONSTRAINT `servicios_procedimientos_ibfk_2` FOREIGN KEY (`procedimientos_id`) REFERENCES `procedimientos` (`id_procedimientos`);

--
-- Filtros para la tabla `trabajos`
--
ALTER TABLE `trabajos`
  ADD CONSTRAINT `trabajos_ibfk_1` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id_equipos`);

--
-- Filtros para la tabla `trabajo_servicio`
--
ALTER TABLE `trabajo_servicio`
  ADD CONSTRAINT `trabajo_servicio_ibfk_1` FOREIGN KEY (`trabajo_id`) REFERENCES `trabajos` (`id_trabajos`),
  ADD CONSTRAINT `trabajo_servicio_ibfk_2` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id_servicios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `translado`
--
ALTER TABLE `translado`
  ADD CONSTRAINT `translado_ibfk_1` FOREIGN KEY (`tecnico_id`) REFERENCES `personal` (`id_personal`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_personal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
