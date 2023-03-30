<?php

class Conexion {
    private $dbh;
    private static $instancia; //The single instance
    private $host = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $nombreBaseDatos = 'tiza';

    /*
    Get an instance of the Database
    @return Instance
     */
    public static function getInstancia() {
        if (!self::$instancia) { // singleton
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    // Constructor
    private function __construct() {
        try {
            $this->dbh = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->nombreBaseDatos, $this->usuario, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getDbh() {
        return $this->dbh;
    }
}