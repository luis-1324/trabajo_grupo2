<?php
$servidor = "localhost"; // o la IP de tu servidor
$usuario = "tu_usuario";
$contrasena = "tu_contraseña";
$base_datos = "tienda_virtual";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>