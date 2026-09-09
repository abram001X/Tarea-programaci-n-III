<?php

class CartItem
{
    // Productos del carrito de un usuario, con datos del producto
    public static function forUser($userId)
    {
        $db = Database::getInstance();
        return $db->query(
            'SELECT c.id, c.user_id, c.producto_id, c.cantidad,
                    p.nombre, p.precio, p.imagen, p.categoria
             FROM carrito c
             INNER JOIN productos p ON p.id = c.producto_id
             WHERE c.user_id = ?
             ORDER BY c.id',
            [$userId]
        );
    }

    public static function add($userId, $productId, $cantidad = 1)
    {
        $db = Database::getInstance();
        $existing = $db->query(
            'SELECT id, cantidad FROM carrito WHERE user_id = ? AND producto_id = ?',
            [$userId, $productId]
        );

        if ($existing) {
            $newCant = $existing[0]['cantidad'] + $cantidad;
            $db->query('UPDATE carrito SET cantidad = ? WHERE id = ?', [$newCant, $existing[0]['id']]);
        } else {
            $db->query(
                'INSERT INTO carrito (user_id, producto_id, cantidad) VALUES (?, ?, ?)',
                [$userId, $productId, $cantidad]
            );
        }
    }

    public static function updateQuantity($userId, $productId, $cantidad)
    {
        $db = Database::getInstance();
        if ($cantidad <= 0) {
            $db->query('DELETE FROM carrito WHERE user_id = ? AND producto_id = ?', [$userId, $productId]);
        } else {
            $db->query(
                'UPDATE carrito SET cantidad = ? WHERE user_id = ? AND producto_id = ?',
                [$cantidad, $userId, $productId]
            );
        }
    }

    public static function remove($userId, $productId)
    {
        $db = Database::getInstance();
        $db->query('DELETE FROM carrito WHERE user_id = ? AND producto_id = ?', [$userId, $productId]);
    }

    public static function clear($userId)
    {
        $db = Database::getInstance();
        $db->query('DELETE FROM carrito WHERE user_id = ?', [$userId]);
    }

    public static function count($userId)
    {
        $db = Database::getInstance();
        $result = $db->query('SELECT SUM(cantidad) AS total FROM carrito WHERE user_id = ?', [$userId]);
        return (int) ($result[0]['total'] ?? 0);
    }
}
