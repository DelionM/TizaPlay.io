<?php

include_once 'Conexion.php';

class PlayeraDB {

    public function existeTipoPlayera($playera): bool {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT * FROM playera WHERE fk_idtela = ? AND fk_idtalla = ? AND fk_idcolor = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->bindValue(1, $playera['tela']);
            $stmt->bindValue(2, $playera['talla']);
            $stmt->bindValue(3, $playera['color']);
            $stmt->execute();
            $cantidad = $stmt->rowCount();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($cantidad != 0)
            $resultado = true;
        else
            $resultado = false;
        return $resultado;
    }

    public function getIdPlayera($playera): int {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT id_playera FROM playera WHERE fk_idtela = ? AND fk_idtalla = ? AND fk_idcolor = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->bindValue(1, $playera['tela']);
            $stmt->bindValue(2, $playera['talla']);
            $stmt->bindValue(3, $playera['color']);
            $stmt->execute();
            $resultado = $stmt->fetch();
            if ($resultado == 0) {
                $idPlayera = 0;
            } else {
                $idPlayera = $resultado['id_playera'];
            }
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $idPlayera;
    }

    public function getExistenciaporId($idPlayera): int {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT existencia FROM playera WHERE id_playera = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->bindValue(1, $idPlayera);
            $stmt->execute();
            $resultado = $stmt->fetch();
            $existencia = $resultado['existencia'];
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $existencia;
    }

    public function agregaCantidadPlayerasPorId($idPlayera, $cantidad) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'UPDATE playera SET existencia = ? WHERE id_playera= ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $cantidad);
            $stmt->bindParam(2, $idPlayera);
            $stmt->execute();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertaPlayera($playera) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'INSERT INTO playera (fk_idtela, fk_idcolor, fk_idtalla, existencia) VALUES (?,?,?,?)';
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $playera['tela']);
            $stmt->bindParam(2, $playera['color']);
            $stmt->bindParam(3, $playera['talla']);
            $stmt->bindValue(4, 0);
            $stmt->execute();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getPlayeras() {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT id_playera, tela.tela, color.color, talla.talla, existencia FROM playera '
                . 'JOIN tela ON playera.fk_idtela = tela.id_tela '
                . 'JOIN color ON playera.fk_idcolor = color.id_color '
                . 'JOIN talla ON playera.fk_idtalla = talla.id_talla '
                . 'ORDER BY tela, color, talla';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $playeras = $stmt->fetchAll();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $playeras;
    }

    public function eliminaPlayeraById($idPlayera) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'DELETE FROM playera WHERE id_playera = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $idPlayera);
            $stmt->execute();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}