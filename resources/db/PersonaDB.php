<?php

include_once 'Conexion.php';

class personaDB {

    public function insertaPersona($persona) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'INSERT INTO persona (nombre, apellido_paterno, apellido_materno, calle, numero, codigo_postal, correo_electronico) VALUES (?,?,?,?,?,?,?)';
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $persona['nombre']);
            $stmt->bindParam(2, $persona['paterno']);
            $stmt->bindParam(3, $persona['materno']);
            $stmt->bindParam(4, $persona['calle']);
            $stmt->bindParam(5, $persona['numero']);
            $stmt->bindParam(6, $persona['cp']);
            $stmt->bindParam(7, $persona['email']);
            $stmt->execute();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUltimoIdInsertado() {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT MAX( id_persona ) FROM persona';
            $stmt = $dbh->prepare($consulta);
            $stmt->execute();
            $resultado = $stmt->fetch();
            $id = $resultado[0];
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $id;
    }

    public function existeCorreo($correo) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT correo_electronico FROM persona WHERE correo_electronico = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $correo);
            $stmt->execute();
            $resultado = $stmt->fetch();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if (isset($resultado['correo_electronico']))
            return true;
        else
            return false;
    }

}
