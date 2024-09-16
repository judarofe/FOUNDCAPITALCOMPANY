-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-09-2024 a las 22:56:04
-- Versión del servidor: 8.0.39-0ubuntu0.24.04.2
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `goldcapital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billetera`
--

CREATE TABLE `billetera` (
  `id_billetera` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billeterauser`
--

CREATE TABLE `billeterauser` (
  `id_billeteraUser` int NOT NULL,
  `id_user` int NOT NULL,
  `Id_billetera` int NOT NULL,
  `link` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigoemail`
--

CREATE TABLE `codigoemail` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `codigo` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depositos`
--

CREATE TABLE `depositos` (
  `id_depositos` int NOT NULL,
  `id_user` int NOT NULL,
  `id_plan` int NOT NULL,
  `id_billetera` int NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int NOT NULL,
  `archivo` text COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id_plan` int NOT NULL,
  `plan` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `items` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` varchar(2000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `porcentaje` int NOT NULL DEFAULT '0',
  `fijo` int NOT NULL DEFAULT '0',
  `tiempo` int NOT NULL,
  `pagos` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '30',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiros`
--

CREATE TABLE `retiros` (
  `id_retiros` int NOT NULL,
  `id_user` int NOT NULL,
  `id_depositos` int NOT NULL,
  `id_billeteraUser` int NOT NULL,
  `fecha` date NOT NULL,
  `estado` int NOT NULL DEFAULT '0',
  `cantidad` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cedula` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `UserTipo` int NOT NULL DEFAULT '2',
  `confirma` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `billetera`
--
ALTER TABLE `billetera`
  ADD PRIMARY KEY (`id_billetera`);

--
-- Indices de la tabla `billeterauser`
--
ALTER TABLE `billeterauser`
  ADD PRIMARY KEY (`id_billeteraUser`),
  ADD KEY `id_user` (`id_user`,`Id_billetera`),
  ADD KEY `Id_billetera` (`Id_billetera`);

--
-- Indices de la tabla `codigoemail`
--
ALTER TABLE `codigoemail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD PRIMARY KEY (`id_depositos`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_plan` (`id_plan`),
  ADD KEY `id_billetera` (`id_billetera`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id_plan`);

--
-- Indices de la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD PRIMARY KEY (`id_retiros`),
  ADD KEY `id_depositos` (`id_depositos`,`id_billeteraUser`),
  ADD KEY `id_billeteraUser` (`id_billeteraUser`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `billetera`
--
ALTER TABLE `billetera`
  MODIFY `id_billetera` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `billeterauser`
--
ALTER TABLE `billeterauser`
  MODIFY `id_billeteraUser` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigoemail`
--
ALTER TABLE `codigoemail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `depositos`
--
ALTER TABLE `depositos`
  MODIFY `id_depositos` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id_plan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `id_retiros` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `billeterauser`
--
ALTER TABLE `billeterauser`
  ADD CONSTRAINT `billeterauser_ibfk_1` FOREIGN KEY (`Id_billetera`) REFERENCES `billetera` (`id_billetera`),
  ADD CONSTRAINT `billeterauser_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `codigoemail`
--
ALTER TABLE `codigoemail`
  ADD CONSTRAINT `codigoemail_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD CONSTRAINT `depositos_ibfk_1` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id_plan`),
  ADD CONSTRAINT `depositos_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `depositos_ibfk_3` FOREIGN KEY (`id_billetera`) REFERENCES `billeterauser` (`id_billeteraUser`);

--
-- Filtros para la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD CONSTRAINT `retiros_ibfk_1` FOREIGN KEY (`id_billeteraUser`) REFERENCES `billeterauser` (`id_billeteraUser`),
  ADD CONSTRAINT `retiros_ibfk_2` FOREIGN KEY (`id_depositos`) REFERENCES `depositos` (`id_depositos`),
  ADD CONSTRAINT `retiros_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
