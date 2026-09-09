<?php

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'tienda');
define('DB_USER', 'root');
define('DB_PASS', '');

// Constantes de la aplicación
define('APP_PATH', dirname(__DIR__));
define('VIEW_PATH', APP_PATH . '/app/views');

// Roles predefinidos
define('ROLE_CLIENTE', 'cliente');
define('ROLE_ADMIN', 'administrador');
define('ROLE_VENDEDOR', 'vendedor');
define('ROLE_SOPORTE', 'soporte');
