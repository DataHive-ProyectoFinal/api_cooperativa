<?php         
require_once __DIR__ . '/controllers/UsuarioController.php';

// Crear conexión
$conexion = new mysqli('localhost', 'root', '', 'cooperativa');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Crear el controlador
$controller = new UsuarioController($conexion);

// Ejecutar guardarPerfil 
$controller->guardarPerfil();
