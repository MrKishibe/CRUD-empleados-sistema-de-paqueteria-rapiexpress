<?php
require_once 'config/conexion.php';

abstract class Persona {
    protected $nombre;
    protected $apellido;

    abstract public function getNombreCompleto();
}

class Usuario extends Persona {
    private $id;
    private $documento;
    private $username;
    private $email;
    private $sucursal;
    private $password;
    private $fecha_registro;

    public function __construct($data = []) {
        $this->documento = $data['documento'] ?? '';
        $this->username = $data['username'] ?? '';
        $this->nombre = $data['nombres'] ?? '';
        $this->apellido = $data['apellidos'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->sucursal = $data['sucursal'] ?? '';
        $this->password = $data['password'] ?? '';
    }

   public function registrar() {
    $pdo = Conexion::getConexion();
    
    try {
        // Verificar si la cédula ya existe
        $stmtCheck = $pdo->prepare("SELECT id FROM usuarios WHERE documento = ?");
        $stmtCheck->execute([$this->documento]);
        if ($stmtCheck->fetch()) {
            return 'documento_existente';
        }

        // Verificar si el email ya existe
        $stmtCheck = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmtCheck->execute([$this->email]);
        if ($stmtCheck->fetch()) {
            return 'email_existente';
        }

        // Verificar si el username ya existe
        $stmtCheck = $pdo->prepare("SELECT id FROM usuarios WHERE username = ?");
        $stmtCheck->execute([$this->username]);
        if ($stmtCheck->fetch()) {
            return 'username_existente';
        }

        // Si no existen duplicados, proceder con el registro
        $stmt = $pdo->prepare("INSERT INTO usuarios 
                             (documento, username, nombres, apellidos, email, sucursal, password) 
                             VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $resultado = $stmt->execute([
            $this->documento,
            $this->username,
            $this->nombre,
            $this->apellido,
            $this->email,
            $this->sucursal,
            password_hash($this->password, PASSWORD_BCRYPT)
        ]);

        return $resultado ? 'registro_exitoso' : 'error_registro';

    } catch (PDOException $e) {
        error_log("Error en registro: " . $e->getMessage());
        return 'error_bd';
    }
}

    public static function autenticar($username, $password) {
        $pdo = Conexion::getConexion();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }

    public function getNombreCompleto() {
        return $this->nombre . ' ' . $this->apellido;
    }

    // Getters para las nuevas propiedades
    public function getDocumento() {
        return $this->documento;
    }

    public function getSucursal() {
        return $this->sucursal;
    }

    public function getFechaRegistro() {
        return $this->fecha_registro;
    }
    // En models/Usuario.php
public static function obtenerTodos() {
    $pdo = Conexion::getConexion();
    $stmt = $pdo->prepare("SELECT id, documento, nombres, apellidos, email, sucursal, fecha_registro FROM usuarios");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}


