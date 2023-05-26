-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-05-2023 a las 17:52:08
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
-- Base de datos: `bd_soporte`
--

DELIMITER $$
--
-- Procedimientos
--
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_productos` (IN `p_filtro` VARCHAR(200))   BEGIN
	set @sentencia = concat("SELECT id_productos, codigo_productos, nombre_productos, CASE WHEN tipo_productos = 1 THEN 'Equipo' WHEN tipo_productos = 2 THEN 'Componente' WHEN tipo_productos = 3 THEN 'Herramienta' WHEN tipo_productos = 4 THEN 'Insumo' END as Tipo, pre.nombre_presentacion, cantidad_productos, CASE WHEN almacen_id = 1 THEN 'Almacen 1' WHEN almacen_id = 2 THEN 'Almacen 2' WHEN almacen_id = 3 THEN 'Almacen 3' END as Almacen, descripcion_productos FROM productos p INNER JOIN presentacion pre ON p.presentacion_productos = pre.id_presentacion WHERE esActivo = 1 " , p_filtro);
	prepare datos from @sentencia; 
	execute datos;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int NOT NULL,
  `inventario_id` int DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `observaciones` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int NOT NULL,
  `nombre_area` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `esActivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `nombre_area`, `esActivo`) VALUES
(1, 'Estadistica e Informatica ', 0),
(2, 'Personal', 0),
(3, 'Administración', 0),
(4, 'Archivo', 0),
(5, 'Soporte Tecnico prueba 2.0', 1),
(6, 'Enfermeria sin editf', 0),
(7, 'Logística editado', 1),
(8, 'Nutrición', 1),
(9, 'Patologia', 1),
(10, 'Planificacion Familiar', 1),
(11, 'Psicologia', 1),
(12, 'Rayos X', 1),
(13, 'Servicio Social', 1),
(14, 'SIP', 1),
(15, 'SIS', 1),
(16, 'Estadistica e Informatica EDITA', 1),
(17, '', 0),
(18, 'prueba', 0),
(19, 'hola', 0),
(20, 'Enfermeria second', 1),
(21, 'prue', 1),
(22, '', 0),
(23, 'p', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bajas`
--

CREATE TABLE `bajas` (
  `id_bajas` int NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `motivo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipo_id` int DEFAULT NULL,
  `usuarios_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL,
  `nombre_categoria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `esActivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id_cateogria_marca` int NOT NULL,
  `nombre_categoria_marca` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_componentes`
--

CREATE TABLE `clase_componentes` (
  `id_clase_componentes` int NOT NULL,
  `nombre_clase` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `esActivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clase_componentes`
--

INSERT INTO `clase_componentes` (`id_clase_componentes`, `nombre_clase`, `esActivo`) VALUES
(1, 'clase 1', 1),
(2, 'clase 2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `id_componentes` int NOT NULL,
  `tipo_componentes_id` int DEFAULT NULL,
  `clase_componentes_id` int DEFAULT NULL,
  `marca_id` int DEFAULT NULL,
  `modelo_id` int DEFAULT NULL,
  `serie` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_id` int DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `es_activo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipos` int NOT NULL,
  `codigo` int DEFAULT NULL,
  `tipo_equipo_id` int DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  `clientes_id` int DEFAULT NULL,
  `estado_id` int DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mac` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `es_activo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_componentes`
--

CREATE TABLE `equipo_componentes` (
  `id_equipo_componentes` int NOT NULL,
  `equipo_id` int DEFAULT NULL,
  `componentes_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int NOT NULL,
  `nombre_estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(1, 'Bueno'),
(2, 'Regular'),
(3, 'Malo'),
(4, 'Semi New');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int NOT NULL,
  `producto_id` int DEFAULT NULL,
  `cantidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int NOT NULL,
  `nombre_marca` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_marca_id` int DEFAULT NULL,
  `esActivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre_marca`, `categoria_marca_id`, `esActivo`) VALUES
(1, 'Lenovo edit 2.0', 3, 1),
(2, 'HP', 2, 1),
(3, 'Acer', 1, 1),
(4, 'Christian', 1, 0),
(5, 'HP', 1, 1),
(6, 'Samsung', 3, 1),
(7, 'LG', 3, 1),
(8, 'Acer', 0, 1),
(9, 'HP editado 2.0', 0, 1),
(10, 'Apple', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id_modelo` int NOT NULL,
  `nombre_modelo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marca_id` int NOT NULL,
  `esActivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id_modelo`, `nombre_modelo`, `marca_id`, `esActivo`) VALUES
(1, 'Nombre de modelo 1 editado', 4, 1),
(2, 'nombre de modelo 2', 2, 1),
(3, 'nombre de modelo 3', 6, 1),
(4, 'nombre de modelo 3', 6, 1),
(5, 'nombre modelo 5', 1, 1),
(6, '', 0, 1),
(7, 'gfa', 3, 0),
(8, '', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permisos` int NOT NULL,
  `nombre_permisos` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_secciones`
--

CREATE TABLE `permisos_secciones` (
  `id_permisos_secciones` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_personal` int NOT NULL COMMENT 'primary key',
  `nombre_personal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos_personal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni_personal` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_personal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_personal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_personal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_personal` int NOT NULL DEFAULT '1',
  `esActivo_personal` int NOT NULL DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `erase_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `nombre_personal`, `apellidos_personal`, `dni_personal`, `correo_personal`, `telefono_personal`, `cargo_personal`, `estado_personal`, `esActivo_personal`, `create_time`, `modify_time`, `erase_time`) VALUES
(1, 'Cristian', 'Viera burneo', '73376279', 'nexcris95@gmail.com', '977256520', 'Practicante', 1, 1, '2023-05-26 16:19:06', '2023-05-26 16:19:06', NULL),
(2, 'Christian', 'Castro', '14526378', 'jhsgadjh@gmail.com', '748591230', 'Practicante', 1, 1, '2023-05-26 16:19:06', '2023-05-26 16:19:06', NULL),
(3, 'Tecnico A', 'Apellidos A', '14785146', 'tecnicoA@gmail.com', '725417896', 'Tecnico', 1, 1, '2023-05-26 16:19:06', '2023-05-26 16:19:34', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `id_presentacion` int NOT NULL,
  `nombre_presentacion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `es_activo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id_presentacion`, `nombre_presentacion`, `es_activo`) VALUES
(1, 'UNID', 1),
(2, 'MILLAR', 1),
(3, 'KIT', 1),
(4, 'CAJAx10 UNID', 1),
(5, 'CAJAx100 UNID', 1),
(6, 'CAJAx305 MTS', 1),
(7, 'CAJAx350 MTS', 1),
(8, 'BOLSAx100 UNID', 1),
(9, 'BLISTERx5 UNID', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimientos`
--

CREATE TABLE `procedimientos` (
  `id_procedimientos` int NOT NULL,
  `nombre_procedimientos` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int NOT NULL,
  `codigo_productos` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_productos` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_productos` int NOT NULL,
  `presentacion_productos` int NOT NULL,
  `cantidad_productos` int DEFAULT NULL,
  `almacen_id` int DEFAULT NULL,
  `descripcion_productos` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `esActivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `codigo_productos`, `nombre_productos`, `tipo_productos`, `presentacion_productos`, `cantidad_productos`, `almacen_id`, `descripcion_productos`, `esActivo`) VALUES
(1, 'P001', 'Conector', 1, 8, 77, 2, 'hola soy german', 1),
(2, 'P002', 'Conector RJ45', 2, 9, 90, 1, 'po', 1),
(3, 'P003', 'hol', 1, 1, 9, 3, 'ojo', 1),
(4, 'P004', 'Conector', 1, 8, 13, 3, 'i', 1),
(5, 'P005', 'uu', 1, 8, 90, 2, 'f', 0),
(6, 'P006', 'ul', 4, 2, 80, 1, 'ultimo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int NOT NULL,
  `nombre_roles` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `esActivo` int NOT NULL DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `nombre_roles`, `esActivo`, `create_time`, `modify_time`) VALUES
(1, 'Administrador ', 1, '2023-05-26 15:26:42', '2023-05-26 15:26:42'),
(2, 'secretaria', 1, '2023-05-26 15:26:42', '2023-05-26 15:26:42'),
(3, 'Practicante de soporte', 1, '2023-05-26 15:26:42', '2023-05-26 15:26:42'),
(4, 'no definido', 1, '2023-05-26 15:26:42', '2023-05-26 16:12:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `id_roles_permisos` int NOT NULL,
  `roles_id` int NOT NULL,
  `permisos_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_personal`
--

CREATE TABLE `rol_personal` (
  `id_rol_personal` int NOT NULL,
  `rol_id` int NOT NULL,
  `personal_id` int NOT NULL,
  `esActivo` int NOT NULL DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `erase_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol_personal`
--

INSERT INTO `rol_personal` (`id_rol_personal`, `rol_id`, `personal_id`, `esActivo`, `create_time`, `modify_time`, `erase_time`) VALUES
(1, 3, 2, 1, '2023-05-26 16:24:58', '2023-05-26 16:24:58', NULL),
(2, 3, 1, 1, '2023-05-26 16:24:58', '2023-05-26 16:24:58', NULL),
(3, 4, 3, 1, '2023-05-26 16:25:14', '2023-05-26 16:25:14', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id_secciones` int NOT NULL,
  `nombre_secciones` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicios` int NOT NULL,
  `nombre_servicios` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `esActivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicios`, `nombre_servicios`, `esActivo`) VALUES
(1, 'Formateo', 0),
(2, 'Limpieza edit d', 0),
(3, 'prueba eds', 0),
(4, 'prueba 1', 0),
(5, '', 0),
(6, 'hooa', 0),
(7, '', 0),
(8, '', 0),
(9, '', 0),
(10, 'Formateo editado', 0),
(11, 'edicion', 0),
(12, '', 0),
(13, '', 0),
(14, 'prueba', 0),
(15, '', 0),
(16, 'prueba nueva', 1),
(17, 's', 0),
(18, 'hola PRUEBA', 0),
(19, 'prueba', 1),
(20, 'prue', 0),
(21, 'prueba definitiva', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_procedimientos`
--

CREATE TABLE `servicios_procedimientos` (
  `id_servicios_procedimientos` int NOT NULL,
  `nombre_servicios_procedimientos` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `procedimientos_id` int DEFAULT NULL,
  `servicio_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_componentes`
--

CREATE TABLE `tipo_componentes` (
  `id_tipo_componentes` int NOT NULL,
  `nombre_tipo_componente` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `esActivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id_tipo_equipo` int NOT NULL,
  `nombre_tipo_equipo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos`
--

CREATE TABLE `trabajos` (
  `id_trabajos` int NOT NULL,
  `nombre_trabajo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clientes_id` int DEFAULT NULL,
  `producto_id` int DEFAULT NULL,
  `servicio_id` int DEFAULT NULL,
  `equipo_id` int DEFAULT NULL,
  `usuarios_id` int DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL COMMENT 'primary key',
  `nombre_usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_id` int NOT NULL,
  `esActivo` int NOT NULL DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `erase_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `usuario_password`, `personal_id`, `esActivo`, `create_time`, `modify_time`, `erase_time`) VALUES
(1, 'christia17', '1234', 2, 1, '2023-05-26 16:33:11', '2023-05-26 16:33:11', NULL),
(2, 'cvieraburneo', '12345678', 1, 1, '2023-05-26 16:33:11', '2023-05-26 16:33:11', NULL);

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
  ADD PRIMARY KEY (`id_bajas`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `categoria_marca`
--
ALTER TABLE `categoria_marca`
  ADD PRIMARY KEY (`id_cateogria_marca`);

--
-- Indices de la tabla `clase_componentes`
--
ALTER TABLE `clase_componentes`
  ADD PRIMARY KEY (`id_clase_componentes`);

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id_componentes`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipos`);

--
-- Indices de la tabla `equipo_componentes`
--
ALTER TABLE `equipo_componentes`
  ADD PRIMARY KEY (`id_equipo_componentes`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id_modelo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permisos`);

--
-- Indices de la tabla `permisos_secciones`
--
ALTER TABLE `permisos_secciones`
  ADD PRIMARY KEY (`id_permisos_secciones`);

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
  ADD PRIMARY KEY (`id_productos`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`id_roles_permisos`);

--
-- Indices de la tabla `rol_personal`
--
ALTER TABLE `rol_personal`
  ADD PRIMARY KEY (`id_rol_personal`),
  ADD KEY `fk_personal_id` (`personal_id`),
  ADD KEY `fk_rol_id` (`rol_id`);

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
  ADD PRIMARY KEY (`id_servicios_procedimientos`);

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
  ADD PRIMARY KEY (`id_trabajos`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`nombre_usuario`),
  ADD KEY `fk_usuario_personal_id` (`personal_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `bajas`
--
ALTER TABLE `bajas`
  MODIFY `id_bajas` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria_marca`
--
ALTER TABLE `categoria_marca`
  MODIFY `id_cateogria_marca` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clase_componentes`
--
ALTER TABLE `clase_componentes`
  MODIFY `id_clase_componentes` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id_componentes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipos` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo_componentes`
--
ALTER TABLE `equipo_componentes`
  MODIFY `id_equipo_componentes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id_modelo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permisos` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos_secciones`
--
ALTER TABLE `permisos_secciones`
  MODIFY `id_permisos_secciones` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_personal` int NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id_presentacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
  MODIFY `id_procedimientos` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol_personal`
--
ALTER TABLE `rol_personal`
  MODIFY `id_rol_personal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_secciones` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicios` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `servicios_procedimientos`
--
ALTER TABLE `servicios_procedimientos`
  MODIFY `id_servicios_procedimientos` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_componentes`
--
ALTER TABLE `tipo_componentes`
  MODIFY `id_tipo_componentes` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  MODIFY `id_tipo_equipo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  MODIFY `id_trabajos` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rol_personal`
--
ALTER TABLE `rol_personal`
  ADD CONSTRAINT `fk_personal_id` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_personal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rol_id` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_roles`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_personal_id` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_personal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
