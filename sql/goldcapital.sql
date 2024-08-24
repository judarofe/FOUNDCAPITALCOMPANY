-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-08-2024 a las 16:20:44
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
(3, 'nequi'),
(4, 'daviplata'),
(5, 'bancolombia'),
(6, 'colpatria'),
(7, 'efectivo');

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
(17, 2, 4, '123'),
(18, 2, 6, 'fsdfsdfsfd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigoemail`
--

CREATE TABLE `codigoemail` (
  `id` int(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depositos`
--

CREATE TABLE `depositos` (
  `id_depositos` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL,
  `id_billetera` int(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int(255) NOT NULL,
  `archivo` text NOT NULL,
  `estado` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `depositos`
--

INSERT INTO `depositos` (`id_depositos`, `id_user`, `id_plan`, `id_billetera`, `fecha`, `cantidad`, `archivo`, `estado`) VALUES
(5, 2, 8, 17, '2024-05-17 16:26:13', 1000, '20240516214110_2.jpg', 3),
(6, 2, 9, 18, '2024-05-17 03:50:10', 2000, '20240516214237_2.jpg', 1),
(7, 2, 8, 18, '2024-05-17 03:47:44', 3000, '20240516214253_2.jpg', 0),
(8, 2, 9, 18, '2024-05-16 21:43:11', 4000, '20240516214311_2.jpg', 0),
(9, 2, 8, 18, '2024-05-16 21:43:28', 6000, '20240516214328_2.jpg', 0),
(10, 2, 8, 18, '2024-05-16 21:43:50', 7000, '20240516214350_2.jpg', 0),
(11, 2, 8, 18, '2024-05-16 21:44:20', 8000, '20240516214420_2.jpg', 0),
(12, 2, 8, 18, '2024-05-16 21:44:35', 9000, '20240516214435_2.jpg', 0),
(13, 2, 10, 17, '2024-05-16 21:45:35', 10000, '20240516214535_2.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id_plan` int(11) NOT NULL,
  `plan` varchar(30) NOT NULL,
  `items` varchar(500) DEFAULT NULL,
  `descripcion` varchar(2000) DEFAULT NULL,
  `porcentaje` int(11) NOT NULL DEFAULT 0,
  `fijo` int(11) NOT NULL DEFAULT 0,
  `tiempo` int(11) NOT NULL,
  `pagos` varchar(100) NOT NULL DEFAULT '30',
  `visibilidad` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_plan`, `plan`, `items`, `descripcion`, `porcentaje`, `fijo`, `tiempo`, `pagos`, `visibilidad`) VALUES
(8, 'PLAN COMERCIAL INICIAL', '0.60% de ROI durante 5 días.|Mínimo $50 - Máximo $3000.|Salida automatizada.|Taza de administración 8 usd*.|Bono de recomendación: 10%.|Spreads ajustados.|Ejecución comercial ultrarápida.|Alta protección y seguridad contra riesgos.', 'Nuestro plan comercial ha sido meticulosamente diseñado con el objetivo principal de impulsar el crecimiento de tu capital de inversión. Durante un período mínimo de tres meses, te ofrecemos la oportunidad de experimentar un rendimiento constante del 3% semanal sobre tu inversión. La flexibilidad es clave, y te permitimos retirar tus ganancias cada sexto día.<br />\\r\\n<br />\\r\\nUna vez que hayas realizado tu inversión, el proceso es ágil y eficiente. Tu dinero comenzará a generar ingresos dentro de las siguientes 24 horas, gracias a nuestro equipo de expertos dedicados a maximizar tus ganancias.<br />\\r\\n<br />\\r\\nCuando estés listo para disfrutar de tus beneficios, el proceso de retiro es sencillo y sin complicaciones. Todo lo que necesitas hacer es solicitar un retiro y, en cuestión de horas, tus ganancias llegarán a la billetera que nos hayas proporcionado.<br />\\r\\n<br />\\r\\nEn resumen, en nuestra plataforma, te ofrecemos un plan de inversión diseñado para impulsar tu capital con un sólido 3% de rentabilidad semanal, con la flexibilidad de retirar tus ganancias cada sexto día y la rapidez de procesamiento de retiros para que puedas disfrutar de tus beneficios de manera eficiente.<br />\\r\\n<br />\\r\\nAl efectuar tu primera suscripción, habrá un costo administrativo único de 8 USD. Sin embargo, a partir de ese momento, todos los procesos posteriores, incluyendo renovaciones, nuevos cargos, retiros y cualquier otro procedimiento dentro de nuestra compañía, serán totalmente gratuitos. Queremos asegurarnos de que aproveches al máximo tus inversiones sin incurrir en cargos adicionales. Tu éxito financiero es nuestra prioridad, y estamos aquí para brindarte un servicio transp', 2, 0, 30, '30', 1),
(9, 'PLAN COMERCIAL PREMIUM', '0.75% de ROI durante 8 días|Mínimo $3000 - Máximo $10000|Salida automatizada|Taza de administración 10 usd*|Bono de recomendación: 10%|Spreads ajustados|Ejecución comercial ultrarápida|Alta protección y seguridad contra riesgos.', 'Nuestro plan comercial premium ha sido meticulosamente diseñado con el objetivo principal de impulsar el crecimiento de tu capital de inversión. Durante un período mínimo de tres meses, te ofrecemos la oportunidad de experimentar un rendimiento constante del 6% cada 8 días sobre tu inversión. La flexibilidad es clave, y te permitimos retirar tus ganancias cada noveno día.<br />\\r\\n<br />\\r\\nUna vez que hayas realizado tu inversión, el proceso es ágil y eficiente. Tu dinero comenzará a generar ingresos dentro de las siguientes 24 horas, gracias a nuestro equipo de expertos dedicados a maximizar tus ganancias.<br />\\r\\n<br />\\r\\nCuando estés listo para disfrutar de tus beneficios, el proceso de retiro es sencillo y sin complicaciones. Todo lo que necesitas hacer es solicitar un retiro y, en cuestión de horas, tus ganancias llegarán a la billetera que nos hayas proporcionado.<br />\\r\\n<br />\\r\\nEn resumen, en nuestra plataforma, te ofrecemos un plan de inversión diseñado para impulsar tu capital con un sólido 6% de rentabilidad cada 8 días, con la flexibilidad de retirar tus ganancias cada noveno día y la rapidez de procesamiento de retiros para que puedas disfrutar de tus beneficios de manera eficiente.<br />\\r\\n<br />\\r\\nAl efectuar tu primera suscripción, habrá un costo administrativo único de 10 USD. Sin embargo, a partir de ese momento, todos los procesos posteriores, incluyendo renovaciones, nuevos cargos, retiros y cualquier otro procedimiento dentro de nuestra compañía, serán totalmente gratuitos. Queremos asegurarnos de que aproveches al máximo tus inversiones sin incurrir en cargos adicionales. Tu éxito financiero es nuestra prioridad, y estamos aquí para brindarte', 3, 0, 60, '30', 1),
(10, 'plan zorro', 'primero|segundo|tercero|cuarto|quinto|sexto|septimo|octavo', 'Lorem ipsum dolor sit amet consectetur adipiscing elit quam, curabitur consequat dignissim accumsan fringilla augue ad turpis, nullam lobortis quis neque pellentesque odio leo. Risus hendrerit tempor a himenaeos dui semper mi lacinia, laoreet tincidunt vehicula nec sagittis curae volutpat sollicitudin, mauris aenean cras in tellus euismod auctor. Potenti eros pellentesque phasellus laoreet quis lacus sem sodales, faucibus molestie volutpat ante cubilia sociis condimentum fames suspendisse, at feugiat integer fusce libero suscipit auctor.<br />\\r\\n<br />\\r\\nLaoreet nam suscipit mattis platea elementum cursus pulvinar iaculis lacinia, interdum magna felis fringilla duis mauris congue urna, lectus praesent lacus dui cum dictumst netus tempus. Sollicitudin ultricies euismod interdum duis justo non magna tellus montes nunc, sagittis rutrum fusce aenean quisque dictum rhoncus malesuada nulla sem vivamus, venenatis neque integer aliquet mi orci vestibulum vel sapien. Velit lobortis consequat ullamcorper taciti erat fringilla luctus purus, nunc penatibus ac non sem congue pulvinar egestas, sociis habitasse inceptos quis potenti vel elementum. Habitant luctus vestibulum nisi porta dapibus gravida nostra parturient aliquam, sem nunc urna mauris facilisi vehicula ut commodo, fringilla dictum feugiat ornare curabitur lacinia nam convallis.', 0, 500, 365, '30', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiros`
--

CREATE TABLE `retiros` (
  `id_retiros` int(100) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_depositos` int(100) NOT NULL,
  `id_billeteraUser` int(100) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(10) NOT NULL DEFAULT 0,
  `cantidad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `retiros`
--

INSERT INTO `retiros` (`id_retiros`, `id_user`, `id_depositos`, `id_billeteraUser`, `fecha`, `estado`, `cantidad`) VALUES
(15, 2, 5, 18, '2024-06-16', 0, NULL);

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
  `UserTipo` int(1) NOT NULL DEFAULT 2,
  `confirma` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `nombre`, `apellido`, `email`, `contrasena`, `username`, `cedula`, `UserTipo`, `confirma`) VALUES
(1, 'juan David', 'Rodriguez', 'ing.davidferrer@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$clhqakl6TUw0WEtrUDh3SA$AiSg5Ng7ObA2YuZhDdniZIezkSFoO/wOpOaHXre+K8s', 'ing.davidferrer', NULL, 1, 0),
(2, 'juan Manuel', 'Rodriguez', 'juanchorodriguez29@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$ZC5VYm0vM3hSWFJkamh1Vg$OYTPyg/AsUzxa+avy29W+qfSE4K5bETf2pNhk+Ec5Ww', 'juanchorodriguez29', NULL, 2, 1),
(3, 'Joaquin Alejandro', 'Rodriguez Tejeder', 'prueba@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$UU4yL1dHOFI4dHNwNk5obA$Y258NBlgmnJUSj8WzHWCy8AHPwJssqT3QgA6mv+8bKk', 'prueba', NULL, 2, 0),
(4, 'juan David', 'Rodriguez', 'prueba1@found.com', '$argon2i$v=19$m=65536,t=4,p=1$YXJjZlp4TFF5M0tCYm80Lw$85c3s+gwTBe27rU/ieMgz0Rb1wbjscEr4ND34qQ76WQ', 'prueba1', NULL, 2, 0),
(5, 'juan David', 'Rodriguez', 'prueba2@found.com', '$argon2i$v=19$m=65536,t=4,p=1$QVlROVZ3S3k5Nm84MlVFMw$CbM9GZa/8IkeYYFn8KpMe/IO6vnq0nZEsRomgpfzQB0', 'prueba2', NULL, 2, 0),
(6, 'Joquin', 'Rodriguez Tejedor', 'joaquin.rodriguez@pruebass.com', '$argon2i$v=19$m=65536,t=4,p=1$cEtnak5obnU1d0lSNmZKbw$dnQyTBI3HolOVbntdVQs8kJ2W3G8pSFKjfH+tp4L5sc', 'joaquin.rodriguez', NULL, 2, 0);

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
  MODIFY `id_billetera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `billeterauser`
--
ALTER TABLE `billeterauser`
  MODIFY `id_billeteraUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `codigoemail`
--
ALTER TABLE `codigoemail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `depositos`
--
ALTER TABLE `depositos`
  MODIFY `id_depositos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `id_retiros` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
