<?php

class Product
{
    public static function all()
    {
        $db = Database::getInstance();
        return $db->query('SELECT * FROM productos');
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $result = $db->query('SELECT * FROM productos WHERE id = ?', [$id]);
        return $result[0] ?? null;
    }

    public static function create($data)
    {
        $db = Database::getInstance();
        $db->query(
            'INSERT INTO productos (nombre, precio, categoria, imagen, descripcion, stock, activo)
             VALUES (?, ?, ?, ?, ?, ?, ?)',
            [
                $data['nombre'],
                $data['precio'],
                $data['categoria'],
                $data['imagen'],
                $data['descripcion'] ?? '',
                $data['stock'] ?? 0,
                $data['activo'] ?? 1,
            ]
        );
    }

    public static function delete($id)
    {
        $db = Database::getInstance();
        $db->query('DELETE FROM productos WHERE id = ?', [$id]);
    }
}
