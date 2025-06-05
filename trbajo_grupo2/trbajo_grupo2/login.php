<?php
session_start();

// Si el usuario ya está logueado, redirigir
if(isset($_SESSION['nombre_usuario'])) {
    header('location: index.html');
    exit();
}

$mensaje = '';
$error = '';

// Mostrar mensaje de registro exitoso
if (isset($_SESSION['mensaje_exito'])) {
    $mensaje = $_SESSION['mensaje_exito'];
    unset($_SESSION['mensaje_exito']);
}

// Procesar login cuando se envía el formulario
if(isset($_POST['btningresar'])) {
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "tienda_electronica";
    
    $conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);
    
    // Verificar conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
    
    // Obtener y sanitizar datos del formulario
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    
    if (!empty($username) && !empty($password)) {
        // Buscar el usuario en la base de datos
        $stmt = $conexion->prepare("SELECT id_usuario, nombre_completo_usu, correo_usuario, nombre_usuario, contraseña_usuario FROM registro_usuario WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verificar la contraseña
            if (password_verify($password, $user['contraseña_usuario'])) {
                // Login exitoso - crear sesión
                $_SESSION['id_usuario'] = $user['id_usuario'];
                $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
                $_SESSION['nombre_completo'] = $user['nombre_completo_usu'];
                $_SESSION['correo_usuario'] = $user['correo_usuario'];
                
                // Redirigir a la página principal
                header('Location: index.html');
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
        
        $stmt->close();
    } else {
        $error = "Por favor, complete todos los campos.";
    }
    
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tienda de Electrónicos</title>
    <link rel="stylesheet" href="stilo.css">
</head>
<body>
    <ul class="logotipo">
        <div class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/5214/5214141.png" alt="TechStore Logo">
        </div>
    </ul>
    
    <div class="login-container">
        <div class="login-box">
            <h2>Iniciar Sesión</h2>
            
            <?php if ($mensaje): ?>
                <div class="mensaje-exito" style="color: green; margin-bottom: 15px; padding: 10px; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px;">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="mensaje-error" style="color: red; margin-bottom: 15px; padding: 10px; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="input-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <p class="Registro-link">¿No tienes una cuenta? <a href="registro_usuario.html">Crear cuenta.</a></p>
                <br>
                <button type="submit" name="btningresar" value="Ingresar">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>