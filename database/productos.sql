-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2026 a las 23:14:22
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
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` enum('hombre','mujer','accesorios') NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `activo` tinyint(1) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `categoria`, `imagen`, `descripcion`, `stock`, `activo`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Camiseta Básica Negra', 29.99, 'hombre', 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=500&q=80', 'Camiseta de algodón 100% orgánico, corte regular', 50, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(2, 'Jeans Slim Fit Azul', 59.99, 'hombre', 'https://images.unsplash.com/photo-1542272604-787c3835535d?auto=format&fit=crop&w=500&q=80', 'Jeans de corte ajustado con elastano para mayor comodidad', 35, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(3, 'Chaqueta Bomber Verde', 89.99, 'hombre', 'https://images.unsplash.com/photo-1551028719-00167b16eac5?auto=format&fit=crop&w=500&q=80', 'Chaqueta tipo bomber con forro interior y bolsillos laterales', 20, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(4, 'Sudadera con Capucha Gris', 49.99, 'hombre', 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=500&q=80', 'Sudadera de algodón con capucha ajustable y bolsillo canguro', 40, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(5, 'Polo Clásico Blanco', 34.99, 'hombre', 'https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?auto=format&fit=crop&w=500&q=80', 'Polo de algodón piqué con cuello y botones', 45, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(6, 'Vestido Floral Verano', 69.99, 'mujer', 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&w=500&q=80', 'Vestido ligero con estampado floral, perfecto para verano', 30, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(8, 'Jeans Mom Fit Celeste', 64.99, 'mujer', 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=500&q=80', 'Jeans de tiro alto con corte recto estilo vintage', 38, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(9, 'Falda Midi Plisada', 44.99, 'mujer', 'https://images.unsplash.com/photo-1583496661160-fb5886a0aaaa?auto=format&fit=crop&w=500&q=80', 'Falda midi plisada con cintura elástica', 28, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(10, 'Top Crop Básico', 24.99, 'mujer', 'https://images.unsplash.com/photo-1594223274512-ad4803739b7c?auto=format&fit=crop&w=500&q=80', 'Top corto de algodón, ideal para combinar', 55, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(12, 'Bolso Tote Canvas', 39.99, 'accesorios', 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?auto=format&fit=crop&w=500&q=80', 'Bolso tote espacioso de lona resistente', 32, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(13, 'Cinturón de Cuero Marrón', 34.99, 'accesorios', 'https://images.unsplash.com/photo-1624222247344-550fb60583dc?auto=format&fit=crop&w=500&q=80', 'Cinturón de cuero genuino con hebilla metálica', 42, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(14, 'Reloj Minimalista', 79.99, 'accesorios', 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?auto=format&fit=crop&w=500&q=80', 'Reloj de pulsera con correa de cuero y esfera minimalista', 18, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03'),
(15, 'Gafas de Sol Aviador', 49.99, 'accesorios', 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=500&q=80', 'Gafas de sol estilo aviador con protección UV400', 36, 1, '2026-07-13 23:23:03', '2026-07-13 23:23:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
