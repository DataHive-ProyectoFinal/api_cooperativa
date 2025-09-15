<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['ci'])) {
    header("Location: login.php");
    exit;
}

$ci = $_SESSION['ci'];

// Recibir datos
$telefono_fijo = $_POST['telefono_fijo'] ?? '';
$telefono_celular = $_POST['telefono_celular'] ?? '';
$genero = $_POST['genero'] ?? '';
$contrasena = $_POST['contrasena'] ?? null;

if (!empty($contrasena)) {
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $stmt = $conexion->prepare("UPDATE socios SET telefono_fijo=?, telefono_celular=?, genero=?, contrasena=? WHERE ci=?");
    $stmt->bind_param("sssss", $telefono_fijo, $telefono_celular, $genero, $hash, $ci);
} else {
    $stmt = $conexion->prepare("UPDATE socios SET telefono_fijo=?, telefono_celular=?, genero=? WHERE ci=?");
    $stmt->bind_param("ssss", $telefono_fijo, $telefono_celular, $genero, $ci);
}

$stmt->execute();

header("Location: perfil.php");
exit;
?>
