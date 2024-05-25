-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2024 a las 21:53:28
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
-- Base de datos: `todos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_e` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(650) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `posición` varchar(250) NOT NULL,
  `oficina` varchar(500) NOT NULL,
  `direcion` varchar(650) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_e`, `cedula`, `name`, `email`, `password`, `posición`, `oficina`, `direcion`, `estado`) VALUES
(1, '0952869709', 'diego', 'diegoa@gmail.com', '$2y$10$.V0Eu5tb09ZxV6myQzD0be.ikDpmxN1LSYzVFAx.ADw014WZaURLy', 'admin', 'oficina 1', 'guangala mz e 18 villa 1', 1),
(5, '', '', 'admin@h.com', '12345', '', '', '', 0),
(6, '1254789632', 'julio', 'julio@hotmail.com', 'hola12', 'admin', 'oficina 1', 'floresta mz e 18 villa 1', 1),
(7, '0952869704', 'pedro', 'admin@gmail.com', '12345', 'gerente', 'oficina 1', 'guasmo mz e 18 villa 1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(15) NOT NULL,
  `title` varchar(250) NOT NULL,
  `completed` varchar(2) NOT NULL DEFAULT '0',
  `color` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `completed`, `color`) VALUES
(25, 'new task', '1', '#000000'),
(26, 'NEW', '0', '#d12e2e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(89, 'dsfsd', 'fsdf@gmail.com', '$2y$10$tjbkn/cfPrsBnQBq2suUJ.upVeEM7w2CbGwjg2Dak6YoqmRCPUfXe'),
(7859, 'diego', 'victorastudillo354@gmail.com', '$2y$10$.V0Eu5tb09ZxV6myQzD0be.ikDpmxN1LSYzVFAx.ADw014WZaURLy'),
(12322, 'dsfsd', 'sdfsdfsdf@gmail.com', '$2y$10$AMGIyRwy5sR0dK0VcnBMce7c1S0XKHS1cGforI9G7lZG7gaHeQ//u'),
(95286, 'victor', 'victorastudillo354@gmail.com', '$2y$10$ahh1h5qR5kZsQHynqdMuWuYf57STv3lzyCnuijYOPQEG6Db1o41I2'),
(952869709, 'cmpo                                        ', 'camuflaje@gmail.com', '$2y$10$IX.C1.yIcXDO3gd5sfp4wuFag3UiqpXV6gDHHuYd29rnCB1iUV6Yy'),
(1023654790, 'victor', 'astudillo@gmail.com', 'hola');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_e`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_e` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1023654791;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
