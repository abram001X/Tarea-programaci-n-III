<?php

namespace Utils;

use Exception;

class User
{
    public $name = "";
    private $password = "";
    public $email  = "";

    public function __construct($dataUser = [])
    {
        $this->name = $dataUser["name"];
        $this->password = $dataUser["password"];
        $this->email = $dataUser["email"];
    }
    public function agregarCarrito($id)
    {
        try {
            if ($this->verifyUser()) {
                //guardar a la base de datos, que el usuario agregó al carrito de compra
            }
        } catch (Exception $e) {
            echo "error: $e";
        }
    }
    public function comprarProducto($id)
    {
        try {
            if ($this->verifyUser()) {
                //guardar a la base de datos el producto que compró el usuario
            }
        } catch (Exception $e) {
            echo "error: $e";
        }
    }
    public function eliminamosDelCarrito()
    {
        try {
            if ($this->verifyUser()) {
                //Eliminar de la base de datos el producto del carrito de compra del usuario.
            }
        } catch (Exception $e) {
            echo "Error: $e";
        }
    }
    protected function verifyUser()
    {
        return $this->name && $this->password && $this->email;
    }
}
