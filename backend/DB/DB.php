<?php
function DBConnect($sql = '', $params = [])
{
    // definir datos de conexion a server
    $servidor = "localhost"; //

    $usuario = "root";
    $password = "";


    try {

        $conexion = new PDO("mysql:host=$servidor;dbname=tienda", $usuario, $password); // clase para conectar a base de datos
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // METODO PARA MOSTRAR ERRORES

        $sentencia = $conexion->prepare($sql); //Prepara una instrucción para su ejecución y devuelve un objeto de instrucción

        $sentencia->execute($params); // ejecuta una instruccion preparada
        $resultado = $sentencia->fetchAll(); //Retorna un array con los resultados de la tabla de la base de datos

        return $resultado;
    } catch (PDOException $error) {
        echo "conexión erronea " . $error;
    }
}
