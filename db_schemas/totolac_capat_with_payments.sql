-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2018 a las 06:50:03
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `totolac_capat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidades`
--

CREATE TABLE `comunidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comunidades`
--

INSERT INTO `comunidades` (`id`, `nombre`, `creado`) VALUES
(1, 'San Juan', '2018-01-25'),
(2, 'Acxotla del rÃ­o', '2018-01-28'),
(3, 'San Gabriel Cuahutla', '2018-02-02'),
(4, 'Ocotelulco', '2018-02-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id` int(11) NOT NULL,
  `tipo_contrato_id` int(11) DEFAULT NULL,
  `numero_contrato` varchar(20) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `tipo_contrato_id`, `numero_contrato`, `creado`) VALUES
(1, 2, '12345678', '2018-02-26'),
(2, 1, '20152445 ', '2018-02-26'),
(3, 1, '20151950', '2018-02-26'),
(4, 1, '20152698', '2018-02-26'),
(5, 1, '20152450 ', '2018-02-26'),
(6, 1, '20152444', '2018-02-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas`
--

CREATE TABLE `cuotas` (
  `id` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `cantidad` float(7,2) NOT NULL,
  `comunidad_id` int(11) NOT NULL,
  `tipo_servicio_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuotas`
--

INSERT INTO `cuotas` (`id`, `year`, `cantidad`, `comunidad_id`, `tipo_servicio_id`, `creado`) VALUES
(1, 1989, 35.00, 2, 1, '2018-01-31'),
(2, 2017, 39.00, 2, 2, '2018-02-01'),
(3, 2010, 100.00, 4, 3, '2018-02-13'),
(4, 2003, 105.00, 4, 3, '2018-02-13'),
(5, 1990, 37.00, 2, 1, '2018-03-18'),
(6, 1991, 40.00, 2, 1, '2018-03-18'),
(7, 1989, 200.00, 2, 3, '2018-03-19'),
(8, 2017, 250.00, 2, 1, '2018-03-19'),
(9, 2017, 500.00, 2, 3, '2018-03-19'),
(10, 2017, 150.00, 4, 3, '2018-03-19'),
(11, 2017, 100.00, 4, 1, '2018-03-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `comunidad_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `calle`, `comunidad_id`, `creado`) VALUES
(1, 'Av. RevoluciÃ³n', 2, '2018-02-26'),
(2, 'Av. JuÃ¡rez', 3, '2018-02-26'),
(3, 'Av. JuÃ¡rez', 2, '2018-02-26'),
(4, 'C. Leonarda Gomez', 2, '2018-02-26'),
(5, 'Buenos Aires', 4, '2018-03-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `nombre`) VALUES
(1, 'Pagado'),
(2, 'Por pagar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `usuario_data_id` int(11) NOT NULL,
  `tipo_servicio_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `monto` float(7,2) NOT NULL,
  `estatus_id` int(11) NOT NULL,
  `ticket` varchar(20) DEFAULT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`) VALUES
(1, 'Sysadmin'),
(2, 'Administrador'),
(3, 'Director'),
(4, 'Capturista'),
(5, 'Tecnico'),
(6, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_contratos`
--

CREATE TABLE `tipos_contratos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_contratos`
--

INSERT INTO `tipos_contratos` (`id`, `nombre`, `creado`) VALUES
(1, 'Domestico', '2018-02-07'),
(2, 'Comercial', '2018-02-07'),
(3, 'Industrial', '2018-02-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_servicios`
--

CREATE TABLE `tipos_servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_servicios`
--

INSERT INTO `tipos_servicios` (`id`, `nombre`, `creado`) VALUES
(1, 'Bajas2', '2018-01-28'),
(2, 'ReconexiÃ³n', '2018-01-28'),
(3, 'altas', '2018-02-02'),
(4, 'otro', '2018-02-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `usuario_data_id` int(11) DEFAULT NULL,
  `comunidad_id` int(11) DEFAULT NULL,
  `perfil_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `pass`, `usuario_data_id`, `comunidad_id`, `perfil_id`, `creado`) VALUES
(2, 'hector', 'hector', NULL, NULL, 3, '2018-01-24'),
(3, 'rosy', 'rosy', NULL, NULL, 4, '2018-02-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_data`
--

CREATE TABLE `usuarios_data` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ap` varchar(50) NOT NULL,
  `am` varchar(50) NOT NULL,
  `tarjeta` varchar(20) NOT NULL,
  `folio` varchar(20) NOT NULL,
  `contrato_id` int(11) NOT NULL,
  `direccion_id` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_data`
--

INSERT INTO `usuarios_data` (`id`, `name`, `ap`, `am`, `tarjeta`, `folio`, `contrato_id`, `direccion_id`, `numero`, `creado`) VALUES
(1, 'Luigi', 'PÃ©rez', 'Calzada', '12345678', '12345678', 1, 1, '168', '2018-02-26'),
(2, 'Job', 'Gutierrez', 'LeÃ³n', '20152445', '20152445', 2, 2, '02', '2018-02-26'),
(3, 'Mauricio', 'Rojas', 'CortÃ©s', '20151950', '20151950', 3, 5, '20', '2018-02-26'),
(4, 'Jorge Dioney', 'MartÃ­nez', 'VÃ¡zquez', '20152698', '20152698', 4, 4, '17', '2018-02-26'),
(5, 'Ivan', 'Herrera', 'PÃ©rez', '20152450 ', '20152450 ', 5, 1, '28', '2018-02-26'),
(6, 'Fernando', 'Guadalajara', 'LeÃ³n', '20152444', '20152444', 6, 1, '10', '2018-02-26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_contrato_id` (`tipo_contrato_id`);

--
-- Indices de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comunidad_id` (`comunidad_id`,`tipo_servicio_id`),
  ADD KEY `tipo_servicio_id` (`tipo_servicio_id`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comunidad_id` (`comunidad_id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_data_id` (`usuario_data_id`,`tipo_servicio_id`),
  ADD KEY `tipo_servicio_id` (`tipo_servicio_id`),
  ADD KEY `estatus_id` (`estatus_id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_contratos`
--
ALTER TABLE `tipos_contratos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_servicios`
--
ALTER TABLE `tipos_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_data_id` (`usuario_data_id`,`comunidad_id`,`perfil_id`),
  ADD KEY `comunidad_id` (`comunidad_id`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `usuarios_data`
--
ALTER TABLE `usuarios_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `direccion_id` (`direccion_id`),
  ADD KEY `contrato_id` (`contrato_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipos_contratos`
--
ALTER TABLE `tipos_contratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_servicios`
--
ALTER TABLE `tipos_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios_data`
--
ALTER TABLE `usuarios_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`tipo_contrato_id`) REFERENCES `tipos_contratos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD CONSTRAINT `cuotas_ibfk_1` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cuotas_ibfk_2` FOREIGN KEY (`tipo_servicio_id`) REFERENCES `tipos_servicios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`tipo_servicio_id`) REFERENCES `tipos_servicios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`usuario_data_id`) REFERENCES `usuarios_data` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_3` FOREIGN KEY (`estatus_id`) REFERENCES `estatus` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`usuario_data_id`) REFERENCES `usuarios_data` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_data`
--
ALTER TABLE `usuarios_data`
  ADD CONSTRAINT `usuarios_data_ibfk_1` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_data_ibfk_2` FOREIGN KEY (`direccion_id`) REFERENCES `direcciones` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
