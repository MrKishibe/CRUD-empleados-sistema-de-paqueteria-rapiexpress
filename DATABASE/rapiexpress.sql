-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2025 a las 23:49:05
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
-- Base de datos: `rapiexpress`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `cedula`, `nombre`, `apellido`, `email`, `telefono`, `direccion`, `fecha_registro`, `estado`) VALUES
(8, '30204400', 'fd', 'asd', 'dassd@gmial.co', '0426809217', 'Carrera 18\r\nSanta Eduvigis', '2025-05-19 15:39:10', 'inactivo'),
(9, '11810395', 'Jellls', 'Leal Guedezlk', 'kkk@gmail.com', '04268092178', 'Carrera 18\r\nSanta Eduvigis', '2025-05-19 16:46:34', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `cedula`, `nombre`, `apellido`, `email`, `telefono`, `direccion`, `fecha_registro`, `estado`) VALUES
(0, '1181ss0395', 'sad', 'asda', 'sda3@gm.com', '23242', 'sdf', '2025-05-19 17:43:11', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `id_tienda` int(11) NOT NULL,
  `tracking` varchar(100) NOT NULL,
  `nombre_tienda` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`id_tienda`, `tracking`, `nombre_tienda`, `fecha_registro`) VALUES
(2, 'TRK-0013', 'Tienda Centri', '2025-05-19 15:48:14'),
(3, 'TRK-0026', 'Electro Hogar', '2025-05-19 15:48:14'),
(4, 'TRK-003', 'Mundo Celular', '2025-05-19 15:48:14'),
(5, 'TRK-004', 'Moda Express', '2025-05-19 15:48:14'),
(6, 'TRK-005', 'Supermercado La Estrella', '2025-05-19 15:48:14'),
(7, 'kl', '23', '2025-05-19 15:58:47'),
(8, 'ssas', 'ssss', '2025-05-19 16:22:49'),
(9, 'sad', 'assddd', '2025-05-19 16:39:50'),
(10, 'TRK-0036', '23', '2025-05-19 16:43:44'),
(11, 'SSSSS', 'ssss', '2025-05-19 17:40:22'),
(12, 'P`P`L', '23K', '2025-05-19 21:03:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sucursal` enum('sucursal_usa','sucursal_ec','sucursal_ven') NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `documento`, `username`, `nombres`, `apellidos`, `email`, `sucursal`, `password`, `fecha_registro`) VALUES
(1, '0000000', 'Admin123@', 'jua', 'sad', 'asdal03022004@gmail.com', 'sucursal_ven', '$2y$10$ur6my3iQIqTKrC3BPk9dCe1xyjpTX4o/eDo.qSBiLNALx0PZUYbnK', '2025-05-19 02:11:33'),
(24, '000000', 'Admin1234@', 'Pedro', 'Camejo', 'Pedro@gmail.com', 'sucursal_usa', '$2y$10$IpqeP/SCcNuweQgXr1dL.u.Lz/QlQBUu8dj3hWux/eax4Abb6jiIK', '2025-05-19 20:26:30'),
(25, '0000000000', 'admin', 'Pedro', 'Camejo', 'Camejo@gmail.com', 'sucursal_ec', '$2y$10$Jzv58wJM0aEjSuwl/rDU5eJOUfi9A91GKXIy2iTr9Ap6Lbv5HsHlW', '2025-05-19 20:28:56');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`id_tienda`),
  ADD UNIQUE KEY `tracking` (`tracking`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `id_tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
