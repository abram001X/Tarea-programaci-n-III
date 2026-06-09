<?php

namespace Utils;

use Exception;

class DB
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
        $getDb = file_get_contents($this->directory);
        $dataBase = json_decode($getDb, true);
        if (is_array($dataBase)) {
            $validate = $this->validateUser($user, $dataBase);
            if ($validate) {
                $dataBase["users"][] = $user;
            } else {
                return ["message" => "Email ya existe"];
            }
        }
        file_put_contents($this->directory, json_encode($dataBase));
        return ["message" => "usuario registrado con exito"];
    }

    public function loginUser($user = [])
    {
        $getDb = file_get_contents($this->directory);
        $dataBase = json_decode($getDb, true);
        $res =  [
            "message" => "Error, datos no válidos"
        ];
        foreach ($dataBase["users"] as $users) { 
            if ($users["email"] == $user["email"] && $users["password"] == $user["password"]) { //Realizar esto en DB class  !!!!!
                $res = [
                    "message" => "Usuario logeado con éxito: ",
                    "name" => $users["name"]
                ];

            }
        }
        return $res;
    }
    private function validateUser($user = [], $dataBase = [])
    { //recorrer array
        $isValid = true;
        foreach ($dataBase["users"] as $value) {// !!!! !
            if ($user["email"] 
            == $value["email"]) {
                $isValid = false;
            }
        }
        return $isValid;
    }
}
