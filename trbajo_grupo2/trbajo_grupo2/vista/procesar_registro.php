<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "tienda_electronica"; 


$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar datos
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validaciones básicas
    $errores = [];
    
    if ($password !== $confirm_password) {
        $errores[] = "Las contraseñas no coinciden";
    }
    
    if (strlen($password) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres";
    }
    
    // Verificar si el email o usuario ya existen
    // Usar los nombres de campos correctos de tu tabla
    $stmt = $conexion->prepare("SELECT id_usuario FROM registro_usuario WHERE correo_usuario = ? OR nombre_usuario = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $errores[] = "El email o nombre de usuario ya están registrados";
    }
    $stmt->close();
    
    // Si no hay errores, proceder con el registro
    if (empty($errores)) {
        // Hash de la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertar en la base de datos usando los nombres de campos correctos
        $stmt = $conexion->prepare("INSERT INTO registro_usuario (nombre_completo_usu, correo_usuario, nombre_usuario, contraseña_usuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $email, $username, $hashed_password);
        
        if ($stmt->execute()) {
            // Registro exitoso
            header("Location: login.html");
            exit();
        } else {
            $errores[] = "Error al registrar el usuario: " . $conexion->error;
        }
        $stmt->close();
    }
    
    
    if (!empty($errores)) {
        session_start();
        $_SESSION['errores'] = $errores;
        $_SESSION['datos_formulario'] = $_POST;
        header("Location: registro_usuario.html"); 
        exit();
    }
}

$conexion->close();
?>