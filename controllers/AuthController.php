<?php
require_once 'models/Usuario.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::autenticar($_POST['username'], $_POST['password']);
            if ($usuario) {
                session_start();
                $_SESSION['usuario'] = $usuario['username'];
                header('Location: index.php?c=dashboard&a=index');
                exit();
            } else {
                $error = "Credenciales inválidas.";
            }
        }
        include 'views/auth/login.php';
    }
public function register() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'documento' => trim($_POST['document']),
            'username' => trim($_POST['username']),
            'nombres' => trim($_POST['first_name']),
            'apellidos' => trim($_POST['last_name']),
            'email' => trim($_POST['email']),
            'sucursal' => $_POST['sucursal'],
            'password' => $_POST['password']
        ];
        
        // Validaciones básicas
        if (empty($data['documento']) || empty($data['email']) || empty($data['username'])) {
            $error = "Todos los campos son obligatorios";
        } else {
            $usuario = new Usuario($data);
            $resultado = $usuario->registrar();
            
            switch ($resultado) {
                case 'registro_exitoso':
                    $_SESSION['registro_exitoso'] = true;
                    header('Location: index.php?c=auth&a=login&registro=exitoso');
                    exit();
                    
                case 'documento_existente':
                    $error = "La cédula/identificación ya está registrada";
                    break;
                    
                case 'email_existente':
                    $error = "El correo electrónico ya está registrado";
                    break;
                    
                case 'username_existente':
                    $error = "El nombre de usuario ya está en uso";
                    break;
                    
                case 'error_bd':
                    $error = "Error en la base de datos. Por favor intente más tarde";
                    break;
                    
                default:
                    $error = "Error al registrar. Por favor intente nuevamente";
            }
        }
    }
    
    include 'views/auth/register.php';
}
    public function recoverPassword() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $newPassword = $_POST['password'] ?? '';

            if (!empty($username) && !empty($newPassword)) {
                $pdo = Conexion::getConexion();

                // Primero verifica si existe el usuario
                $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username");
                $stmt->execute(['username' => $username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    // Actualiza la contraseña (encriptada)
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    $updateStmt = $pdo->prepare("UPDATE usuarios SET password = :password WHERE username = :username");
                    $updateStmt->execute([
                        'password' => $hashedPassword,
                        'username' => $username
                    ]);

                    $success = "Contraseña actualizada correctamente. Puedes iniciar sesión con tu nueva contraseña.";
                } else {
                    $error = "Usuario no encontrado.";
                }
            } else {
                $error = "Por favor, completa todos los campos.";
            }
        }

        include 'views/auth/recoverpassword.php';
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?c=auth&a=login');
        exit();
    }
}


