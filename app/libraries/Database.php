<?php

// Clase que maneja logica de la base de datos usando PDO
class Database
{

    // Traer variables para la conexion a la base de datos de config.php
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct()
    {
        //Variable para la conexion
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        // Array asociativo para crear las opciones de PDO para manejar errores
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
}