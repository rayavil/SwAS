-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2016 a las 17:18:45
-- Versión del servidor: 5.7.9
-- Versión de PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_apac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_paciente`
--

DROP TABLE IF EXISTS `detalles_paciente`;
CREATE TABLE IF NOT EXISTS `detalles_paciente` (
  `Det_Id` int(11) NOT NULL,
  `Det_Curp` varchar(18) NOT NULL,
  `Det_Tiposangre` varchar(4) NOT NULL,
  `Det_Nss` varchar(11) NOT NULL,
  `Det_Observ` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pago`
--

DROP TABLE IF EXISTS `detalle_pago`;
CREATE TABLE IF NOT EXISTS `detalle_pago` (
  `DetP_IdServ` int(11) NOT NULL,
  `DetP_FolioPago` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente regular`
--

DROP TABLE IF EXISTS `paciente regular`;
CREATE TABLE IF NOT EXISTS `paciente regular` (
  `PacR_Id` int(11) NOT NULL,
  `PacR_CostoValInici` int(11) NOT NULL,
  `PacR_InscAnual` int(11) NOT NULL,
  `PacR_CuotaM` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `Pac_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Pac_Nom` varchar(25) NOT NULL,
  `Pac_App` varchar(35) NOT NULL,
  `Pac_Fnac` date NOT NULL,
  `Pac_Direc` varchar(50) NOT NULL,
  `Pac_Cont` varchar(25) NOT NULL,
  `Pac_Telef` varchar(13) NOT NULL,
  `Pac_Cel` varchar(13) NOT NULL,
  `Pac_Activo` tinyint(4) NOT NULL,
  `Pac_Falt` timestamp NOT NULL,
  PRIMARY KEY (`Pac_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes externos`
--

DROP TABLE IF EXISTS `pacientes externos`;
CREATE TABLE IF NOT EXISTS `pacientes externos` (
  `PacE_Id` int(11) NOT NULL,
  `PacE_CostoValIni` int(11) NOT NULL,
  `PacE_CuotaServ` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `Pag_Folio` int(11) NOT NULL,
  `Pag_ValorIinc` varchar(300) NOT NULL,
  `Pag_Cuota` int(11) NOT NULL,
  `Pag_Fech` timestamp NOT NULL,
  `Pag_InscAnual` int(11) NOT NULL,
  `Pag_CuotaMens` int(11) NOT NULL,
  `Pag_Otros` varchar(300) NOT NULL,
  `Pag_IdPac` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
