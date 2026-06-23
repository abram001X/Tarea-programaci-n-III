<?php

require __DIR__ . "/Utils/DBController.php";
header('Content-Type: application/json');
$method = $_SERVER["REQUEST_METHOD"];
$directory = __DIR__ . '/DB/products.json';
//$directory = __DIR__ . '/DB/DB.php';
use Utils\DBController;

if ($method == "GET") {
    $db = new DBController($directory);
    $products = $db->getProducts();
    echo json_encode($products);
}
