-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2025 a las 14:42:53
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
-- Base de datos: `tienda_electronica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_usuario`
--

CREATE TABLE `registro_usuario` (
  `id_usuario` tinyint(4) NOT NULL,
  `nombre_completo_usu` varchar(100) NOT NULL,
  `correo_usuario` varchar(50) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `contraseña_usuario` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_usuario`
--

INSERT INTO `registro_usuario` (`id_usuario`, `nombre_completo_usu`, `correo_usuario`, `nombre_usuario`, `contraseña_usuario`) VALUES
(1, 'Juan Arango', 'huracan@gmail.com', 'Arangol', '$2y$10$plYE2a42TS38dV8l1hIube6xCKN9imVkL71V.ZAI5Ng1RQGuzwPQK'),
(2, 'andrew', 'hjohanandres7@gmail.com', 'andrew', '$2y$10$5oJvqqT5gmUWzEXylVzK4.KL9UW93kgFFdteHoMxd68OtaWzsWclS'),
(3, 'tulio emilio', 'emiliaco@gmail.com', 'tulio emilio', '$2y$10$lJ90XbTepZxSn4JockpZ5egiQX0beP3F70fhptK/tS.csFDZ6.UkS'),
(4, 'usuario', 'usuario@gmail.com', 'usuario', '$2y$10$NaAUfJP/A6oJcdFIuDPUY.j1Gew/DOIfw8PK/mwdazz5qh.VSFkaq');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registro_usuario`
--
ALTER TABLE `registro_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registro_usuario`
--
ALTER TABLE `registro_usuario`
  MODIFY `id_usuario` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
