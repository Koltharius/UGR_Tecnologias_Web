-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-06-2016 a las 23:18:19
-- Versión del servidor: 5.6.28
-- Versión de PHP: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `75152552y`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `Posicion` int(11) NOT NULL DEFAULT '1',
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(30) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Codigo_Alumno` varchar(30) NOT NULL,
  `Codigo_Revision` varchar(30) NOT NULL,
  `Estado` varchar(30) NOT NULL DEFAULT 'No atendido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`Posicion`, `Nombre`, `Apellidos`, `DNI`, `Email`, `Codigo_Alumno`, `Codigo_Revision`, `Estado`) VALUES
(1, 'Antonio', 'Sanchez Martinez', '77777777B', 'antonio@gmail.com', 'Ant777BTW1', 'TW16-1', 'No atendido'),
(4, 'Javier', 'Sanchez Garcia', '88888888Y', 'javier@gmail.com', 'Jav888YTW1', 'TW16-1', 'No atendido'),
(3, 'Laura', 'Sanchez Bueno', '11111111H', 'laura@gmail.com', 'Lau111HTW1', 'TW16-1', 'No atendido'),
(2, 'Luis', 'Jimenez Garcia', '44444444A', 'luis@gmail.com', 'Lui444ATW1', 'TW16-1', 'No atendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `Profesor` varchar(30) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Mensaje` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revisiones`
--

CREATE TABLE `revisiones` (
  `codigo_revision` varchar(30) NOT NULL,
  `Asignatura` varchar(30) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Lugar` varchar(30) NOT NULL,
  `Profesor` varchar(30) NOT NULL,
  `Estado` varchar(30) NOT NULL DEFAULT 'No activa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `revisiones`
--

INSERT INTO `revisiones` (`codigo_revision`, `Asignatura`, `Fecha`, `Hora`, `Lugar`, `Profesor`, `Estado`) VALUES
('FP16-3', 'FP', '2016-06-20', '04:20:03', 'A2.6', 'totidos@hotmail.com', 'No activa'),
('TDRC16-1', 'TDRC', '2016-06-30', '18:20:00', 'Despacho 2', 'totidos@hotmail.com', 'No activa'),
('TW16-1', 'TW', '2016-06-15', '23:15:00', 'Despacho 1', 'totidos@hotmail.com', 'No activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(30) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Nombre`, `Apellidos`, `DNI`, `Email`, `Password`, `Rol`) VALUES
('admin', 'admin admin', '77777777B', 'admin@admin', '21232f297a57a5a743894a0e4a801fc3', 'administrador'),
('David', 'Sanchez Jimenez', '75570649D', 'dasaji92@gmail.com', 'ab17ff251ffbb53b47e8de08e98a44ae', 'profesor'),
('Antonio', 'Alcala Martinez', '75152552Y', 'totidos@hotmail.com', '8f5b016f832942125d247282a5684364', 'profesor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`Codigo_Alumno`),
  ADD UNIQUE KEY `Codigo_Alumno` (`Codigo_Alumno`),
  ADD KEY `Codigo_Revision` (`Codigo_Revision`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`Profesor`);

--
-- Indices de la tabla `revisiones`
--
ALTER TABLE `revisiones`
  ADD PRIMARY KEY (`codigo_revision`),
  ADD UNIQUE KEY `codigo_revision` (`codigo_revision`) USING BTREE,
  ADD KEY `Profesor` (`Profesor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `DNI` (`DNI`,`Email`,`Rol`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`Codigo_Revision`) REFERENCES `revisiones` (`codigo_revision`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`Profesor`) REFERENCES `usuarios` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `revisiones`
--
ALTER TABLE `revisiones`
  ADD CONSTRAINT `revisiones_ibfk_1` FOREIGN KEY (`Profesor`) REFERENCES `usuarios` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
