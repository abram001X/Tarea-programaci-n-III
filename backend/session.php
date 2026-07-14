<?php
session_start();
require __DIR__ . "/DB/DB.php";
require __DIR__ . "/Utils/User.php";
require __DIR__ . "/Utils/DBController.php";

use Utils\User;
use Utils\DBController;

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
$directory = __DIR__ . '/DB/users.json';

if ($method == "POST") { // Register
    try {
        //code...
        $res = file_get_contents('php://input');
        $data = json_decode($res, true);
        $password = $data["password"];
        $email = $data["email"];
        $name = $data["name"];
        $db = new DBController($directory);
        $post = $db->saveUser($data);
        if ($post["message"] == "usuario registrado con exito") {
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
        }
        echo json_encode($post, true);
    } catch (Exception $err) {
        echo json_encode(["message" => "error: $err"]);
    }
}

if ($method == "GET") { // login
    if (isset($_GET["email"])) {
        try {
            $data = ["email" => $_GET["email"], "password" => $_GET["password"]];
            $email = $data["email"];
            $password = $data["password"];
            $db = new DBController($directory);
            $get = $db->loginUser($data);
            if ($get["message"] == "Usuario logeado con éxito: ") { //
                $data["name"] = $get["name"]; //
                $user = new User($data);
                $_SESSION["name"] = $data["name"];
                $_SESSION["email"] = $email;

            }
            
            echo json_encode($get, true);
        } catch (Exception $err) {
            echo "error: $err";
        }
    }
}

if ($method == "DELETE") { //cerrar sesion
    $data = [];
    session_unset();
    session_destroy();
}
