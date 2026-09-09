-- ============================================================
-- Migración: Carrito de compras y compras realizadas
-- Base de datos: tienda
-- ============================================================

-- --------------------------------------------------------
-- Tabla: carrito (productos en el carrito por cada usuario)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_user_producto` (`user_id`, `producto_id`),
  KEY `fk_carrito_user` (`user_id`),
  KEY `fk_carrito_producto` (`producto_id`),
  CONSTRAINT `fk_carrito_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_carrito_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------
-- Tabla: compras (productos que los clientes han comprado)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `precio_unitario` decimal(10,2) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_compras_user` (`user_id`),
  KEY `fk_compras_producto` (`producto_id`),
  CONSTRAINT `fk_compras_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_compras_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
