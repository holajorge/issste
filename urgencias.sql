-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-08-2017 a las 05:07:42
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `urgencias`
--
CREATE DATABASE IF NOT EXISTS `urgencias` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `urgencias`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_administrador`, `nombre`, `apellido`, `cedula`, `correo`, `username`, `password`, `tipo_usuario`) VALUES
(1, 'JORGE', 'FRANCISCO', '1234', 'jorg@ho.co', 'admin', 'admin', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion_paciente`
--

CREATE TABLE `clasificacion_paciente` (
  `id_clasificacion_paciente` int(11) NOT NULL,
  `clasificacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clasificacion_paciente`
--

INSERT INTO `clasificacion_paciente` (`id_clasificacion_paciente`, `clasificacion`) VALUES
(1, 'VERDE'),
(2, 'AMARILLO'),
(3, 'ROJO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta_paciente`
--

CREATE TABLE `consulta_paciente` (
  `id_consulta_paciente` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rfc` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `edad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `vigencia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo_paciente` int(11) NOT NULL,
  `id_clasificacion_paciente` int(11) NOT NULL,
  `go` bit(1) NOT NULL,
  `folio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora_llegada` time NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `baja` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorio`
--

CREATE TABLE `consultorio` (
  `id_consultorio` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `id_doctor` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `id_consultorio` int(11) NOT NULL,
  `username` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermero`
--

CREATE TABLE `enfermero` (
  `id_enfermero` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`) VALUES
(1, 'espera'),
(2, 'atendiendo'),
(3, 'atendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faltantes`
--

CREATE TABLE `faltantes` (
  `id_falta` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci,
  `apellido` varchar(150) COLLATE utf8_spanish_ci,
  `rfc` varchar(150) COLLATE utf8_spanish_ci,
  `tipo_paciente` varchar(50) COLLATE utf8_spanish_ci DEFAULT '0',
  `clasificacion` int(11) DEFAULT '0',
  `hora_llegada` time DEFAULT '00:00:00',
  `hora_baja` time DEFAULT '00:00:00',
  `fecha` date,
  `id_doctor` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitoreollamadas`
--

CREATE TABLE `monitoreollamadas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_consultorio` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `ape_pate` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `ape_mate` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rfc` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `vigencia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `baja` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes_consultados`
--

CREATE TABLE `pacientes_consultados` (
  `id_pacientes_consultados` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `id_consulta_paciente` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `hora_atendido` time NOT NULL DEFAULT '00:00:00',
  `tiempo` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_espera`
--

CREATE TABLE `paciente_espera` (
  `id_espera` int(11) NOT NULL,
  `id_consulta_paciente` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_paciente`
--

CREATE TABLE `tipo_paciente` (
  `id_tipo_paciente` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_paciente`
--

INSERT INTO `tipo_paciente` (`id_tipo_paciente`, `tipo`) VALUES
(1, 'NIÑO'),
(2, 'ADOLECENTE'),
(3, 'JOVEN'),
(4, 'ADULTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `tipo_usuario` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`tipo_usuario`, `user`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_administrador`),
  ADD KEY `tipo_usuario` (`tipo_usuario`);

--
-- Indices de la tabla `clasificacion_paciente`
--
ALTER TABLE `clasificacion_paciente`
  ADD PRIMARY KEY (`id_clasificacion_paciente`);

--
-- Indices de la tabla `consulta_paciente`
--
ALTER TABLE `consulta_paciente`
  ADD PRIMARY KEY (`id_consulta_paciente`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_clasificacion_paciente` (`id_clasificacion_paciente`),
  ADD KEY `id_tipo_paciente` (`id_tipo_paciente`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `consultorio`
--
ALTER TABLE `consultorio`
  ADD PRIMARY KEY (`id_consultorio`);

--
-- Indices de la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id_doctor`),
  ADD KEY `id_consultorio` (`id_consultorio`),
  ADD KEY `tipo_usuario` (`tipo_usuario`);

--
-- Indices de la tabla `enfermero`
--
ALTER TABLE `enfermero`
  ADD PRIMARY KEY (`id_enfermero`),
  ADD KEY `tipo_usuario` (`tipo_usuario`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `faltantes`
--
ALTER TABLE `faltantes`
  ADD PRIMARY KEY (`id_falta`),
  ADD KEY `id_doctor` (`id_doctor`);

--
-- Indices de la tabla `monitoreollamadas`
--
ALTER TABLE `monitoreollamadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_consultorio` (`id_consultorio`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `pacientes_consultados`
--
ALTER TABLE `pacientes_consultados`
  ADD PRIMARY KEY (`id_pacientes_consultados`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_consulta_paciente` (`id_consulta_paciente`),
  ADD KEY `id_consulta_paciente_2` (`id_consulta_paciente`),
  ADD KEY `id_doctor_2` (`id_doctor`);

--
-- Indices de la tabla `paciente_espera`
--
ALTER TABLE `paciente_espera`
  ADD PRIMARY KEY (`id_espera`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_consulta_paciente` (`id_consulta_paciente`);

--
-- Indices de la tabla `tipo_paciente`
--
ALTER TABLE `tipo_paciente`
  ADD PRIMARY KEY (`id_tipo_paciente`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `clasificacion_paciente`
--
ALTER TABLE `clasificacion_paciente`
  MODIFY `id_clasificacion_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `consulta_paciente`
--
ALTER TABLE `consulta_paciente`
  MODIFY `id_consulta_paciente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `consultorio`
--
ALTER TABLE `consultorio`
  MODIFY `id_consultorio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id_doctor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `enfermero`
--
ALTER TABLE `enfermero`
  MODIFY `id_enfermero` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `faltantes`
--
ALTER TABLE `faltantes`
  MODIFY `id_falta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `monitoreollamadas`
--
ALTER TABLE `monitoreollamadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pacientes_consultados`
--
ALTER TABLE `pacientes_consultados`
  MODIFY `id_pacientes_consultados` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paciente_espera`
--
ALTER TABLE `paciente_espera`
  MODIFY `id_espera` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_paciente`
--
ALTER TABLE `tipo_paciente`
  MODIFY `id_tipo_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`tipo_usuario`) REFERENCES `users` (`tipo_usuario`);

--
-- Filtros para la tabla `consulta_paciente`
--
ALTER TABLE `consulta_paciente`
  ADD CONSTRAINT `consulta_paciente_ibfk_1` FOREIGN KEY (`id_tipo_paciente`) REFERENCES `tipo_paciente` (`id_tipo_paciente`),
  ADD CONSTRAINT `consulta_paciente_ibfk_2` FOREIGN KEY (`id_clasificacion_paciente`) REFERENCES `clasificacion_paciente` (`id_clasificacion_paciente`),
  ADD CONSTRAINT `consulta_paciente_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `consulta_paciente_ibfk_4` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);

--
-- Filtros para la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`id_consultorio`) REFERENCES `consultorio` (`id_consultorio`);

--
-- Filtros para la tabla `enfermero`
--
ALTER TABLE `enfermero`
  ADD CONSTRAINT `tipo_usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `users` (`tipo_usuario`);

--
-- Filtros para la tabla `faltantes`
--
ALTER TABLE `faltantes`
  ADD CONSTRAINT `faltantes_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`);

--
-- Filtros para la tabla `monitoreollamadas`
--
ALTER TABLE `monitoreollamadas`
  ADD CONSTRAINT `monitoreollamadas_ibfk_1` FOREIGN KEY (`id_consultorio`) REFERENCES `consultorio` (`id_consultorio`);

--
-- Filtros para la tabla `pacientes_consultados`
--
ALTER TABLE `pacientes_consultados`
  ADD CONSTRAINT `pacientes_consultados_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`),
  ADD CONSTRAINT `pacientes_consultados_ibfk_2` FOREIGN KEY (`id_consulta_paciente`) REFERENCES `consulta_paciente` (`id_consulta_paciente`);

--
-- Filtros para la tabla `paciente_espera`
--
ALTER TABLE `paciente_espera`
  ADD CONSTRAINT `paciente_espera_ibfk_1` FOREIGN KEY (`id_consulta_paciente`) REFERENCES `consulta_paciente` (`id_consulta_paciente`),
  ADD CONSTRAINT `paciente_espera_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
