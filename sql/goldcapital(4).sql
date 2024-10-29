-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-10-2024 a las 14:11:52
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
-- Estructura de tabla para la tabla `beneficiosliderazgo`
--

CREATE TABLE `beneficiosliderazgo` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  `rango` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiosplan`
--

CREATE TABLE `beneficiosplan` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  `id_deposito` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiosreferidos`
--

CREATE TABLE `beneficiosreferidos` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  `referido` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billetera`
--

CREATE TABLE `billetera` (
  `id_billetera` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
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
  `id_billeteraUser` int NOT NULL,
  `id_user` int NOT NULL,
  `Id_billetera` int NOT NULL,
  `link` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `billeterauser`
--

INSERT INTO `billeterauser` (`id_billeteraUser`, `id_user`, `Id_billetera`, `link`) VALUES
(1, 2, 2, 'Billetera 2'),
(2, 3, 2, 'Billetera 3'),
(3, 4, 2, 'Billetera 4'),
(4, 5, 2, 'Billetera 5'),
(5, 6, 2, 'Billetera 6'),
(6, 7, 2, 'Billetera 7'),
(7, 8, 2, 'Billetera 8'),
(8, 9, 2, 'Billetera 9'),
(9, 10, 2, 'Billetera 10'),
(10, 11, 2, 'Billetera 11'),
(11, 12, 2, 'Billetera 12'),
(12, 13, 2, 'Billetera 13'),
(13, 14, 2, 'Billetera 14'),
(14, 15, 2, 'Billetera 15'),
(15, 16, 2, 'Billetera 16'),
(16, 17, 2, 'Billetera 17'),
(17, 18, 2, 'Billetera 18'),
(18, 19, 2, 'Billetera 19'),
(19, 20, 2, 'Billetera 20'),
(20, 21, 2, 'Billetera 21'),
(21, 22, 2, 'Billetera 22'),
(22, 23, 2, 'Billetera 23'),
(23, 24, 2, 'Billetera 24'),
(24, 25, 2, 'Billetera 25'),
(25, 26, 2, 'Billetera 26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonored`
--

CREATE TABLE `bonored` (
  `id` int NOT NULL,
  `nivel` float NOT NULL,
  `porcentaje` float NOT NULL,
  `patrocinio` double NOT NULL,
  `inversion` double NOT NULL,
  `rango` int DEFAULT NULL
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
  `fechafinal` date DEFAULT NULL,
  `cantidad` int NOT NULL,
  `archivo` text COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `depositos`
--

INSERT INTO `depositos` (`id_depositos`, `id_user`, `id_plan`, `id_billetera`, `fecha`, `fechafinal`, `cantidad`, `archivo`, `estado`) VALUES
(1, 2, 2, 1, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:2 N1 1', 0),
(2, 3, 2, 2, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:3 N1 2', 0),
(3, 4, 2, 3, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:4 N1 3', 0),
(4, 5, 2, 4, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:5 N1 4', 0),
(5, 2, 2, 1, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:2 N2 5', 0),
(6, 6, 2, 5, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:6 N2 6', 0),
(7, 7, 2, 6, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:7 N2 7', 0),
(8, 8, 2, 7, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:8 N2 8', 0),
(9, 9, 2, 8, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:9 N3 9', 0),
(10, 10, 2, 9, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:10 N3 10', 0),
(11, 11, 2, 10, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:11 N3 11', 0),
(12, 2, 2, 1, '2024-10-23 00:00:00', '2025-10-23', 1000, 'Id:2 N4 12', 0),
(13, 12, 2, 11, '2024-10-23 00:00:00', '2025-10-23', 1000, 'Id:12 N4 16', 0),
(14, 3, 2, 2, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:3 N4 13', 0),
(15, 4, 2, 3, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:4 N4 14', 0),
(16, 5, 2, 4, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:5 N4 15', 0),
(17, 13, 2, 12, '2024-10-23 00:00:00', '2025-10-23', 1000, 'Id:13 N4 17', 0),
(18, 14, 2, 13, '2024-10-23 00:00:00', '2025-10-23', 1000, 'Id:14 N4 18', 0),
(19, 15, 2, 14, '2024-10-23 00:00:00', '2025-10-23', 1000, 'Id:15 N5 19', 0),
(20, 16, 2, 15, '2024-10-23 00:00:00', '2025-10-23', 1000, 'Id:16 N5 20', 0),
(21, 17, 2, 16, '2024-10-23 00:00:00', '2025-10-23', 1000, 'Id:17 N5 21', 0),
(22, 2, 2, 1, '2024-10-23 00:00:00', '2025-10-23', 2500, 'Id:2 N6 22', 0),
(23, 18, 2, 17, '2024-10-23 00:00:00', '2025-10-23', 5000, 'Id:18 N6 23', 0),
(24, 19, 2, 18, '2024-10-23 00:00:00', '2025-10-23', 5000, 'Id:19 N6 24', 0),
(25, 20, 2, 19, '2024-10-23 00:00:00', '2025-10-23', 5000, 'Id:20 N6 25', 0),
(26, 21, 2, 20, '2024-10-23 00:00:00', '2025-10-23', 5000, 'Id:21 N7 26', 0),
(27, 22, 2, 21, '2024-10-23 00:00:00', '2025-10-23', 5000, 'Id:22 N7 27', 0),
(28, 23, 2, 22, '2024-10-23 00:00:00', '2025-10-23', 5000, 'Id:23 N7 28', 0),
(29, 2, 2, 1, '2024-10-23 00:00:00', '2025-10-23', 500, 'Id:2 N8 29', 0),
(30, 24, 2, 23, '2024-10-23 00:00:00', '2025-10-23', 4000, 'Id:24 N8 30', 0),
(31, 25, 2, 25, '2024-10-23 00:00:00', '2025-10-23', 4000, 'Id:25 N8 31', 0),
(32, 26, 2, 25, '2024-10-23 00:00:00', '2025-10-23', 4000, 'Id:26 N8 32', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuenciatransaccion`
--

CREATE TABLE `frecuenciatransaccion` (
  `id` int NOT NULL,
  `frecuencia` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '0'
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
  `id` int NOT NULL,
  `rango` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `inversionpersonal` int NOT NULL,
  `volumendered` int DEFAULT NULL,
  `bono` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `liderazgo`
--

INSERT INTO `liderazgo` (`id`, `rango`, `inversionpersonal`, `volumendered`, `bono`) VALUES
(1, 'inicio', 500, 0, 0),
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
  `id_plan` int NOT NULL,
  `plan` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `items` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` varchar(2000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `porcentajeMin` int NOT NULL DEFAULT '0',
  `porcentajeMax` int NOT NULL DEFAULT '0',
  `fijo` int NOT NULL DEFAULT '0',
  `id_interes` int DEFAULT NULL,
  `id_Retiros` int DEFAULT NULL,
  `pagos` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tiempo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_plan`, `plan`, `items`, `descripcion`, `porcentajeMin`, `porcentajeMax`, `fijo`, `id_interes`, `id_Retiros`, `pagos`, `tiempo`, `visibilidad`) VALUES
(1, 'LICENCIA DE RENTA SEGURA', 'Invierte de bajo riesgo|Operaciones de lunes a viernes|Retira tus ganancias semanalmente|Invierte desde $50 USD y un máximo de $500|Duración de 12 meses|Retiro del capital al finalizar|Rentabilidad del 2% mensual|Sin bonos de red y liderazgo', 'Para aquellos que buscan aumentar su capital de manera segura, nuestro servicio de inversión ofrece una opción de inversión accesible y de bajo riesgo. Con operaciones activas de lunes a viernes, gestionamos las inversiones de manera efectiva, asegurándonos de que su dinero funcione durante los días hábiles. Ofrecemos la opción de retiros semanales, lo que le permite acceder fácilmente a sus ganancias y ajustarlas a sus necesidades financieras.<br />\\r\\n<br />\\r\\nLas inversiones pueden comenzar desde solo $50 y llegar hasta $500, lo que abre las puertas tanto a inversores novatos como a inversores con experiencia. Tu capital aumentará con una rentabilidad fija del 2% mensual durante el período de inversión de doce meses. Al finalizar este plazo, su capital estará disponible para ser retirado.<br />\\r\\n<br />\\r\\nNos enfocamos en un modelo de inversión claro, transparente y fácil de entender para garantizar que los beneficios estén directamente relacionados con el rendimiento de nuestro portafolio. Nuestro método elimina la complejidad de esquemas como estructuras de liderazgo o bonos de red, lo que le permite invertir sin intermediarios ni comisiones ocultas. De esta manera, te aseguras de que tu dinero aumente únicamente en función de las decisiones y estrategias de inversión que hemos implementado.', 0, 0, 2, 3, 2, '50,100,250,500', '4,1', 1),
(2, 'LICENCIA DE RENTA FLEXIBLE', 'Operaciones de lunes a viernes|Retira tus ganancias semanalmente|Invierte desde $500 USD y un máximo de $50.000|Duración de 12 meses|Retiro del capital al finalizar|Rentabilidad del 2% al 5% mensual|Con bonos de red|Con bonos de liderazgo', 'Los rangos de inversión han evolucionado significativamente, ahora abarcando desde $500 hasta $50,000, lo que amplía considerablemente las oportunidades para una mayor variedad de inversores en comparación con el límite anterior de $5,000. Este cambio permite a más personas participar y diversificar su capital. Además, la estructura de rentabilidad ha sido optimizada, pasando de comisiones por niveles (del 10% al 1%) a un atractivo rango del 2% al 5% mensual, proporcionando rendimientos más consistentes y claros.<br />\\r\\n<br />\\r\\nEl nuevo modelo de inversión opera de lunes a viernes, con la ventaja añadida de permitir retiros semanales, lo que ofrece mayor liquidez y flexibilidad para los inversores. El periodo de inversión está claramente definido en 12 meses, proporcionando un horizonte temporal sólido y planificado, con la opción de retirar el capital completo al final del ciclo o reinvertirlo para continuar obteniendo beneficios.<br />\\r\\n<br />\\r\\nLos bonos de liderazgo y de red se mantienen como piezas clave del sistema, pero ahora están mejor integrados con el rendimiento general de la inversión, alineando los incentivos con el crecimiento sostenido. Aunque no se detallan rangos específicos en este formato, el sistema sigue premiando el liderazgo, lo que permite a los inversores más comprometidos maximizar sus recompensas.<br />\\r\\n<br />\\r\\nUn valor añadido de este nuevo esquema es el enfoque en la gestión profesional y la supervisión constante del mercado, un elemento que no figuraba en el modelo anterior. Esto asegura un seguimiento activo y experto de las inversiones, brindando una capa adicional de seguridad y confianza para los participantes.', 2, 5, 0, 3, 2, '500,1000,2500,5000,10000,15000,25000,50000', '4,1', 1),
(3, 'LICENCIA DE RENTA VARIABLE', 'Operaciones de lunes a viernes|Retira tus ganancias semanalmente|Invierte desde $500 USD y un máximo de $50.000|Duración de 12 meses|Retiro del capital al finalizar|Rentabilidad del 6% al 12% mensual|Con bonos de red|Con bonos de liderazgo', 'Los rangos de inversión han evolucionado significativamente, ahora abarcando desde $500 hasta $50,000, lo que amplía considerablemente las oportunidades para una mayor variedad de inversores en comparación con el límite anterior de $5,000. Este cambio permite a más personas participar y diversificar su capital. Además, la estructura de rentabilidad ha sido optimizada, pasando de comisiones por niveles (del 10% al 1%) a un atractivo rango del 6% al 12% mensual, proporcionando rendimientos más consistentes y claros.<br />\\r\\n<br />\\r\\nEl nuevo modelo de inversión opera de lunes a viernes, con la ventaja añadida de permitir retiros semanales, lo que ofrece mayor liquidez y flexibilidad para los inversores. El periodo de inversión está claramente definido en 12 meses, proporcionando un horizonte temporal sólido y planificado, con la opción de retirar el capital completo al final del ciclo o reinvertirlo para continuar obteniendo beneficios.<br />\\r\\n<br />\\r\\nLos bonos de liderazgo y de red se mantienen como piezas clave del sistema, pero ahora están mejor integrados con el rendimiento general de la inversión, alineando los incentivos con el crecimiento sostenido. Aunque no se detallan rangos específicos en este formato, el sistema sigue premiando el liderazgo, lo que permite a los inversores más comprometidos maximizar sus recompensas.<br />\\r\\n<br />\\r\\nUn valor añadido de este nuevo esquema es el enfoque en la gestión profesional y la supervisión constante del mercado, un elemento que no figuraba en el modelo anterior. Esto asegura un seguimiento activo y experto de las inversiones, brindando una capa adicional de seguridad y confianza para los participantes.', 6, 12, 0, 3, 4, '500,1000,2500,5000,10000,15000,25000,50000', '4,1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentajes`
--

CREATE TABLE `porcentajes` (
  `id` int NOT NULL,
  `planes` int NOT NULL,
  `porcentaje` int NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referidos`
--

CREATE TABLE `referidos` (
  `id` int NOT NULL,
  `padre` int NOT NULL,
  `hijo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `referidos`
--

INSERT INTO `referidos` (`id`, `padre`, `hijo`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 2, 4),
(4, 2, 5),
(5, 3, 6),
(6, 4, 7),
(7, 5, 8),
(8, 6, 9),
(9, 7, 10),
(10, 8, 11),
(11, 9, 12),
(12, 10, 13),
(13, 11, 14),
(14, 12, 15),
(15, 13, 16),
(16, 14, 17),
(17, 15, 18),
(18, 16, 19),
(19, 17, 20),
(20, 18, 21),
(21, 19, 22),
(22, 20, 23),
(23, 21, 24),
(24, 22, 25),
(25, 23, 26);

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
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `nombre`, `apellido`, `email`, `contrasena`, `username`, `cedula`, `UserTipo`, `confirma`) VALUES
(1, 'DJEgnJ4=', 'EJkcqTHtEz91ozD=', 'nJ5aYzEuqzyxMzIlpzIlDTqgLJyfYzAioD==', '$argon2i$v=19$m=65536,t=4,p=1$T3RGLkllVnBNRzFaeU1pdg$iumwQz1XIKilBmqWxo7ccCTTmGhhh7PXQsixTQrcDX8', 'Elite.Found', 'ZGN0BGLlZGV1ZN==', 1, 1),
(2, 'Gzy2MJj=', 'D2Iloj==', 'pUW1MJWuZxOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelCero', 'Zt==', 2, 1),
(3, 'Gzy2MJj=', 'IJ5iVRR=', 'pUW1MJWuZ0Ozo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelUnoA', 'Zt==', 2, 1),
(4, 'Gzy2MJj=', 'IJ5iVRV=', 'pUW1MJWuAROzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelUnoB', 'Zt==', 2, 1),
(5, 'Gzy2MJj=', 'IJ5iVRZ=', 'pUW1MJWuAHOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelUnoC', 'Zt==', 2, 1),
(6, 'Gzy2MJj=', 'ET9mVRR=', 'pUW1MJWuAxOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelDosA', 'Zt==', 2, 1),
(7, 'Gzy2MJj=', 'ET9mVRV=', 'pUW1MJWuA0Ozo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelDosB', 'Zt==', 2, 1),
(8, 'Gzy2MJj=', 'ET9mVRZ=', 'pUW1MJWuBROzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelDosC', 'Zt==', 2, 1),
(9, 'Gzy2MJj=', 'IUWyplOO', 'pUW1MJWuBHOzo3IhMP5wo20=', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelTresA', 'Zt==', 2, 1),
(10, 'Gzy2MJj=', 'IUWyplOP', 'pUW1MJWuZGONMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelTresB', 'Zt==', 2, 1),
(11, 'Gzy2MJj=', 'IUWyplOQ', 'pUW1MJWuZGSNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelTresC', 'Zt==', 2, 1),
(12, 'Gzy2MJj=', 'D3IuqUWiVRR=', 'pUW1MJWuZGWNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelCuatroA', 'Zt==', 2, 1),
(13, 'Gzy2MJj=', 'D3IuqUWiVRV=', 'pUW1MJWuZGANMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelCuatroB', 'Zt==', 2, 1),
(14, 'Gzy2MJj=', 'D3IuqUWiVRZ=', 'pUW1MJWuZGENMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelCuatroC', 'Zt==', 2, 1),
(15, 'Gzy2MJj=', 'D2yhL28tDD==', 'pUW1MJWuZGINMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelCincoA', 'Zt==', 2, 1),
(16, 'Gzy2MJj=', 'D2yhL28tDt==', 'pUW1MJWuZGMNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelCincoB', 'Zt==', 2, 1),
(17, 'Gzy2MJj=', 'D2yhL28tDj==', 'pUW1MJWuZGqNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelCincoC', 'Zt==', 2, 1),
(18, 'Gzy2MJj=', 'H2IcplOO', 'pUW1MJWuZGuNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelSeisA', 'Zt==', 2, 1),
(19, 'Gzy2MJj=', 'H2IcplOP', 'pUW1MJWuZGyNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelSeisB', 'Zt==', 2, 1),
(20, 'Gzy2MJj=', 'H2IcplOQ', 'pUW1MJWuZwONMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelSeisC', 'Zt==', 2, 1),
(21, 'Gzy2MJj=', 'H2yyqTHtDD==', 'pUW1MJWuZwSNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelSieteA', 'Zt==', 2, 1),
(22, 'Gzy2MJj=', 'H2yyqTHtDt==', 'pUW1MJWuZwWNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelSieteB', 'Zt==', 2, 1),
(23, 'Gzy2MJj=', 'H2yyqTHtDj==', 'pUW1MJWuZwANMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelSieteC', 'Zt==', 2, 1),
(24, 'Gzy2MJj=', 'G2AbolOO', 'pUW1MJWuZwENMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelOchoA', 'Zt==', 2, 1),
(25, 'Gzy2MJj=', 'G2AbolOP', 'pUW1MJWuZwINMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelOchoB', 'Zt==', 2, 1),
(26, 'Gzy2MJj=', 'G2AbolOQ', 'pUW1MJWuZwMNMz91ozDhL29g', '$argon2i$v=19$m=65536,t=4,p=1$b2k4TFBhelVPdU53OThULw$+A6APaExJymihbw/oPScuGCHTIbtAWT5cFyVG0btMEU', 'NivelOchoC', 'Zt==', 2, 1);

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
  ADD KEY `user` (`user`),
  ADD KEY `id_deposito` (`id_deposito`);

--
-- Indices de la tabla `beneficiosreferidos`
--
ALTER TABLE `beneficiosreferidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `referido` (`referido`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `beneficiosplan`
--
ALTER TABLE `beneficiosplan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `beneficiosreferidos`
--
ALTER TABLE `beneficiosreferidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `billetera`
--
ALTER TABLE `billetera`
  MODIFY `id_billetera` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `billeterauser`
--
ALTER TABLE `billeterauser`
  MODIFY `id_billeteraUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `bonored`
--
ALTER TABLE `bonored`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `codigoemail`
--
ALTER TABLE `codigoemail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `depositos`
--
ALTER TABLE `depositos`
  MODIFY `id_depositos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `frecuenciatransaccion`
--
ALTER TABLE `frecuenciatransaccion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `liderazgo`
--
ALTER TABLE `liderazgo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id_plan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `porcentajes`
--
ALTER TABLE `porcentajes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `referidos`
--
ALTER TABLE `referidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `id_retiros` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  ADD CONSTRAINT `beneficiosplan_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `beneficiosplan_ibfk_2` FOREIGN KEY (`id_deposito`) REFERENCES `depositos` (`id_depositos`);

--
-- Filtros para la tabla `beneficiosreferidos`
--
ALTER TABLE `beneficiosreferidos`
  ADD CONSTRAINT `beneficiosreferidos_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `beneficiosreferidos_ibfk_2` FOREIGN KEY (`referido`) REFERENCES `user` (`id_user`);

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
