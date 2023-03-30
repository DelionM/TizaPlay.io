<?php

include_once 'Conexion.php';

class ColorDB {

    public function getColores() {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT * FROM color ORDER BY color';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $colores = $stmt->fetchAll();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $colores;
    }

//    public function getColorById($id) {
//        $conexion = Conexion::getInstancia();
//        $dbh = $conexion->getDbh();
//        try {
//            $consulta = 'SELECT color FROM color WHERE id_color = ?';
//            $stmt = $dbh->prepare($consulta);
//            $stmt->setFetchMode(PDO::FETCH_BOTH);
//            $stmt->bindParam(1, $id);
//            $stmt->execute();
//            $resultado = $stmt->fetch();
//            if ($resultado == 0) {
//                $color = 0;
//            } else {
//                $color = $resultado['color'];
//            }
//            $dbh = null; // cierra la conexion
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//        return $color;
//    }

}