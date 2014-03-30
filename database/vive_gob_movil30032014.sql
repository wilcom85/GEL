-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-03-2014 a las 05:57:17
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `vive_gob_movil`
--
CREATE DATABASE IF NOT EXISTS `vive_gob_movil` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vive_gob_movil`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aspectos_calificacion`
--

CREATE TABLE IF NOT EXISTS `aspectos_calificacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `valor_ponderacion` int(2) NOT NULL,
  `valor_pregunta` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aspectos_calificacion`
--

INSERT INTO `aspectos_calificacion` (`id`, `nombre`, `valor_ponderacion`, `valor_pregunta`) VALUES
(0, 'Usabilidad', 20, '10'),
(1, 'Viabilidad', 20, '10'),
(2, 'Funcionalidad', 20, '10'),
(3, 'Innovacion', 20, '10'),
(4, 'InterGrafica', 15, '7.5'),
(5, 'Interredes', 5, '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_equipo` varchar(45) DEFAULT NULL,
  `fk_id_jurado` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion_jurado`
--

CREATE TABLE IF NOT EXISTS `calificacion_jurado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calificacion0` float NOT NULL,
  `calificacion1` float NOT NULL,
  `calificacion2` float NOT NULL,
  `calificacion3` float NOT NULL,
  `calificacion4` float NOT NULL,
  `calificacion5` float NOT NULL,
  `calificacion6` float NOT NULL,
  `calificacion7` float NOT NULL,
  `calificacion8` float NOT NULL,
  `calificacion9` float NOT NULL,
  `calificacion10` float NOT NULL,
  `nombre_jurado` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nombre_equipo` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nombre_reto` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fk_id_calificacion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterios`
--

CREATE TABLE IF NOT EXISTS `criterios` (
  `id` int(3) NOT NULL,
  `criterio` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_id_aspectos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_aspectos` (`fk_id_aspectos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `criterios`
--

INSERT INTO `criterios` (`id`, `criterio`, `fk_id_aspectos`) VALUES
(0, 'La aplicación plantea un enfoque de uso fácil y proyecta un acceso sencillo e intuitivo para sus funcionalidades.', 0),
(1, ' La aplicación utiliza los servicios de accesibilidad disponibles en los sistemas operativos y dispositivos, o tiene funciones propias de accesibilidad', 0),
(2, 'El equipo presenta de manera clara y con el suficiente sustento técnico la aplicación propuesta.', 1),
(3, 'Es viable desarrollar completamente las funcionalidades propuestas en el tiempo establecido para concluir la aplicación (8 semanas).', 1),
(4, 'La aplicación resuelve la problemática presentada en el reto.', 2),
(5, ' Las funcionalidades están en un nivel avanzado de desarrollo.', 2),
(6, 'La aplicación resuelve el problema de una manera novedosa.', 3),
(7, 'La aplicación va más allá de lo presentado en el reto.', 3),
(8, 'La aplicación manejará uniformidad de colores, y presentación agradable para el usuario.', 4),
(9, 'Los elementos gráficos usados tienen una nitidez adecuada y comunican claramente la funcionalidad a la que representan.', 4),
(10, ' La aplicación se integra con redes sociales', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_id_reto` int(11) NOT NULL,
  `fk_id_juradoFuncional` text NOT NULL,
  `fk_id_juradoTecnico` text NOT NULL,
  `fk_id_juradoExterno` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE IF NOT EXISTS `evaluaciones` (
  `id` int(11) NOT NULL,
  `fk_id_criterio` int(4) NOT NULL,
  `calificacion` int(2) NOT NULL,
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
('2222222', 'John', 'Doe', 'jdoe', '123', 'jurado'),
('37393237', 'Tatiana', 'FlÃ³rez', 'tflorez', '123', 'jurado'),
('80378556', 'Wilmer', 'AmÃ©zquita', 'wamezquita', '80378556', 'administrador'),
('987654321', 'Jane', 'Doe', 'janed', '123', 'jurado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retos`
--

CREATE TABLE IF NOT EXISTS `retos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `iteracion` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `retos`
--

INSERT INTO `retos` (`id`, `nombre`, `iteracion`) VALUES
(1, 'AtenciÃ³n MÃ©dica Especializada', 5),
(2, 'Planea tu Ruta de Transmetro', 5),
(3, 'Alertas Sobre Consumo de Drogas', 5),
(4, 'Acceso al Conocimiento', 5),
(5, 'Si JÃ³ven MÃ³vil', 5),
(6, 'El INCI se mueve contigo', 5),
(7, 'RecolecciÃ³n Posconsumo', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_calificacion`
--

CREATE TABLE IF NOT EXISTS `valor_calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_criterio` int(11) NOT NULL,
  `fk_id_calificacion` int(11) NOT NULL,
  `valor_calificacion` double NOT NULL,
  `total_calificacion` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
