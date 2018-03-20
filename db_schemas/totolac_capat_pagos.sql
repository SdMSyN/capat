-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2018 a las 23:08:59
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
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE IF NOT EXISTS `estatus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `pagos` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `usuario_data_id`, `tipo_servicio_id`, `fecha_inicio`, `fecha_fin`, `monto`, `estatus_id`, `ticket`, `creado`, `actualizado`) VALUES
(1, 5, 3, '2017-01-01', '2017-03-01', 1500.00, 2, NULL, '2018-03-20 13:26:00', '2018-03-20 13:26:00'),
(2, 5, 3, '2017-01-01', '2017-03-01', 1500.00, 2, NULL, '2018-03-20 13:28:00', '2018-03-20 13:28:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`), ADD KEY `usuario_data_id` (`usuario_data_id`,`tipo_servicio_id`), ADD KEY `tipo_servicio_id` (`tipo_servicio_id`), ADD KEY `estatus_id` (`estatus_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`tipo_servicio_id`) REFERENCES `tipos_servicios` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`usuario_data_id`) REFERENCES `usuarios_data` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `pagos_ibfk_3` FOREIGN KEY (`estatus_id`) REFERENCES `estatus` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
