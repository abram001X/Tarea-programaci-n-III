<?php

class Purchase
{
    // Compras de un usuario, con datos del producto
    public static function forUser($userId)
    {
        $db = Database::getInstance();
        return $db->query(
            'SELECT c.id, c.cantidad, c.precio_unitario, c.fecha_compra,
                    p.nombre, p.imagen, p.categoria, p.precio AS precio_actual
             FROM compras c
             INNER JOIN productos p ON p.id = c.producto_id
             WHERE c.user_id = ?
             ORDER BY c.fecha_compra DESC, c.id DESC',
            [$userId]
        );
    }

    // Todas las compras (para el panel de administración)
    public static function all()
    {
        $db = Database::getInstance();
        return $db->query(
            'SELECT c.id, c.cantidad, c.precio_unitario, c.fecha_compra,
                    u.name AS user_name, u.email AS user_email,
                    p.nombre AS producto
             FROM compras c
             INNER JOIN users u ON u.id = c.user_id
             INNER JOIN productos p ON p.id = c.producto_id
             ORDER BY c.fecha_compra DESC, c.id DESC'
        );
    }

    // Registra una compra (recibe los items del carrito)
    public static function create($userId, $items)
    {
        $db = Database::getInstance();
        foreach ($items as $item) {
            $db->query(
                'INSERT INTO compras (user_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)',
                [$userId, $item['producto_id'], $item['cantidad'], $item['precio']]
            );
        }
    }
}
