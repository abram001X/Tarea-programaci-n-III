<?php

class User
{
    // Devuelve el usuario con su rol (join con la tabla roles)
    public static function findByCredentials($email, $password)
    {
        $db = Database::getInstance();
        $result = $db->query(
            'SELECT u.*, r.nombre AS role
             FROM users u
             INNER JOIN roles r ON r.id = u.role_id
             WHERE u.email = ? AND u.password = ?',
            [$email, $password]
        );
        return $result[0] ?? null;
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $result = $db->query(
            'SELECT u.*, r.nombre AS role
             FROM users u
             INNER JOIN roles r ON r.id = u.role_id
             WHERE u.id = ?',
            [$id]
        );
        return $result[0] ?? null;
    }

    public static function exists($email)
    {
        $db = Database::getInstance();
        return !empty($db->query('SELECT id FROM users WHERE email = ?', [$email]));
    }

    public static function updateRole($userId, $roleId)
    {
        $db = Database::getInstance();
        $db->query('UPDATE users SET role_id = ? WHERE id = ?', [$roleId, $userId]);
    }

    public static function create($name, $email, $password, $roleId = null)
    {
        $db = Database::getInstance();

        if ($roleId === null) {
            $cliente = Role::findByName(ROLE_CLIENTE);
            $roleId = $cliente ? $cliente['id'] : 1;
        }

        $db->query(
            'INSERT INTO users (password, name, email, role_id) VALUES (?, ?, ?, ?)',
            [$password, $name, $email, $roleId]
        );
    }
}
