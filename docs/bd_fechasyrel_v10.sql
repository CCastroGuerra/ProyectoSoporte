-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2023 a las 16:02:39
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
(1, 'Soporte ', 1),
(2, 'Estadistica e Informatica', 1),
(3, 'Administracion', 1),
(4, '', 0),
(5, 'dd', 0);

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
(16, 86, 2, 'porque si', 1, '2023-06-19 23:00:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL COMMENT 'primary key',
  `nombre_categoria` varchar(100) NOT NULL,
  `esActivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `esActivo`) VALUES
(1, 'Monitores', 1),
(2, 'Suministros e impresoras', 1),
(3, 'Componentes', 1);

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
(1, 'Monitores'),
(2, 'Suministros e impresoras'),
(3, 'Componentes');

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
(1, 'Clase 1', 1),
(2, 'Clase 2', 1);

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
  `componentes_capacidad` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `es_activo` int(11) NOT NULL DEFAULT 1,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `fecha_modify` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `componentes`
--

INSERT INTO `componentes` (`id_componentes`, `tipo_componentes_id`, `clase_componentes_id`, `marca_id`, `modelo_id`, `serie`, `componentes_capacidad`, `estado_id`, `producto_id`, `es_activo`, `fecha_alta`, `fecha_borrado`, `fecha_modify`) VALUES
(3, 1, 1, 4, 1, '#123456', 100, 2, NULL, 1, '2023-06-05 17:45:08', NULL, NULL),
(4, 2, 2, 5, 2, '#0202', 100, 2, NULL, 1, '2023-06-06 15:48:44', NULL, NULL);

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
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipos` int(11) NOT NULL COMMENT 'primary key',
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
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modify` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `es_activo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipos`, `serie`, `margesi`, `marca_id`, `modelo_id`, `tipo_equipo_id`, `area_id`, `clientes_id`, `estado_id`, `ip`, `mac`, `fecha_alta`, `fecha_modify`, `fecha_borrado`, `es_activo`) VALUES
(86, '22120022119', '0011780', 4, 1, 2, 1, 6, 1, '192.168.61.5', '1B:2C:3A', '2023-06-11 19:48:17', '2023-06-19 23:01:01', NULL, 1),
(87, '12', '569874', 4, 1, 2, 3, 5, 2, '192.168.10.25', '2F:4G:5T:1S', '2023-06-11 20:05:18', '2023-06-15 13:23:29', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_componentes`
--

CREATE TABLE `equipo_componentes` (
  `id_equipo_componentes` int(11) NOT NULL COMMENT 'primary key',
  `equipo_id` int(11) DEFAULT NULL,
  `serie_id` varchar(11) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modify` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `fecha_borrado` timestamp NULL DEFAULT NULL,
  `esActivo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipo_componentes`
--

INSERT INTO `equipo_componentes` (`id_equipo_componentes`, `equipo_id`, `serie_id`, `fecha_alta`, `fecha_modify`, `fecha_borrado`, `esActivo`) VALUES
(3, 87, '#123456', '2023-06-11 20:06:30', '2023-06-12 02:39:22', NULL, 1),
(4, 86, '#0202', '2023-06-11 20:04:05', '2023-06-12 02:49:44', NULL, 1),
(6, 87, '#0202', '2023-06-12 13:23:16', NULL, NULL, 1),
(7, 86, '#123456', '2023-06-12 13:53:08', '2023-06-12 14:24:42', NULL, 0);

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
(1, 'Bueno'),
(2, 'Malo'),
(3, 'Regular'),
(4, 'Semi New');

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
(4, 'HP', 1, 1),
(5, 'Lenovo', 1, 1);

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
(1, '1T82UA#1', 4, 1),
(2, 'LK471BN', 5, 1);

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
(1, 9, 4, 1, '2023-06-17 15:59:36'),
(2, 9, 4, 1, '2023-06-17 15:59:36');

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
(1, 'Christian', 'Castro Guerra', '74505140', 'castroguerrachristian4@gmail.com', '211766', '4', 1, 1, '2023-05-31 16:02:22', '2023-06-13 15:47:49', NULL),
(5, 'Luis', 'Talledo Benites', '74123695', 'lusisb@gmail.com', '985674231', '2', 1, 1, '2023-06-02 14:13:22', '2023-06-02 14:55:36', NULL),
(6, 'Antonella', 'Martinez', '12345678', 'antonella123@gmail.com', '98547612', '2', 1, 0, '2023-06-02 15:22:13', '2023-06-06 23:13:04', '2023-06-06 23:13:04');

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
(3, 'UNID', 1),
(4, 'BOLSAx100 UNID', 1),
(5, 'Prueba', 1);

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
  `esActivo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `codigo_productos`, `nombre_productos`, `tipo_productos`, `presentacion_productos`, `cantidad_productos`, `almacen_id`, `descripcion_productos`, `esActivo`) VALUES
(9, 'P001', 'nombre', 1, 3, 23, 1, 'descripcion', 1),
(10, 'P002', 'nombre', 1, 3, 10, 1, 'descripcion', 0),
(11, 'P003', 'nombre', 1, 3, 11, 1, 'descripcion', 1),
(12, 'P004', 'nombre', 1, 3, 5, 1, 'descripcion', 0),
(13, 'P005', 'nombre', 1, 3, 101, 1, 'descripcion', 0),
(24, 'P006', '', 0, 5, 0, 0, '', 0),
(25, 'P007', 'Conector RJ45', 2, 5, 100, 1, 'Conector Rj45', 1);

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
(1, 'Practicante', 0, '2023-06-01 16:07:38', '2023-06-06 23:13:24'),
(2, 'Secretaria', 0, '2023-06-01 16:07:38', '2023-06-07 15:31:08'),
(3, 'Administrador editado', 0, '2023-06-06 23:13:36', '2023-06-06 23:13:51'),
(4, 'Auditor externo', 1, '2023-06-06 23:13:44', NULL),
(5, 'hol', 1, '2023-06-19 16:18:29', NULL);

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
(6, 1, 2, 1, '2023-06-02 15:03:16', NULL, NULL);

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
  `esActivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicios`, `nombre_servicios`, `esActivo`) VALUES
(1, 'Formateo', 1),
(3, 'Otros servicios', 1),
(4, 'Limpieza edit', 1);

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
  `serie_comp` varchar(11) NOT NULL,
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
(1, 'CPU', 1),
(2, 'DISCO DURO', 1);

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
(1, 'Laptop'),
(2, 'Computadora de escritorio');

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
  `es_activo` int(11) DEFAULT 1,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modify` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `fecha_borrado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabajos`
--

INSERT INTO `trabajos` (`id_trabajos`, `tecnico_id`, `equipo_id`, `responsable_id`, `area_id`, `falla`, `solucion`, `recomendacion`, `es_activo`, `fecha_alta`, `fecha_modify`, `fecha_borrado`) VALUES
(19, 1, 86, 6, 1, 'Pantalla Azul', 'Reiniciar', 'No encender', 1, '2023-06-15 17:08:03', NULL, NULL);

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
(18, 19, 86, 1, 0, '2023-06-15 17:08:22', '2023-06-15 17:09:05', NULL),
(19, 19, 86, 4, 0, '2023-06-15 17:08:22', '2023-06-15 17:08:46', NULL),
(21, 19, 86, 1, 1, '2023-06-15 17:09:19', NULL, NULL),
(22, 19, 86, 1, 0, '2023-06-15 17:12:25', '2023-06-15 17:17:08', NULL),
(23, 19, 86, 3, 1, '2023-06-15 17:12:56', NULL, NULL);

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
(2, 'luisT123', 'luis123', 5, 1, '2023-06-02 15:00:36', NULL, NULL),
(15, 'anto123', '123anto', 6, 0, '2023-06-02 16:02:14', '2023-06-02 16:20:22', NULL);

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
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipos`),
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
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `usuario_id` (`usuario_id`);

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
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `bajas`
--
ALTER TABLE `bajas`
  MODIFY `id_bajas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria_marca`
--
ALTER TABLE `categoria_marca`
  MODIFY `id_categoria_marca` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clase_componentes`
--
ALTER TABLE `clase_componentes`
  MODIFY `id_clase_componentes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id_componentes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `equipo_componentes`
--
ALTER TABLE `equipo_componentes`
  MODIFY `id_equipo_componentes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimientos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_personal` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=7;

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
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  MODIFY `id_roles_permisos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `id_rol_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_secciones` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicios` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `servicios_procedimientos`
--
ALTER TABLE `servicios_procedimientos`
  MODIFY `id_servicios_procedimientos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

--
-- AUTO_INCREMENT de la tabla `temp_componentes`
--
ALTER TABLE `temp_componentes`
  MODIFY `id_temp_componentes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT de la tabla `temp_servicios`
--
ALTER TABLE `temp_servicios`
  MODIFY `id_temp_servicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT de la tabla `tipo_componentes`
--
ALTER TABLE `tipo_componentes`
  MODIFY `id_tipo_componentes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  MODIFY `id_tipo_equipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  MODIFY `id_trabajos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `trabajo_servicio`
--
ALTER TABLE `trabajo_servicio`
  MODIFY `id_trabajo_servicio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=16;

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
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_personal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
