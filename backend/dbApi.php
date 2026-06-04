<?php

require __DIR__ . "/Utils/DB.php";
header('Content-Type: application/json');
$method = $_SERVER["REQUEST_METHOD"];
$directory = __DIR__ . '/DB/products.json';
use Utils\DB;

if ($method == "GET") {
    $db = new DB($directory);
    $products = $db->getProducts();
    echo json_encode($products);
}
