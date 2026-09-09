-- ============================================================
-- Migración: Sistema de roles de usuarios
-- Base de datos: tienda
-- ============================================================

-- Tabla de roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Roles: cliente primero (id=1) para que sea el rol por defecto
INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'cliente', 'Usuario común (cliente)'),
(2, 'administrador', 'Acceso total a la tienda'),
(3, 'vendedor', 'Gestión de productos y ventas'),
(4, 'soporte', 'Atención al cliente');

-- Agregar la columna role_id a users (si no existe)
ALTER TABLE `users`
  ADD COLUMN IF NOT EXISTS `role_id` int(11) NOT NULL DEFAULT 1 AFTER `email`;

-- Asignar rol por defecto (cliente) a usuarios existentes sin rol
UPDATE `users` SET `role_id` = 1 WHERE `role_id` IS NULL OR `role_id` = 0;

-- Relación: users.role_id -> roles.id
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role`
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
