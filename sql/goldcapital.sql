-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2024 a las 05:21:57
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
-- Estructura de tabla para la tabla `beneficiosliderazgo`
--

CREATE TABLE `beneficiosliderazgo` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  `rango` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiosplan`
--

CREATE TABLE `beneficiosplan` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiosreferidos`
--

CREATE TABLE `beneficiosreferidos` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billetera`
--

CREATE TABLE `billetera` (
  `id_billetera` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `billetera`
--

INSERT INTO `billetera` (`id_billetera`, `nombre`) VALUES
(1, ' Wallet 1'),
(2, 'billetera prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billeterauser`
--

CREATE TABLE `billeterauser` (
  `id_billeteraUser` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `Id_billetera` int(11) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `billeterauser`
--

INSERT INTO `billeterauser` (`id_billeteraUser`, `id_user`, `Id_billetera`, `link`) VALUES
(8, 2, 1, 'https://www.youtube.com/'),
(9, 7, 1, 'dasdsadsadasd'),
(10, 12, 2, 'fdfdsfdfdsfdsfs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonored`
--

CREATE TABLE `bonored` (
  `id` int(11) NOT NULL,
  `nivel` float NOT NULL,
  `porcentaje` float NOT NULL,
  `patrocinio` double NOT NULL,
  `inversion` double NOT NULL,
  `rango` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bonored`
--

INSERT INTO `bonored` (`id`, `nivel`, `porcentaje`, `patrocinio`, `inversion`, `rango`) VALUES
(1, 1, 10, 0, 500, NULL),
(2, 2, 3, 3, 1000, 1),
(3, 3, 2, 3, 1000, 1),
(4, 4, 1, 3, 2000, 2),
(5, 5, 1, 3, 2000, 2),
(6, 6, 1, 3, 3000, 3),
(7, 7, 1, 3, 3000, 3),
(8, 8, 1, 3, 5000, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigoemail`
--

CREATE TABLE `codigoemail` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `codigo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depositos`
--

CREATE TABLE `depositos` (
  `id_depositos` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL,
  `id_billetera` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `fechafinal` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `archivo` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuenciatransaccion`
--

CREATE TABLE `frecuenciatransaccion` (
  `id` int(11) NOT NULL,
  `frecuencia` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `frecuenciatransaccion`
--

INSERT INTO `frecuenciatransaccion` (`id`, `frecuencia`) VALUES
(1, 'Dia'),
(2, 'Semana'),
(3, 'Mes'),
(4, 'Año');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liderazgo`
--

CREATE TABLE `liderazgo` (
  `id` int(11) NOT NULL,
  `rango` varchar(100) NOT NULL,
  `inversionpersonal` int(11) NOT NULL,
  `volumendered` int(11) DEFAULT NULL,
  `bono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `liderazgo`
--

INSERT INTO `liderazgo` (`id`, `rango`, `inversionpersonal`, `volumendered`, `bono`) VALUES
(1, 'inicio', 500, NULL, NULL),
(2, 'Plata', 1000, 3000, 50),
(3, 'Bronce', 1000, 9000, 150),
(4, 'Oro', 1000, 18000, 300),
(5, 'Platino', 2000, 36000, 1000),
(6, 'Rubi', 2000, 72000, 2000),
(7, 'Esmeralda', 3000, 145000, 4000),
(8, 'Diamante', 5000, 280000, 10000),
(9, 'Diamante Azul', 8000, 550000, 20000),
(10, 'Diamante Negro', 8000, 1000000, 30000),
(11, 'Corona', 10000, 2000000, 50000),
(12, 'Corona Azul', 10000, 5000000, 78000),
(13, 'Doble Corona', 20000, 10000000, 100000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id_plan` int(11) NOT NULL,
  `plan` varchar(30) NOT NULL,
  `items` varchar(500) DEFAULT NULL,
  `descripcion` varchar(2000) DEFAULT NULL,
  `porcentajeMin` int(11) NOT NULL DEFAULT 0,
  `porcentajeMax` int(11) NOT NULL DEFAULT 0,
  `fijo` int(11) NOT NULL DEFAULT 0,
  `id_interes` int(11) DEFAULT NULL,
  `id_Retiros` int(11) DEFAULT NULL,
  `pagos` varchar(100) DEFAULT NULL,
  `tiempo` varchar(200) NOT NULL,
  `visibilidad` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_plan`, `plan`, `items`, `descripcion`, `porcentajeMin`, `porcentajeMax`, `fijo`, `id_interes`, `id_Retiros`, `pagos`, `tiempo`, `visibilidad`) VALUES
(12, 'prueba 1', '1|2|3|4|5|6|7|8', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget', 9, 12, 0, 3, 2, '200,500,1000', '4,1', 1),
(13, 'prueba 2', '1|2|3|4|5|6|7|8', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget', 0, 0, 2, 3, 4, '500,1000,1500', '3,6', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentajes`
--

CREATE TABLE `porcentajes` (
  `id` int(11) NOT NULL,
  `planes` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(17, 2, 12),
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
-- Estructura de tabla para la tabla `retiros`
--

CREATE TABLE `retiros` (
  `id_retiros` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_depositos` int(11) NOT NULL,
  `id_billeteraUser` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `cantidad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'DJEgnJ5cp3ElLJEipt==', 'EJkcqTHtEz91ozD=', 'nJ5aYzEuqzyxMzIlpzIlDTqgLJyfYzAioD==', '$argon2i$v=19$m=65536,t=4,p=1$aUk4OVlqZzdhVXlrYkNuag$0apUP+9DJQIp6Ese8LgV6aP2+lcU04PKKjVmBKICcTU', 'Elite.Found', 'ZGN0BGLlZGV1ZN==', 1, 1),
(2, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuZxOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$a1c4aU1VVG9nYk1NTDVndg$+4qVlDNTwmSzuGiKS0OuXF/A99aJ+REU3fmMPrWDxt0', 'prueba', 'ZD==', 2, 1),
(3, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuZ0Ozo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$OFNiM0dUZnVlQU9HeTNpVQ$mKc51T+L/T13AcjtR+USTkBjpTI/dpAu+cWKqVjIiXU', 'niveluno', 'Zj==', 2, 1),
(4, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuAROzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$OS8zVnQ1NGZqL0hYQ2l5QQ$8vDAFcuVfnHCpCBrDzF458oELgqLIpri+dFAgY1u+gs', 'niveldos', 'Zt==', 2, 1),
(5, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuAHOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$UVVaZXlMdmlxNUx1TjVXUA$JJAXxurJ0/rGl/KFpSX2z52gV9Li6Ll5wzxbcqfTskc', 'niveltres', 'AD==', 2, 1),
(6, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuAxOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$aHNFYVNSdTRTVUFNZzFJYg$oHQfrZQbDWEm3h4H1c4N/4IwBV2ePjV/7VSJDwmhsAg', 'nivelcuatro', 'At==', 2, 1),
(7, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuA0Ozo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$dkJMb2JhRTB2UTd2dDhnZA$ftxU+60cRWfGDUdZDoGbsv4o+F/Z9rujHG+OGYI2MgE', 'nivelcinco', 'Aj==', 2, 1),
(8, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuBROzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$T2RxQVowTVBjS1Exa3ByTg$vHDZhgeeTD5kdmI/Uu3Yjpnnz4iQZFUz+E1DRHzO7hg', 'nivelseis', 'BN==', 2, 1),
(9, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuBHOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$TXhINTdtVVJhN2FuS2dvaA$n/6bNVecizKud6rNTDCKsaudXY5Vxl/426xAMzGz60k', 'nivelsiete', 'BD==', 2, 1),
(10, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuZGONMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$Zy96VWlUc2R0TlBWZkdHSw$5q0yICMBSMedYak7qCX01lQ7D96fAmKmLC+I8YdxhYo', 'nivelocho', 'ZGN=', 2, 1),
(11, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuZGSNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$RnN3Z1N0VzlkY3FKam1oOQ$MhH4PHw8PIrOiZyxSESuZChS27trMtgdPWYbskNdP2Q', 'nivelnueve', 'ZGR=', 2, 1),
(12, 'pUW1MJWu', 'MJkcqTHtMz91ozD=', 'pUW1MJWuZmSNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$U0Q0OENzbmdoSFNCQ1VsZQ$uCBWySvJgDeRWD2KPCBClbPW7+zLXpPqmlRr5Hf4zWc', 'nivelunob', 'ZmR=', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beneficiosliderazgo`
--
ALTER TABLE `beneficiosliderazgo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `rango` (`rango`);

--
-- Indices de la tabla `beneficiosplan`
--
ALTER TABLE `beneficiosplan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `beneficiosreferidos`
--
ALTER TABLE `beneficiosreferidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

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
-- Indices de la tabla `bonored`
--
ALTER TABLE `bonored`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rango` (`rango`);

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
-- Indices de la tabla `frecuenciatransaccion`
--
ALTER TABLE `frecuenciatransaccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `liderazgo`
--
ALTER TABLE `liderazgo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id_plan`),
  ADD KEY `id_frecuenciaRetiros` (`id_Retiros`),
  ADD KEY `id_interes` (`id_interes`);

--
-- Indices de la tabla `porcentajes`
--
ALTER TABLE `porcentajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planes` (`planes`);

--
-- Indices de la tabla `referidos`
--
ALTER TABLE `referidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `padre` (`padre`,`hijo`),
  ADD KEY `hijo` (`hijo`);

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
-- AUTO_INCREMENT de la tabla `beneficiosliderazgo`
--
ALTER TABLE `beneficiosliderazgo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `beneficiosplan`
--
ALTER TABLE `beneficiosplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `beneficiosreferidos`
--
ALTER TABLE `beneficiosreferidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `billetera`
--
ALTER TABLE `billetera`
  MODIFY `id_billetera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `billeterauser`
--
ALTER TABLE `billeterauser`
  MODIFY `id_billeteraUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `bonored`
--
ALTER TABLE `bonored`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `codigoemail`
--
ALTER TABLE `codigoemail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `depositos`
--
ALTER TABLE `depositos`
  MODIFY `id_depositos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `frecuenciatransaccion`
--
ALTER TABLE `frecuenciatransaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `liderazgo`
--
ALTER TABLE `liderazgo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `porcentajes`
--
ALTER TABLE `porcentajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `referidos`
--
ALTER TABLE `referidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `id_retiros` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beneficiosliderazgo`
--
ALTER TABLE `beneficiosliderazgo`
  ADD CONSTRAINT `beneficiosliderazgo_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `beneficiosliderazgo_ibfk_2` FOREIGN KEY (`rango`) REFERENCES `liderazgo` (`id`);

--
-- Filtros para la tabla `beneficiosplan`
--
ALTER TABLE `beneficiosplan`
  ADD CONSTRAINT `beneficiosplan_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `beneficiosreferidos`
--
ALTER TABLE `beneficiosreferidos`
  ADD CONSTRAINT `beneficiosreferidos_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `billeterauser`
--
ALTER TABLE `billeterauser`
  ADD CONSTRAINT `billeterauser_ibfk_1` FOREIGN KEY (`Id_billetera`) REFERENCES `billetera` (`id_billetera`),
  ADD CONSTRAINT `billeterauser_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `bonored`
--
ALTER TABLE `bonored`
  ADD CONSTRAINT `bonored_ibfk_1` FOREIGN KEY (`rango`) REFERENCES `liderazgo` (`id`);

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
-- Filtros para la tabla `planes`
--
ALTER TABLE `planes`
  ADD CONSTRAINT `planes_ibfk_1` FOREIGN KEY (`id_Retiros`) REFERENCES `frecuenciatransaccion` (`id`),
  ADD CONSTRAINT `planes_ibfk_2` FOREIGN KEY (`id_interes`) REFERENCES `frecuenciatransaccion` (`id`);

--
-- Filtros para la tabla `porcentajes`
--
ALTER TABLE `porcentajes`
  ADD CONSTRAINT `porcentajes_ibfk_1` FOREIGN KEY (`planes`) REFERENCES `planes` (`id_plan`);

--
-- Filtros para la tabla `referidos`
--
ALTER TABLE `referidos`
  ADD CONSTRAINT `referidos_ibfk_1` FOREIGN KEY (`padre`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `referidos_ibfk_2` FOREIGN KEY (`hijo`) REFERENCES `user` (`id_user`);

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
