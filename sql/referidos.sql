-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2024 a las 16:55:45
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
-- Base de datos: `goldcapital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referidos`
--

CREATE TABLE `referidos` (
  `id` int(11) NOT NULL,
  `padre` int(11) NOT NULL,
  `hijo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `referidos`
--

INSERT INTO `referidos` (`id`, `padre`, `hijo`) VALUES
(7, 1, 2),
(8, 2, 3),
(9, 3, 4),
(10, 4, 5),
(11, 5, 6),
(12, 6, 7),
(13, 7, 8),
(14, 8, 9),
(15, 9, 10),
(16, 10, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `cedula` varchar(100) DEFAULT NULL,
  `UserTipo` int(11) NOT NULL DEFAULT 2,
  `confirma` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `nombre`, `apellido`, `email`, `contrasena`, `username`, `cedula`, `UserTipo`, `confirma`) VALUES
(1, 'DJEgnJ5cp3ElLJEipt==', 'EJkcqTHtEz91ozD=', 'LJEgnJ5cp3ElLJEipxOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$aUk4OVlqZzdhVXlrYkNuag$0apUP+9DJQIp6Ese8LgV6aP2+lcU04PKKjVmBKICcTU', 'Elite.Found', 'ZGN0BGLlZGV1ZN==', 1, 1),
(2, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuZxOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$a1c4aU1VVG9nYk1NTDVndg$+4qVlDNTwmSzuGiKS0OuXF/A99aJ+REU3fmMPrWDxt0', 'prueba', 'ZD==', 2, 1),
(3, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuZ0Ozo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$OFNiM0dUZnVlQU9HeTNpVQ$mKc51T+L/T13AcjtR+USTkBjpTI/dpAu+cWKqVjIiXU', 'niveluno', 'Zj==', 2, 1),
(4, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuAROzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$OS8zVnQ1NGZqL0hYQ2l5QQ$8vDAFcuVfnHCpCBrDzF458oELgqLIpri+dFAgY1u+gs', 'niveldos', 'Zt==', 2, 1),
(5, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuAHOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$UVVaZXlMdmlxNUx1TjVXUA$JJAXxurJ0/rGl/KFpSX2z52gV9Li6Ll5wzxbcqfTskc', 'niveltres', 'AD==', 2, 1),
(6, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuAxOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$aHNFYVNSdTRTVUFNZzFJYg$oHQfrZQbDWEm3h4H1c4N/4IwBV2ePjV/7VSJDwmhsAg', 'nivelcuatro', 'At==', 2, 1),
(7, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuA0Ozo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$dkJMb2JhRTB2UTd2dDhnZA$ftxU+60cRWfGDUdZDoGbsv4o+F/Z9rujHG+OGYI2MgE', 'nivelcinco', 'Aj==', 2, 1),
(8, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuBROzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$T2RxQVowTVBjS1Exa3ByTg$vHDZhgeeTD5kdmI/Uu3Yjpnnz4iQZFUz+E1DRHzO7hg', 'nivelseis', 'BN==', 2, 1),
(9, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuBHOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$TXhINTdtVVJhN2FuS2dvaA$n/6bNVecizKud6rNTDCKsaudXY5Vxl/426xAMzGz60k', 'nivelsiete', 'BD==', 2, 1),
(10, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuZGONMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$Zy96VWlUc2R0TlBWZkdHSw$5q0yICMBSMedYak7qCX01lQ7D96fAmKmLC+I8YdxhYo', 'nivelocho', 'ZGN=', 2, 1),
(11, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuZGSNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$RnN3Z1N0VzlkY3FKam1oOQ$MhH4PHw8PIrOiZyxSESuZChS27trMtgdPWYbskNdP2Q', 'nivelnueve', 'ZGR=', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `referidos`
--
ALTER TABLE `referidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `padre` (`padre`,`hijo`),
  ADD KEY `hijo` (`hijo`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `referidos`
--
ALTER TABLE `referidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `referidos`
--
ALTER TABLE `referidos`
  ADD CONSTRAINT `referidos_ibfk_1` FOREIGN KEY (`padre`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `referidos_ibfk_2` FOREIGN KEY (`hijo`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
