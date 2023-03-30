<?php

include_once 'Conexion.php';

class ImagenDB {

    public function insertaImagen($archivos) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        $statusMsg = '';

        // File upload path
        $targetDir = "../resources/upload/";
        $fileName = basename($archivos['imagen']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        try {
            if (!empty($archivos['imagen']['name'])) {
                // Allow certain file formats
                $tiposPermitidos = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                if (in_array($fileType, $tiposPermitidos)) {
                    // Upload file to server
                    if (move_uploaded_file($archivos['imagen']['tmp_name'], $targetFilePath)) {
                        // Insert image file name into database
                        $consulta = "INSERT INTO imagen (nombre_archivo) VALUES('" . $fileName . "')";
                        $stmt = $dbh->prepare($consulta);
                        $stmt->setFetchMode(PDO::FETCH_BOTH);
                        $res = $stmt->execute();
                        $dbh = null; // cierra la conexion
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                }
            } else {
                $statusMsg = 'Please select a file to upload.';
            }
            print($statusMsg);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getMaxId(): int {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT MAX(id_imagen) FROM imagen';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $resultado = $stmt->fetch();
            if ($resultado == 0) {
                $idImagen = 0;
            } else {
                $idImagen = $resultado[0];
            }
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $idImagen;
    }

    public function getNombreArchivoById($id) {
        $conexion = Conexion::getInstancia();
        $dbh = $conexion->getDbh();
        try {
            $consulta = 'SELECT nombre_archivo FROM imagen WHERE id_imagen = ?';
            $stmt = $dbh->prepare($consulta);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $resultado = $stmt->fetch();
            $nombre = $resultado['nombre_archivo'];
//            if ($resultado == 0) {
//                $nombre = 0;
//            } else {
//                $nombre = $resultado[0];
//            }
            $dbh = null; // cierra la conexion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $nombre;
    }

}