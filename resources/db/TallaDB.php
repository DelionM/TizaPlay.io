<?php

include_once 'Conexion.php';

class TallaDB {


    public function getTallas() {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT * FROM talla';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $tallas = $stmt->fetchAll();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $tallas;
    }

    public function getTallaById($id) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT talla FROM talla WHERE idtalla = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $resultado = $stmt->fetch();
            if ($resultado == 0) {
                $talla = 0;
            } else {
                $talla = $resultado['talla'];
            }
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $talla;
    }

}