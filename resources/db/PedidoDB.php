<?php

include_once 'Conexion.php';

class PedidoDB {

    public function insertaPedido($idPlayera, $idUsuario, $importe, $idImagen, $pedido) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'INSERT INTO pedido (fk_idplayera, fk_idusuario, cantidad, mensaje, importe, fk_idimagen, fecha_orden) VALUES(?,?,?,?,?,?,now())';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->bindValue(1, $idPlayera);
            $stmt->bindValue(2, $idUsuario);
            $stmt->bindValue(3, $pedido['cantidad']);
            $stmt->bindValue(4, $pedido['mensaje']);
            $stmt->bindValue(5, $importe);
            $stmt->bindValue(6, $idImagen);
            $stmt->execute();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getMaxId(): int {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT MAX(id_pedido) FROM pedido';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $resultado = $stmt->fetch();
            if ($resultado == 0) {
                $idPedido = 0;
            } else {
                $idPedido = $resultado[0];
            }
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $idPedido;
    }

    public function getPedidoPorId($id) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT tela.tela, color.color, talla.talla, cantidad, mensaje, importe, fk_idimagen FROM pedido '
                . 'JOIN playera ON pedido.fk_idplayera = playera.id_playera '
                . 'JOIN tela ON playera.fk_idtela = tela.id_tela '
                . 'JOIN color ON playera.fk_idcolor = color.id_color '
                . 'JOIN talla ON playera.fk_idtalla = talla.id_talla '
                . 'WHERE id_pedido = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $pedido = $stmt->fetch();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $pedido;
    }

    public function agregaReferenciaContrarefPorId($idPedido, $referencia, $contrareferencia) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'UPDATE pedido SET referencia = ?, contrareferencia = ? WHERE id_pedido = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->bindParam(1, $referencia);
            $stmt->bindParam(2, $contrareferencia);
            $stmt->bindParam(3, $idPedido);
            $stmt->execute();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getPedidosPorUsuario($id) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT tela.tela, color.color, talla.talla, cantidad, mensaje, importe, imagen.nombre_archivo FROM pedido '
                . 'JOIN playera ON pedido.fk_idplayera = playera.id_playera '
                . 'JOIN tela ON playera.fk_idtela = tela.id_tela '
                . 'JOIN color ON playera.fk_idcolor = color.id_color '
                . 'JOIN talla ON playera.fk_idtalla = talla.id_talla '
                . 'JOIN imagen ON pedido.fk_idimagen = imagen.id_imagen '
                . 'WHERE fk_idusuario = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $pedidos = $stmt->fetchAll();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $pedidos;
    }

    public function getPedidos() {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT usuario.usuario, tela.tela, color.color, talla.talla, cantidad, mensaje, importe, imagen.nombre_archivo FROM pedido '
                . 'JOIN usuario ON pedido.fk_idusuario = usuario.id_usuario '
                . 'JOIN playera ON pedido.fk_idplayera = playera.id_playera '
                . 'JOIN tela ON playera.fk_idtela = tela.id_tela '
                . 'JOIN color ON playera.fk_idcolor = color.id_color '
                . 'JOIN talla ON playera.fk_idtalla = talla.id_talla '
                . 'JOIN imagen ON pedido.fk_idimagen = imagen.id_imagen ';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $pedidos = $stmt->fetchAll();
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $pedidos;
    }
}