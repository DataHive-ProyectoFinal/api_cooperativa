<?php
session_start();
require_once 'conexion.php';

// Verificar login
if (!isset($_SESSION['ci']) || $_SESSION['rol'] !== 'socio') {
    header("Location: login.php");
    exit;
}

$ci = $_SESSION['ci'];

// Buscar datos del socio
$stmt = $conexion->prepare("SELECT ci, nombre, gmail, telefono_fijo, telefono_celular, genero, contrasena FROM socios WHERE ci = ?");
$stmt->bind_param("s", $ci);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

// Inyectar datos en el HTML
include 'perfil.html';
?>
