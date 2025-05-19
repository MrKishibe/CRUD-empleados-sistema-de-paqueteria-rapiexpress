<?php
require_once 'config/conexion.php';

class Tienda {
    private $db;

    public function __construct() {
        $this->db = Conexion::getConexion();
    }

    public function registrar($data) {
        try {
            
            $stmtCheck = $this->db->prepare("SELECT id_tienda FROM tiendas WHERE tracking = ?");
            $stmtCheck->execute([$data['tracking']]);
            if ($stmtCheck->fetch()) {
                return 'tracking_existente';
            }

            $stmt = $this->db->prepare("INSERT INTO tiendas (tracking, nombre_tienda) VALUES (?, ?)");
            $resultado = $stmt->execute([
                $data['tracking'],
                $data['nombre_tienda']
            ]);

            return $resultado ? 'registro_exitoso' : 'error_registro';

        } catch (PDOException $e) {
            error_log("Error en registro tienda: " . $e->getMessage());
            return 'error_bd';
        }
    }

    public function obtenerTodas() {
        $stmt = $this->db->prepare("SELECT * FROM tiendas ORDER BY id_tienda DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM tiendas WHERE id_tienda = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($data) {
        try {
            $stmtCheck = $this->db->prepare("SELECT id_tienda FROM tiendas WHERE tracking = ? AND id_tienda != ?");
            $stmtCheck->execute([$data['tracking'], $data['id_tienda']]);
            if ($stmtCheck->fetch()) return 'tracking_existente';

            $stmt = $this->db->prepare("UPDATE tiendas SET tracking = ?, nombre_tienda = ? WHERE id_tienda = ?");
            return $stmt->execute([
                $data['tracking'],
                $data['nombre_tienda'],
                $data['id_tienda']
            ]);
        } catch (PDOException $e) {
            error_log("Error al actualizar tienda: " . $e->getMessage());
            return false;
        }
    }

    private $lastError = '';


public function eliminar($id) {
    try {
        // Verificar si la tienda tiene registros asociados
        $stmtCheck = $this->db->prepare("SELECT COUNT(*) FROM tiendas WHERE id_tienda = ?");
        $stmtCheck->execute([$id]);
        if ($stmtCheck->fetchColumn() > 0) {
            $this->lastError = 'No se puede eliminar la tienda porque tiene pedidos asociados';
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM tiendas WHERE id_tienda = ?");
        $result = $stmt->execute([$id]);
        
        if (!$result || $stmt->rowCount() === 0) {
            $this->lastError = 'No se encontró la tienda o no se pudo eliminar';
            return false;
        }
        
        return true;
    } catch (PDOException $e) {
        $this->lastError = $e->getMessage();
        error_log("Error al eliminar tienda: " . $e->getMessage());
        return false;
    }
}


public function getLastError() {
    return $this->lastError;
}
}
