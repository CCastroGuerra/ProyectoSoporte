-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2023 a las 02:25:43
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
  `id_almacen` int(11) NOT NULL,
  `inventario_id` int(11) DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `nombre_area` varchar(50) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
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
  `id_bajas` int(11) NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `motivo` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `esActivo` int(11) NOT NULL
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
  `id_cateogria_marca` int(11) NOT NULL,
  `nombre_categoria_marca` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_componentes`
--

CREATE TABLE `clase_componentes` (
  `id_clase_componentes` int(11) NOT NULL,
  `nombre_clase` varchar(50) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
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
  `id_componentes` int(11) NOT NULL,
  `tipo_componentes_id` int(11) DEFAULT NULL,
  `clase_componentes_id` int(11) DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `modelo_id` int(11) DEFAULT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `es_activo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipos` int(11) NOT NULL,
  `codigo` int(11) DEFAULT NULL,
  `tipo_equipo_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `mac` varchar(50) DEFAULT NULL,
  `es_activo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_componentes`
--

CREATE TABLE `equipo_componentes` (
  `id_equipo_componentes` int(11) NOT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `componentes_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(50) DEFAULT NULL
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
  `id_inventario` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(50) DEFAULT NULL,
  `categoria_marca_id` int(11) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
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
  `id_modelo` int(11) NOT NULL,
  `nombre_modelo` varchar(50) DEFAULT NULL,
  `marca_id` int(11) NOT NULL,
  `esActivo` int(11) NOT NULL
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
  `id_permisos` int(11) NOT NULL,
  `nombre_permisos` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_secciones`
--

CREATE TABLE `permisos_secciones` (
  `id_permisos_secciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_personal` int(11) NOT NULL,
  `apellidos_personal` varchar(50) NOT NULL,
  `nombres_personal` varchar(50) NOT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `password_usuario` varchar(50) DEFAULT NULL,
  `usuario_alta` datetime DEFAULT NULL,
  `usuario_elimina` datetime DEFAULT NULL,
  `usuario_modifica` datetime DEFAULT NULL,
  `es_activo` int(11) DEFAULT NULL,
  `cargo_personal` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `apellidos_personal`, `nombres_personal`, `nombre_usuario`, `password_usuario`, `usuario_alta`, `usuario_elimina`, `usuario_modifica`, `es_activo`, `cargo_personal`) VALUES
(1, 'Castro Guerra', 'christian', 'christia17', '1234', '2023-05-15 08:48:45', '2023-05-15 10:15:55', '2023-05-15 09:05:03', 1, 3),
(2, 'Talledo', 'Luis', '12345678', 'luistalledo', '2023-05-15 09:03:12', '2023-05-15 10:15:58', '0000-00-00 00:00:00', 1, 3),
(3, '', 'Conector', NULL, NULL, '2023-05-15 09:04:30', '2023-05-15 10:15:49', '2023-05-17 10:47:31', 0, 0),
(4, 'Castro Guerra ', 'Christian', '74505140', 'CCASTROGU17', '2023-05-15 10:31:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `id_presentacion` int(11) NOT NULL,
  `nombre_presentacion` varchar(50) NOT NULL,
  `es_activo` int(11) NOT NULL
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
  `id_procedimientos` int(11) NOT NULL,
  `nombre_procedimientos` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL,
  `codigo_productos` varchar(10) DEFAULT NULL,
  `nombre_productos` varchar(100) DEFAULT NULL,
  `tipo_productos` int(11) NOT NULL,
  `presentacion_productos` int(11) NOT NULL,
  `cantidad_productos` int(11) DEFAULT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `descripcion_productos` varchar(200) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
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
  `id_roles` int(11) NOT NULL,
  `nombre_roles` varchar(50) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `nombre_roles`, `esActivo`) VALUES
(1, 'Administrador ', 1),
(2, 'secretaria', 1),
(3, 'prueba rol edit', 1),
(4, 'Practicante de soporte', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `id_roles_permisos` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `permisos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_personal`
--

CREATE TABLE `rol_personal` (
  `id_rol_personal` int(11) NOT NULL,
  `rol_id` varchar(100) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `esActivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id_secciones` int(11) NOT NULL,
  `nombre_secciones` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicios` int(11) NOT NULL,
  `nombre_servicios` varchar(50) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
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
  `id_servicios_procedimientos` int(11) NOT NULL,
  `nombre_servicios_procedimientos` varchar(50) DEFAULT NULL,
  `procedimientos_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_componentes`
--

CREATE TABLE `tipo_componentes` (
  `id_tipo_componentes` int(11) NOT NULL,
  `nombre_tipo_componente` varchar(50) DEFAULT NULL,
  `esActivo` int(11) NOT NULL
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
  `id_tipo_equipo` int(11) NOT NULL,
  `nombre_tipo_equipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos`
--

CREATE TABLE `trabajos` (
  `id_trabajos` int(11) NOT NULL,
  `nombre_trabajo` varchar(50) DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  ADD PRIMARY KEY (`id_rol_personal`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `bajas`
--
ALTER TABLE `bajas`
  MODIFY `id_bajas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria_marca`
--
ALTER TABLE `categoria_marca`
  MODIFY `id_cateogria_marca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clase_componentes`
--
ALTER TABLE `clase_componentes`
  MODIFY `id_clase_componentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id_componentes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo_componentes`
--
ALTER TABLE `equipo_componentes`
  MODIFY `id_equipo_componentes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permisos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos_secciones`
--
ALTER TABLE `permisos_secciones`
  MODIFY `id_permisos_secciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
  MODIFY `id_procedimientos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol_personal`
--
ALTER TABLE `rol_personal`
  MODIFY `id_rol_personal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_secciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `servicios_procedimientos`
--
ALTER TABLE `servicios_procedimientos`
  MODIFY `id_servicios_procedimientos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_componentes`
--
ALTER TABLE `tipo_componentes`
  MODIFY `id_tipo_componentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  MODIFY `id_tipo_equipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  MODIFY `id_trabajos` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
