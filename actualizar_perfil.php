<?php
// api_cooperativa/actualizar_perfil.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

try {
    if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'socio') {
        throw new Exception("Debe iniciar sesión como socio.");
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método no permitido.");
    }

    require_once __DIR__ . '/config/conexion.php';

    $ci = $_SESSION['ci'];
    $gmail = trim($_POST['gmail'] ?? '');
    $telefono = trim($_POST['telefono_celular'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');

    // Validaciones
    if (empty($gmail) || empty($telefono) || empty($direccion)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Validar formato de email
    if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("El formato del email no es válido.");
    }

    // Validar que el teléfono tenga al menos 8 dígitos
    if (strlen($telefono) < 8) {
        throw new Exception("El teléfono debe tener al menos 8 dígitos.");
    }

    // Actualizar datos
    $sql = "UPDATE socios SET 
            gmail = ?,
            telefono_celular = ?,
            direccion = ?
            WHERE ci = ?";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $gmail, $telefono, $direccion, $ci);
    
    if (!$stmt->execute()) {
        throw new Exception("Error al actualizar el perfil.");
    }

    echo json_encode([
        'success' => true,
        'message' => 'Perfil actualizado correctamente.'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>