-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2024 a las 02:25:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica_vacaciones_felices`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `CODCITA` int(11) NOT NULL,
  `CODP` int(11) DEFAULT NULL,
  `CODM` int(11) DEFAULT NULL,
  `FECHACITA` datetime DEFAULT NULL,
  `DIAGNOSTICO` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`CODCITA`, `CODP`, `CODM`, `FECHACITA`, `DIAGNOSTICO`) VALUES
(2, 2, 1, '2024-07-27 22:47:00', 'escoliosis de ombligo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticos`
--

CREATE TABLE `diagnosticos` (
  `CODDIAG` int(11) NOT NULL,
  `DESCDIAGNOSTICO` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `CODM` int(11) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `ESPECIALIDAD` varchar(100) DEFAULT NULL,
  `TURNO` varchar(50) DEFAULT NULL,
  `DISPONIBILIDAD` varchar(50) DEFAULT NULL,
  `CANT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`CODM`, `NOMBRE`, `ESPECIALIDAD`, `TURNO`, `DISPONIBILIDAD`, `CANT`) VALUES
(1, 'Ruben Blade', 'Otorrinonaringologo', 'Diurnonoctro22', 'Toda la vida milove', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `CODP` int(11) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `FECHANAC` date DEFAULT NULL,
  `SEXO` char(1) DEFAULT NULL,
  `CORREO` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`CODP`, `NOMBRE`, `FECHANAC`, `SEXO`, `CORREO`) VALUES
(2, 'fsdfsdfasdfasd', '2024-07-09', 'M', 'jjohanjjbr@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID`, `NOMBRE`) VALUES
(1, 'Administrador'),
(2, 'Médico'),
(3, 'Enfermero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ROLE` int(11) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `USERNAME`, `PASSWORD`, `ROLE`, `NOMBRE`, `EMAIL`) VALUES
(1, 'Gepeto13', '$2y$10$V3AC5bnQCxpZJ/57.uQkveizi5UmBtddIyDQ.wGA.D4DMnOiq8U7K', 1, 'Gepeto', 'gepetin@gmail.com'),
(2, 'Gepeto13', '$2y$10$gq8/onXSGSttVthr6Hc9h.qBOd21z9S8PNFhUumkYVu69AK3LizXu', 1, 'Gepeto', 'gepetin@gmail.com'),
(3, 'Gepeto13', '$2y$10$hvalmfRfDYW0.VD1fk/s6.ZsZ6JzE5XAwZLPSD/QfSYmfsWONMCYK', 1, 'Gepeto', 'gepetin@gmail.com'),
(4, 'Gepeto13', '$2y$10$90f3xM1XfYxOp6W9jC2y7eTvyN5k3YZLnV1p.MbFtRDNK/a6HR5iG', 1, 'Gepeto', 'gepetin@gmail.com'),
(5, 'Gepeto13', '$2y$10$mYxu0WI2BeraL15gnbDzQuvtcOTs/kB24K9BdC0iQ054LM59h4CEG', 1, 'Gepeto', 'gepetin@gmail.com'),
(6, 'tomas', '$2y$10$HMnxWqkMyMSU4.a0TIkVsOGHJtFnF6D9bg1rSQZx1DInq2IODnvgy', 2, 'tomas', 'tomas@tomas.com'),
(7, 'admin', '$2y$10$A0iFBMG2btlQwcLj0Ku8IuizZb6Ig2mYbCP8YW995r/dn7pSday86', 1, 'admin', 'admin@gmail.com'),
(8, 'admin2', '$2y$10$p6K.BtabX.FajXAqU28.xuv7DiTMiFV5IhT1iGGls4H5Ef8jGx70e', 2, 'admin2', 'admin2@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`CODCITA`),
  ADD KEY `CODP` (`CODP`),
  ADD KEY `CODM` (`CODM`);

--
-- Indices de la tabla `diagnosticos`
--
ALTER TABLE `diagnosticos`
  ADD PRIMARY KEY (`CODDIAG`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`CODM`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`CODP`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ROLE` (`ROLE`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `CODCITA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `diagnosticos`
--
ALTER TABLE `diagnosticos`
  MODIFY `CODDIAG` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `CODM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `CODP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`CODP`) REFERENCES `pacientes` (`CODP`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`CODM`) REFERENCES `medicos` (`CODM`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ROLE`) REFERENCES `roles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
