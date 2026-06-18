<?php

namespace Utils;

use Exception;

class DBController
{
    public $directory = "";
    public function __construct($directory = "")
    {
        $this->directory = $directory;
    }

    public function getProducts()
    {
        $getDb = file_get_contents($this->directory);
        $dataBase = json_decode($getDb, true);
        return is_array($dataBase) ? $dataBase : [];
    }

    public function saveUser($user = [])
    {
        $email = $user['email'];
        $name = $user['name'];
        $password = $user['password'];

        $validate = $this->validateUser([$email,$password]);
        echo $validate;
        if($validate){
            $params = [$password, $name, $email];
            $sql = "INSERT INTO users (password, name, email) VALUES (?, ?, ?)";
            $res = DBConnect($sql, $params);
            return ['message'=>'usuario registrado con exito'];
        }
        return ["message" => "Email ya existe"];
    }

    public function loginUser($user = [])
    {
        $email = $user['email'];
        $password = $user['password'];
        $params = [$email, $password];
        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $res = DBConnect($sql, $params);
        
        if (empty($res)) {
            return [
                "message" => "Error, datos no válidos"
            ];
        }
        
        return  [
            "message" => "Usuario logeado con éxito: ",
            "name" => $res[0]['name']
        ];
    }

    public function addToCar()
    {
        try {
            //Agregar a la base de datos
        } catch (Exception $e) {
            echo "Error: $e";
        }
    }
    public function removeToCar()
    {
        try {
            //eliminar de la base de datos
        } catch (Exception $e) {
            echo "Error: $e";
        }
    }
    public function addBuying()
    {
        try {
            //Agregar a la base de datos
        } catch (Exception $e) {
            echo "Error: $e";
        }
    }
    private function validateUser($params = [])
    { //recorrer array
        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $res = DBConnect($sql, $params);
        return empty($res); // Si hay un usuario registrado con el mismo email no es válido
    }
}
