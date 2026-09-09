<?php

class Product
{
    public static function all()
    {
        $db = Database::getInstance();
        return $db->query('SELECT * FROM productos');
    }
}
