-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2018 a las 02:59:28
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `totolac_capat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidades`
--

CREATE TABLE IF NOT EXISTS `comunidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `contratos` (
  `id` int(11) NOT NULL,
  `tipo_contrato_id` int(11) NOT NULL,
  `numero_contrato` varchar(20) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `cuotas` (
  `id` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `cantidad` float(7,2) NOT NULL,
  `comunidad_id` int(11) NOT NULL,
  `tipo_servicio_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuotas`
--

INSERT INTO `cuotas` (`id`, `year`, `cantidad`, `comunidad_id`, `tipo_servicio_id`, `creado`) VALUES
(1, 1989, 35.00, 2, 1, '2018-01-31'),
(2, 2017, 39.00, 2, 2, '2018-02-01'),
(3, 2010, 100.00, 4, 3, '2018-02-13'),
(4, 2003, 105.00, 4, 3, '2018-02-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE IF NOT EXISTS `direcciones` (
  `id` int(11) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `comunidad_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `calle`, `comunidad_id`, `creado`) VALUES
(1, 'Av. RevoluciÃ³n', 2, '2018-02-26'),
(2, 'Av. JuÃ¡rez', 3, '2018-02-26'),
(3, 'Av. JuÃ¡rez', 2, '2018-02-26'),
(4, 'C. Leonarda Gomez', 2, '2018-02-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `tipos_contratos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `tipos_servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `usuario_data_id` int(11) DEFAULT NULL,
  `comunidad_id` int(11) DEFAULT NULL,
  `perfil_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `usuarios_data` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_data`
--

INSERT INTO `usuarios_data` (`id`, `name`, `ap`, `am`, `tarjeta`, `folio`, `contrato_id`, `direccion_id`, `numero`, `creado`) VALUES
(1, 'Luigi', 'PÃ©rez', 'Calzada', '12345678', '12345678', 1, 1, '168', '2018-02-26'),
(2, 'Job', 'Gutierrez', 'LeÃ³n', '20152445', '20152445', 2, 2, '02', '2018-02-26'),
(3, 'Mauricio', 'Rojas', 'CortÃ©s', '20151950', '20151950', 3, 3, '20', '2018-02-26'),
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
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD PRIMARY KEY (`id`), ADD KEY `comunidad_id` (`comunidad_id`,`tipo_servicio_id`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`), ADD KEY `comunidad_id` (`comunidad_id`);

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
  ADD PRIMARY KEY (`id`), ADD KEY `usuario_data_id` (`usuario_data_id`,`comunidad_id`,`perfil_id`), ADD KEY `comunidad_id` (`comunidad_id`), ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `usuarios_data`
--
ALTER TABLE `usuarios_data`
  ADD PRIMARY KEY (`id`), ADD KEY `direccion_id` (`direccion_id`), ADD KEY `contrato_id` (`contrato_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tipos_contratos`
--
ALTER TABLE `tipos_contratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipos_servicios`
--
ALTER TABLE `tipos_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios_data`
--
ALTER TABLE `usuarios_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`) ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
