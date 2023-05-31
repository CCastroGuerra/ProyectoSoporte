CREATE TABLE `almacen` (
  `id_almacen` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `inventario_id` int DEFAULT NULL,
  `fecha_entrada` TIMESTAMP NULL DEFAULT NULL,
  `fecha_salida` TIMESTAMP NULL DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `cantidad` int DEFAULT NULL
);

CREATE TABLE `area` (
  `id_area` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_area` varchar(50) DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `bajas` (
  `id_bajas` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `motivo` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `equipo_id` int DEFAULT NULL,
  `usuarios_id` int DEFAULT NULL,
  `fecha_baja` TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_categoria` varchar(100) NOT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `categoria_marca` (
  `id_categoria_marca` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_categoria_marca` varchar(50) DEFAULT NULL
);

CREATE TABLE `clase_componentes` (
  `id_clase_componentes` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_clase` varchar(50) DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `componentes` (
  `id_componentes` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `tipo_componentes_id` int DEFAULT NULL,
  `clase_componentes_id` int DEFAULT NULL,
  `marca_id` int DEFAULT NULL,
  `modelo_id` int DEFAULT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `estado_id` int DEFAULT NULL,
  `producto_id` int DEFAULT NULL,
  `es_activo` int DEFAULT NULL,
  `fecha_alta` TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP,
  `fecha_borrado` TIMESTAMP null
);

CREATE TABLE `equipos` (
  `id_equipos` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `codigo` int DEFAULT NULL,
  `codigo_productos` varchar(10) DEFAULT NULL,
  `tipo_equipo_id` int DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  `clientes_id` int DEFAULT NULL,
  `estado_id` int DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `mac` varchar(50) DEFAULT NULL,
  `fecha_alta` TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP,
  `fecha_modify` TIMESTAMP null on UPDATE CURRENT_TIMESTAMP,
  `fecha_borrado` TIMESTAMP null,
  `es_activo` int DEFAULT NULL
);

CREATE TABLE `equipo_componentes` (
  `id_equipo_componentes` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `equipo_id` int DEFAULT NULL,
  `componentes_id` int DEFAULT NULL,
  `fecha_alta` TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP,
  `fecha_modify` TIMESTAMP null on UPDATE CURRENT_TIMESTAMP,
  `fecha_borrado` TIMESTAMP null
);

CREATE TABLE `estado` (
  `id_estado` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_estado` varchar(50) DEFAULT NULL
);

CREATE TABLE `inventario` (
  `id_inventario` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `producto_id` int DEFAULT NULL,
  `cantidad` int NOT NULL
);

CREATE TABLE `marca` (
  `id_marca` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_marca` varchar(50) DEFAULT NULL,
  `categoria_marca_id` int DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `modelo` (
  `id_modelo` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_modelo` varchar(50) DEFAULT NULL,
  `marca_id` int NOT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `permisos` (
  `id_permisos` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_permisos` varchar(50) NOT NULL
);

CREATE TABLE `permisos_secciones` (
  `id_permisos_secciones` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `permisos_id` int NOT NULL,
  `secciones_id` int NOT NULL
);

CREATE TABLE `personal` (
  `id_personal` int PRIMARY KEY NOT NULL auto_increment COMMENT 'primary key',
  `nombre_personal` varchar(50) NOT NULL,
  `apellidos_personal` varchar(50) NOT NULL,
  `dni_personal` varchar(8) NOT NULL,
  `correo_personal` varchar(50) NOT NULL,
  `telefono_personal` varchar(50) NOT NULL,
  `cargo_personal` varchar(50) NOT NULL,
  `estado_personal` int NOT NULL DEFAULT "1",
  `esActivo_personal` int NOT NULL DEFAULT "1",
  `create_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `modify_time` timestamp NULL on update CURRENT_TIMESTAMP,
  `erase_time` TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE `presentacion` (
  `id_presentacion` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_presentacion` varchar(50) NOT NULL,
  `es_activo` int NOT NULL
);

CREATE TABLE `procedimientos` (
  `id_procedimientos` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_procedimientos` varchar(50) DEFAULT NULL
);

CREATE TABLE `productos` (
  `id_productos` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
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
  `id_roles` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_roles` varchar(50) DEFAULT NULL,
  `esActivo` int NOT NULL DEFAULT "1",
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_time` timestamp NULL on UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `roles_permisos` (
  `id_roles_permisos` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `roles_id` int NOT NULL,
  `permisos_id` int NOT NULL
);

CREATE TABLE `rol_usuario` (
  `id_rol_personal` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `rol_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `esActivo` int NOT NULL DEFAULT "1",
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_time` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
  `erase_time` TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE `secciones` (
  `id_secciones` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_secciones` varchar(50) NOT NULL
);

CREATE TABLE `servicios` (
  `id_servicios` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_servicios` varchar(50) DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `servicios_procedimientos` (
  `id_servicios_procedimientos` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_servicios_procedimientos` varchar(50) DEFAULT NULL,
  `servicio_id` int DEFAULT NULL,
  `procedimientos_id` int DEFAULT NULL
);

CREATE TABLE `tipo_componentes` (
  `id_tipo_componentes` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_tipo_componente` varchar(50) DEFAULT NULL,
  `esActivo` int NOT NULL
);

CREATE TABLE `tipo_equipo` (
  `id_tipo_equipo` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_tipo_equipo` varchar(50) DEFAULT NULL
);

CREATE TABLE `tipo_componente` (
  `id_tipo_componente` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_tipo_componente` varchar(50) DEFAULT NULL
);

CREATE TABLE `trabajos` (
  `id_trabajos` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_trabajo` varchar(50) DEFAULT NULL,
  `clientes_id` int DEFAULT NULL,
  `producto_id` int DEFAULT NULL,
  `servicio_id` int DEFAULT NULL,
  `equipo_id` int DEFAULT NULL,
  `usuarios_id` int DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `fecha_alta` TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP,
  `fecha_modify` TIMESTAMP null on UPDATE CURRENT_TIMESTAMP,
  `fecha_borrado` TIMESTAMP null
);

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `nombre_usuario` varchar(50) NOT NULL,
  `usuario_password` varchar(50) NOT NULL,
  `personal_id` int NOT NULL,
  `esActivo` int NOT NULL DEFAULT "1",
  `create_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `modify_time` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
  `erase_time` TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE `trabajo_servicio` (
  `id_trabajo_servicio` int NOT NULL primary KEY auto_increment COMMENT 'primary key',
  `trabajo_id` int NOT NULL,
  `servicio_id` int NOT NULL,
  `esActivo` int NOT NULL DEFAULT "1",
  `create_time` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `modify_time` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
  `erase_time` TIMESTAMP NULL DEFAULT NULL
);

ALTER TABLE `equipos` ADD FOREIGN KEY (`area_id`) REFERENCES `area` (`id_area`);

ALTER TABLE `equipos` ADD FOREIGN KEY (`clientes_id`) REFERENCES `personal` (`id_personal`);

ALTER TABLE `equipos` ADD FOREIGN KEY (`tipo_equipo_id`) REFERENCES `tipo_equipo` (`id_tipo_equipo`);

ALTER TABLE `componentes` ADD FOREIGN KEY (`tipo_componentes_id`) REFERENCES `tipo_componentes` (`id_tipo_componentes`);

ALTER TABLE `productos` ADD FOREIGN KEY (`presentacion_productos`) REFERENCES `presentacion` (`id_presentacion`);

ALTER TABLE `productos` ADD FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`id_almacen`);

ALTER TABLE `equipo_componentes` ADD FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id_equipos`);

ALTER TABLE `equipo_componentes` ADD FOREIGN KEY (`componentes_id`) REFERENCES `componentes` (`id_componentes`);

ALTER TABLE `rol_usuario` ADD FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_roles`);

ALTER TABLE `roles_permisos` ADD FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id_roles`);

ALTER TABLE `servicios_procedimientos` ADD FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id_servicios`);

ALTER TABLE `servicios_procedimientos` ADD FOREIGN KEY (`procedimientos_id`) REFERENCES `procedimientos` (`id_procedimientos`);

ALTER TABLE `bajas` ADD FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id_equipos`);

ALTER TABLE `trabajo_servicio` ADD FOREIGN KEY (`trabajo_id`) REFERENCES `trabajos` (`id_trabajos`);

ALTER TABLE `trabajo_servicio` ADD FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id_servicios`);

ALTER TABLE `inventario` ADD FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_productos`);

ALTER TABLE `trabajos` ADD FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id_equipos`);

ALTER TABLE `rol_usuario` ADD FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`);

ALTER TABLE `marca` ADD FOREIGN KEY (`categoria_marca_id`) REFERENCES `categoria_marca` (`id_categoria_marca`);

ALTER TABLE `componentes` ADD FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_productos`);

ALTER TABLE `modelo` ADD FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id_marca`);

ALTER TABLE `componentes` ADD FOREIGN KEY (`modelo_id`) REFERENCES `modelo` (`id_modelo`);

ALTER TABLE `componentes` ADD FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id_estado`);

ALTER TABLE `roles_permisos` ADD FOREIGN KEY (`permisos_id`) REFERENCES `permisos` (`id_permisos`);

ALTER TABLE `permisos_secciones` ADD FOREIGN KEY (`permisos_id`) REFERENCES `permisos` (`id_permisos`);

ALTER TABLE `permisos_secciones` ADD FOREIGN KEY (`secciones_id`) REFERENCES `secciones` (`id_secciones`);

ALTER TABLE `usuario` ADD FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id_personal`);

ALTER TABLE `componentes` ADD FOREIGN KEY (`clase_componentes_id`) REFERENCES `clase_componentes` (`id_clase_componentes`);
