-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2024 a las 01:05:03
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `baseproyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `cantidad`, `imagen`, `precio`) VALUES
(17, 'vinagre', 6, 'vinagre.jpg', 20),
(18, 'Huevo', 232, 'huevo.jpg', 2),
(19, 'cajeta', 42, 'cajeta.jpg', 30),
(20, 'atole', 32, 'atole.jpg', 15),
(21, 'avena', 60, 'avena.jpg', 25),
(22, 'harina', 200, 'harina.jpg', 20),
(23, 'mayonesa', 30, 'mayonesa.jpg', 40),
(24, 'mermelada', 100, 'mermelada.jpg', 60),
(25, 'miel', 24, 'miel.jpg', 35),
(26, 'mole', 57, 'mole.jpg', 17),
(27, 'pasta', 158, 'pasta.jpg', 6),
(28, 'sal', 61, 'sal.jpg', 21),
(29, 'salsa', 28, 'salsa.jpg', 21),
(30, 'sazonador', 129, 'sazonador.jpg', 23),
(31, 'sopa', 121, 'sopas.jpg', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `_id` int(11) NOT NULL,
  `nombreCompleto` varchar(50) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`_id`, `nombreCompleto`, `edad`, `correo`, `usuario`, `password`) VALUES
(1, 'Larisa Diaz', 17, 'larisa@gmail.com', 'larisa', '123'),
(2, 'Angel Pineda', 16, 'angel@gmail.com', 'angel', '167'),
(3, 'Paola Ortiz', 23, 'paola@gmail.com', 'paola', '789'),
(4, 'Leslie González', 16, 'leslie@gmail.com', '500Leslie', '$2y$10$Hy36D8LNAFBmA.i3TlvO9.5nQbIPRJcahuZvY.klytwBEPfgOs1L6'),
(5, 'Hanna Puentes', 16, 'hanna@gmail.com', '400hanna', '$2y$10$tFLvO5n1W0wg4.1Oe9Gj9eYUkCYycUh7kuqz39oiDHjXSDTe/8QTe'),
(6, 'Yeshua Montes', 17, 'Yeshua@gmail.om', '300Yeshua', '$2y$10$xu3MC6oU6DBfc5vuvUJ3yePov5tVTrSSThiCVUIeo0jDiL8OMPl0W');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
