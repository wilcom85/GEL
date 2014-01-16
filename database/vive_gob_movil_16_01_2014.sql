-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-01-2014 a las 05:38:53
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `vive_gob_movil`
--
CREATE DATABASE IF NOT EXISTS `vive_gob_movil` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `vive_gob_movil`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aspectos_calificacion`
--

CREATE TABLE IF NOT EXISTS `aspectos_calificacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `valor_ponderacion` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aspectos_calificacion`
--

INSERT INTO `aspectos_calificacion` (`id`, `nombre`, `valor_ponderacion`) VALUES
(0, 'Usabilidad', 30),
(1, 'Interfaz Gráfica', 20),
(2, 'Funcionalidad', 30),
(3, 'Innovación', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_equipo` varchar(45) DEFAULT NULL,
  `fk_id_jurado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterios_calificacion`
--

CREATE TABLE IF NOT EXISTS `criterios_calificacion` (
  `id` int(3) NOT NULL,
  `criterio` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_id_aspectos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_aspectos` (`fk_id_aspectos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `criterios_calificacion`
--

INSERT INTO `criterios_calificacion` (`id`, `criterio`, `fk_id_aspectos`) VALUES
(0, 'La aplicación plantea tiempos de respuesta aceptable en todas sus funcionalidades.\r\n', 0),
(1, 'La presentación de la aplicación se puede utilizar sin tener mucho conocimiento previo.', 0),
(2, 'La aplicación plantea tiempos de respuesta aceptable en todas sus funcionalidades.', 0),
(3, 'La aplicación plantea un lineamiento gráfico para todas sus pantallas.', 0),
(4, 'La aplicación manejará uniformidad de colores (cuando aplique),  y presentación agradable para el usuario.', 0),
(5, 'Los elementos gráficos usados tienen una nitidez adecuada y comunican claramente la funcionalidad a la que representan.', 0),
(6, 'La aplicación resuelve la problemática presentada en el reto.', 0),
(7, 'Es viable desarrollar completamente las funcionalidades propuestas en el tiempo establecido para concluir la aplicación (8 semanas).', 0),
(8, 'Las funcionalidades desarrolladas están completas o en un nivel avanzado de desarrollo.', 0),
(9, 'La aplicación es innovadora.', 0),
(10, 'La aplicación combina las fuentes de información disponibles de una manera novedosa.', 0),
(11, 'La aplicación supone curiosidad y gusto por la renovación.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_id_reto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `nombre`, `fk_id_reto`) VALUES
(1, 'Team Mate', 1),
(2, 'Team Track', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE IF NOT EXISTS `evaluaciones` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_reto`
--

CREATE TABLE IF NOT EXISTS `evaluacion_reto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_reto` varchar(45) DEFAULT NULL,
  `fk_id_evaluación` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `id`
--

CREATE TABLE IF NOT EXISTS `id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_persona` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(5) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `rol` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `rol`) VALUES
(1, 'admin', 'admin', 'administrador'),
(2, 'user', 'user', 'jurado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(100) CHARACTER SET utf32 COLLATE utf32_spanish_ci DEFAULT NULL,
  `clave` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` varchar(50) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `apellido`, `usuario`, `clave`, `tipo`) VALUES
('80378556', 'Wilmer', 'AmÃ©zquita', 'wamezquita', '80378556', 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retos`
--

CREATE TABLE IF NOT EXISTS `retos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `iteracion` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `retos`
--

INSERT INTO `retos` (`id`, `nombre`, `iteracion`) VALUES
(1, 'Prueba 1', 1),
(10, '', 0),
(11, 'En TIC Confio', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
