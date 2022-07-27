-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2022 a las 11:44:40
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestorarchivos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(5, 'Administrador', 'bYiMgO9E75zu_aRhqJCPuk21AlBks2od', '$2y$13$wrfhUU8MUi2DoFqjuqoAau50HhARPQXUAuDGmbtrtBd1KfbE0XVVS', '', 'javierpicon48@gmail.com', 10, 1640784518, 1640870915, ''),
(6, 'Usuario de vista', 'ZXSPQYaoxBFNLfD_RtYiA14xyN-2XTvY', '$2y$13$Qkv.fKsuG1a8UUimPrNXIOl87oPbth5DzJJt0ekNSZxsykJCfuFgq', NULL, 'vista@gmail.com', 10, 1640867279, 1640870900, NULL),
(7, 'Administrador de usuarios', 'eLoEb2tLO_HMW0O-MwayHUEiUvV6T4b7', '$2y$13$kNrHI5iU1Z2UD4Q/Bpb6oOFPzjdjkdHFTFsEi9cUhfKfZzw377JKW', NULL, 'usuarios@gmail.com', 10, 1641214593, 1641214593, NULL),
(9, 'Aguas Riojanas', 'rpKHXG66XW6MArR_6YsbMwMVL9LSuaRV', '$2y$13$5JDlddrU2hL0XHjZoRQ7pOKoXP6nmjKL63/Csd03Cotsx6oB4P2sy', NULL, 'aguasriojanas2022@gmail.com', 10, 1641216374, 1641216374, NULL),
(10, 'Usuarios de vista archivos', 'GoBGIDllKULyc6dhpIC8gQSwHuYbDkZv', '$2y$13$KLA9HWVtHL/WRv37gz6lJucbkOOIkEhSMwGqF.obdaYxksuaCoiW.', NULL, 'vistauser@gmail.com', 9, 1642428668, 1642428740, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
