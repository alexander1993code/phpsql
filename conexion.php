<?php

function conexion( $host="localhost",
    $dbname="mascotas_online",
    $pass = "", 
    $user="root")
{
    try {
        $db  = "mysql:host=$host;dbname=$dbname";
        $pdo = new PDO($db, $user, $pass);
        
    } catch (Exception $e) {

        echo $e->getMessage();
    }

    return $pdo;
}