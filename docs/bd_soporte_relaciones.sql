CREATE TABLE `almacen` (
  `id_almacen` int PRIMARY KEY NOT NULL,
  `inventario_id` int DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `cantidad` int DEFAULT NULL
);

CREATE TABLE `area` (
  `id_area` int PRIMARY KEY NOT NULL,
  `nombre_area` varchar(50) DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `bajas` (
  `id_bajas` int PRIMARY KEY NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `motivo` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `equipo_id` int DEFAULT NULL,
  `usuarios_id` int DEFAULT NULL
);

CREATE TABLE `categoria` (
  `id_categoria` int PRIMARY KEY NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `categoria_marca` (
  `id_cateogria_marca` int PRIMARY KEY NOT NULL,
  `nombre_categoria_marca` varchar(50) DEFAULT NULL
);

CREATE TABLE `clase_componentes` (
  `id_clase_componentes` int PRIMARY KEY NOT NULL,
  `nombre_clase` varchar(50) DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `componentes` (
  `id_componentes` int PRIMARY KEY NOT NULL,
  `tipo_componentes_id` int DEFAULT NULL,
  `clase_componentes_id` int DEFAULT NULL,
  `marca_id` int DEFAULT NULL,
  `modelo_id` int DEFAULT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `estado_id` int DEFAULT NULL,
  `producto_id` varchar(10) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `es_activo` int DEFAULT NULL
);

CREATE TABLE `equipos` (
  `id_equipos` int PRIMARY KEY NOT NULL,
  `codigo` int DEFAULT NULL,
  `codigo_productos` varchar(10) DEFAULT NULL,
  `tipo_equipo_id` int DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  `clientes_id` int DEFAULT NULL,
  `estado_id` int DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `mac` varchar(50) DEFAULT NULL,
  `es_activo` int DEFAULT NULL
);

CREATE TABLE `equipo_componentes` (
  `id_equipo_componentes` int PRIMARY KEY NOT NULL,
  `equipo_id` int DEFAULT NULL,
  `componentes_id` int DEFAULT NULL
);

CREATE TABLE `estado` (
  `id_estado` int PRIMARY KEY NOT NULL,
  `nombre_estado` varchar(50) DEFAULT NULL
);

CREATE TABLE `inventario` (
  `id_inventario` int PRIMARY KEY NOT NULL,
  `producto_id` int DEFAULT NULL,
  `cantidad` int NOT NULL
);

CREATE TABLE `marca` (
  `id_marca` int PRIMARY KEY NOT NULL,
  `nombre_marca` varchar(50) DEFAULT NULL,
  `categoria_marca_id` int DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `modelo` (
  `id_modelo` int PRIMARY KEY NOT NULL,
  `nombre_modelo` varchar(50) DEFAULT NULL,
  `marca_id` int NOT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `permisos` (
  `id_permisos` int PRIMARY KEY NOT NULL,
  `nombre_permisos` varchar(50) NOT NULL
);

CREATE TABLE `permisos_secciones` (
  `id_permisos_secciones` int PRIMARY KEY NOT NULL,
  `permisos_id` int NOT NULL,
  `secciones_id` int NOT NULL
);

CREATE TABLE `personal` (
  `id_personal` int PRIMARY KEY NOT NULL COMMENT 'primary key',
  `nombre_personal` varchar(50) NOT NULL,
  `apellidos_personal` varchar(50) NOT NULL,
  `dni_personal` varchar(8) NOT NULL,
  `correo_personal` varchar(50) NOT NULL,
  `telefono_personal` varchar(50) NOT NULL,
  `cargo_personal` varchar(50) NOT NULL,
  `estado_personal` int NOT NULL DEFAULT "1",
  `esActivo_personal` int NOT NULL DEFAULT "1",
  `create_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `modify_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `erase_time` timestamp DEFAULT NULL
);

CREATE TABLE `presentacion` (
  `id_presentacion` int PRIMARY KEY NOT NULL,
  `nombre_presentacion` varchar(50) NOT NULL,
  `es_activo` int NOT NULL
);

CREATE TABLE `procedimientos` (
  `id_procedimientos` int PRIMARY KEY NOT NULL,
  `nombre_procedimientos` varchar(50) DEFAULT NULL
);

CREATE TABLE `productos` (
  `id_productos` int PRIMARY KEY NOT NULL,
  `codigo_productos` varchar(10) DEFAULT NULL,
  `nombre_productos` varchar(100) DEFAULT NULL,
  `tipo_productos` int NOT NULL,
  `presentacion_productos` int NOT NULL,
  `cantidad_productos` int DEFAULT NULL,
  `almacen_id` int DEFAULT NULL,
  `descripcion_productos` varchar(200) DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `roles` (
  `id_roles` int PRIMARY KEY NOT NULL,
  `nombre_roles` varchar(50) DEFAULT NULL,
  `esActivo` int NOT NULL DEFAULT "1",
  `create_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `modify_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `roles_permisos` (
  `id_roles_permisos` int PRIMARY KEY NOT NULL,
  `roles_id` int NOT NULL,
  `permisos_id` int NOT NULL
);

CREATE TABLE `rol_personal` (
  `id_rol_personal` int NOT NULL,
  `rol_id` int NOT NULL,
  `personal_id` int NOT NULL,
  `esActivo` int NOT NULL DEFAULT "1",
  `create_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `modify_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `erase_time` timestamp DEFAULT NULL
);

CREATE TABLE `secciones` (
  `id_secciones` int PRIMARY KEY NOT NULL,
  `nombre_secciones` varchar(50) NOT NULL
);

CREATE TABLE `servicios` (
  `id_servicios` int PRIMARY KEY NOT NULL,
  `nombre_servicios` varchar(50) DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `servicios_procedimientos` (
  `id_servicios_procedimientos` int PRIMARY KEY NOT NULL,
  `nombre_servicios_procedimientos` varchar(50) DEFAULT NULL,
  `servicio_id` int DEFAULT NULL,
  `procedimientos_id` int DEFAULT NULL
);

CREATE TABLE `tipo_componentes` (
  `id_tipo_componentes` int PRIMARY KEY NOT NULL,
  `nombre_tipo_componente` varchar(50) DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `tipo_equipo` (
  `id_tipo_equipo` int PRIMARY KEY NOT NULL,
  `nombre_tipo_equipo` varchar(50) DEFAULT NULL
);

CREATE TABLE `trabajos` (
  `id_trabajos` int PRIMARY KEY NOT NULL,
  `nombre_trabajo` varchar(50) DEFAULT NULL,
  `clientes_id` int DEFAULT NULL,
  `producto_id` int DEFAULT NULL,
  `servicio_id` int DEFAULT NULL,
  `equipo_id` int DEFAULT NULL,
  `usuarios_id` int DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL
);

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL COMMENT 'primary key',
  `nombre_usuario` varchar(50) NOT NULL,
  `usuario_password` varchar(50) NOT NULL,
  `personal_id` int NOT NULL,
  `esActivo` int NOT NULL DEFAULT "1",
  `create_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `modify_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `erase_time` timestamp DEFAULT NULL
);

CREATE TABLE `trabajo_servicio` (
  `id_trabajo_servicio` int NOT NULL COMMENT 'primary key',
  `trabajo_id` int NOT NULL,
  `servicio_id` int NOT NULL,
  `esActivo` int NOT NULL DEFAULT "1",
  `create_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `modify_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `erase_time` timestamp DEFAULT NULL
);

ALTER TABLE `clase_componentes` ADD FOREIGN KEY (`id_clase_componentes`) REFERENCES `componentes` (`clase_componentes_id`);

ALTER TABLE `area` ADD FOREIGN KEY (`id_area`) REFERENCES `equipos` (`area_id`);

ALTER TABLE `usuario` ADD FOREIGN KEY (`id_usuario`) REFERENCES `equipos` (`clientes_id`);

ALTER TABLE `tipo_equipo` ADD FOREIGN KEY (`id_tipo_equipo`) REFERENCES `equipos` (`tipo_equipo_id`);

ALTER TABLE `tipo_componentes` ADD FOREIGN KEY (`id_tipo_componentes`) REFERENCES `componentes` (`tipo_componentes_id`);

ALTER TABLE `presentacion` ADD FOREIGN KEY (`id_presentacion`) REFERENCES `productos` (`presentacion_productos`);

ALTER TABLE `almacen` ADD FOREIGN KEY (`id_almacen`) REFERENCES `productos` (`almacen_id`);

ALTER TABLE `equipos` ADD FOREIGN KEY (`id_equipos`) REFERENCES `equipo_componentes` (`equipo_id`);

ALTER TABLE `componentes` ADD FOREIGN KEY (`id_componentes`) REFERENCES `equipo_componentes` (`componentes_id`);

ALTER TABLE `roles` ADD FOREIGN KEY (`id_roles`) REFERENCES `rol_personal` (`rol_id`);

ALTER TABLE `roles` ADD FOREIGN KEY (`id_roles`) REFERENCES `roles_permisos` (`roles_id`);

ALTER TABLE `servicios` ADD FOREIGN KEY (`id_servicios`) REFERENCES `servicios_procedimientos` (`servicio_id`);

ALTER TABLE `procedimientos` ADD FOREIGN KEY (`id_procedimientos`) REFERENCES `servicios_procedimientos` (`procedimientos_id`);

ALTER TABLE `equipos` ADD FOREIGN KEY (`id_equipos`) REFERENCES `bajas` (`equipo_id`);

ALTER TABLE `trabajos` ADD FOREIGN KEY (`id_trabajos`) REFERENCES `trabajo_servicio` (`trabajo_id`);

ALTER TABLE `servicios` ADD FOREIGN KEY (`id_servicios`) REFERENCES `trabajo_servicio` (`servicio_id`);

ALTER TABLE `productos` ADD FOREIGN KEY (`id_productos`) REFERENCES `inventario` (`producto_id`);

ALTER TABLE `equipos` ADD FOREIGN KEY (`id_equipos`) REFERENCES `trabajos` (`equipo_id`);

ALTER TABLE `usuario` ADD FOREIGN KEY (`personal_id`) REFERENCES `rol_personal` (`personal_id`);

ALTER TABLE `categoria_marca` ADD FOREIGN KEY (`id_cateogria_marca`) REFERENCES `marca` (`categoria_marca_id`);

ALTER TABLE `productos` ADD FOREIGN KEY (`id_productos`) REFERENCES `componentes` (`producto_id`);

ALTER TABLE `marca` ADD FOREIGN KEY (`id_marca`) REFERENCES `modelo` (`marca_id`);

ALTER TABLE `modelo` ADD FOREIGN KEY (`id_modelo`) REFERENCES `componentes` (`modelo_id`);

ALTER TABLE `estado` ADD FOREIGN KEY (`id_estado`) REFERENCES `componentes` (`estado_id`);

ALTER TABLE `roles_permisos` ADD FOREIGN KEY (`permisos_id`) REFERENCES `permisos` (`id_permisos`);

ALTER TABLE `permisos` ADD FOREIGN KEY (`id_permisos`) REFERENCES `permisos_secciones` (`permisos_id`);

ALTER TABLE `secciones` ADD FOREIGN KEY (`id_secciones`) REFERENCES `permisos_secciones` (`secciones_id`);

ALTER TABLE `personal` ADD FOREIGN KEY (`id_personal`) REFERENCES `usuario` (`personal_id`);
