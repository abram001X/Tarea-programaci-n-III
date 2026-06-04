<?php

namespace Utils;

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

   
}
