<?php

// Guard para servir archivos estáticos cuando se usa el servidor integrado de PHP
if (PHP_SAPI === 'cli-server') {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($uri !== '/' && is_file(__DIR__ . $uri)) {
        return false;
    }
}

session_start();

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/app/core/Database.php';
require dirname(__DIR__) . '/app/core/Controller.php';
require dirname(__DIR__) . '/app/core/Router.php';
require dirname(__DIR__) . '/app/models/Role.php';
require dirname(__DIR__) . '/app/models/Product.php';
require dirname(__DIR__) . '/app/models/User.php';
require dirname(__DIR__) . '/app/models/CartItem.php';
require dirname(__DIR__) . '/app/models/Purchase.php';
require dirname(__DIR__) . '/app/controllers/ProductController.php';
require dirname(__DIR__) . '/app/controllers/AuthController.php';
require dirname(__DIR__) . '/app/controllers/PanelController.php';
require dirname(__DIR__) . '/app/controllers/CartController.php';

// Calcular la URL base de la aplicación
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$scriptDir = rtrim(dirname($scriptName), '/');
$base = preg_replace('#/public$#', '', $scriptDir);
if ($base === '/' || $base === '') {
    $base = '';
}
define('BASE_URL', $base);

// Extraer la ruta solicitada
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($base !== '') {
    if (strpos($uri, $base) === 0) {
        $uri = substr($uri, strlen($base));
    }
}
if ($uri === '' || $uri === '/') {
    $uri = '/';
}

// Definir rutas
$router = new Router();
$router->add('GET', '/', 'ProductController@index');
$router->add('GET', '/login', 'AuthController@loginForm');
$router->add('POST', '/login', 'AuthController@login');
$router->add('GET', '/registro', 'AuthController@registerForm');
$router->add('POST', '/registro', 'AuthController@register');
$router->add('GET', '/logout', 'AuthController@logout');
$router->add('GET', '/panel/admin', 'PanelController@admin');
$router->add('GET', '/panel/vendedor', 'PanelController@vendedor');
$router->add('GET', '/panel/soporte', 'PanelController@soporte');
$router->add('GET', '/api/cart', 'CartController@index');
$router->add('POST', '/api/cart/add', 'CartController@add');
$router->add('POST', '/api/cart/update', 'CartController@update');
$router->add('POST', '/api/cart/remove', 'CartController@remove');
$router->add('POST', '/api/cart/checkout', 'CartController@checkout');
$router->add('GET', '/mis-compras', 'CartController@misCompras');

// Despachar la petición
try {
    $router->dispatch($_SERVER['REQUEST_METHOD'], $uri);
} catch (Throwable $e) {
    http_response_code(500);
    echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Error</title></head><body style="font-family:sans-serif;padding:40px"><h1>Error del servidor</h1><p>Ha ocurrido un error inesperado. Inténtalo de nuevo más tarde.</p></body></html>';
}
