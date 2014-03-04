-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2014 at 11:00 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Database: `vive_gob_movil`
--
CREATE DATABASE IF NOT EXISTS `vive_gob_movil` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vive_gob_movil`;

-- --------------------------------------------------------

--
-- Table structure for table `aspectos_calificacion`
--

CREATE TABLE IF NOT EXISTS `aspectos_calificacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `valor_ponderacion` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aspectos_calificacion`
--

INSERT INTO `aspectos_calificacion` (`id`, `nombre`, `valor_ponderacion`) VALUES
(0, 'Usabilidad', 30),
(1, 'Interfaz Gráfica', 20),
(2, 'Funcionalidad', 30),
(3, 'Innovación', 20);

-- --------------------------------------------------------

--
-- Table structure for table `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_equipo` varchar(45) DEFAULT NULL,
  `fk_id_jurado` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `calificacion`
--

INSERT INTO `calificacion` (`id`, `fk_id_equipo`, `fk_id_jurado`) VALUES
(1, '8', '37393237');

-- --------------------------------------------------------

--
-- Table structure for table `criterios`
--

CREATE TABLE IF NOT EXISTS `criterios` (
  `id` int(3) NOT NULL,
  `criterio` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_id_aspectos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_aspectos` (`fk_id_aspectos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `criterios`
--

INSERT INTO `criterios` (`id`, `criterio`, `fk_id_aspectos`) VALUES
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
-- Table structure for table `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_id_reto` int(11) NOT NULL,
  `fk_id_juradoFuncional` int(11) NOT NULL,
  `fk_id_juradoTecnico` int(11) NOT NULL,
  `fk_id_juradoExterno` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `equipos`
--

INSERT INTO `equipos` (`id`, `nombre`, `fk_id_reto`, `fk_id_juradoFuncional`, `fk_id_juradoTecnico`, `fk_id_juradoExterno`) VALUES
(8, 'MyTeam', 1, 37393237, 2222222, 987654321);

-- --------------------------------------------------------

--
-- Table structure for table `evaluacion_reto`
--

CREATE TABLE IF NOT EXISTS `evaluacion_reto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_reto` varchar(45) DEFAULT NULL,
  `fk_id_evaluación` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `evaluaciones`
--

CREATE TABLE IF NOT EXISTS `evaluaciones` (
  `id` int(11) NOT NULL,
  `fk_id_criterio` int(4) NOT NULL,
  `calificacion` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(5) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `rol` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `rol`) VALUES
(1, 'admin', 'admin', 'administrador'),
(2, 'user', 'user', 'jurado');

-- --------------------------------------------------------

--
-- Table structure for table `persona`
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
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `apellido`, `usuario`, `clave`, `tipo`) VALUES
('2222222', 'John', 'Doe', 'jdoe', '123', 'jurado'),
('37393237', 'Tatiana', 'FlÃ³rez', 'tflorez', '123', 'jurado'),
('80378556', 'Wilmer', 'AmÃ©zquita', 'wamezquita', '80378556', 'administrador'),
('987654321', 'Jane', 'Doe', 'janed', '123', 'jurado');

-- --------------------------------------------------------

--
-- Table structure for table `retos`
--

CREATE TABLE IF NOT EXISTS `retos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `iteracion` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `retos`
--

INSERT INTO `retos` (`id`, `nombre`, `iteracion`) VALUES
(1, 'Prueba 1', 1),
(10, '', 0),
(11, 'En TIC Confio', 1);

-- --------------------------------------------------------

--
-- Table structure for table `valor_calificacion`
--

CREATE TABLE IF NOT EXISTS `valor_calificacion` (
  `id` int(11) NOT NULL,
  `fk_id_criterio` int(11) NOT NULL,
  `fk_id_calificacion` int(11) NOT NULL,
  `valor_calificacion` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `valor_calificacion`
--

INSERT INTO `valor_calificacion` (`id`, `fk_id_criterio`, `fk_id_calificacion`, `valor_calificacion`) VALUES
(0, 0, 1, 1),
(1, 1, 1, 4),
(2, 2, 1, 5),
(3, 3, 1, 3),
(4, 4, 1, 3),
(5, 5, 1, 2),
(6, 6, 1, 5),
(7, 7, 1, 2),
(8, 8, 1, 3),
(9, 9, 1, 2),
(10, 10, 1, 3),
(11, 11, 1, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
