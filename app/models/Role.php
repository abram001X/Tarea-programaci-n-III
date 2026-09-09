<?php

class Role
{
    public static function all()
    {
        $db = Database::getInstance();
        return $db->query('SELECT * FROM roles');
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $result = $db->query('SELECT * FROM roles WHERE id = ?', [$id]);
        return $result[0] ?? null;
    }

    public static function findByName($name)
    {
        $db = Database::getInstance();
        $result = $db->query('SELECT * FROM roles WHERE nombre = ?', [$name]);
        return $result[0] ?? null;
    }
}
