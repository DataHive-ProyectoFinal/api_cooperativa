<?php
// api_cooperativa/cambiar_contrasena.php
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
    $contrasena_actual = $_POST['contrasena_actual'] ?? '';
    $nueva_contrasena = $_POST['nueva_contrasena'] ?? '';
    $confirmar_contrasena = $_POST['confirmar_contrasena'] ?? '';

    // Validaciones
    if (empty($contrasena_actual) || empty($nueva_contrasena) || empty($confirmar_contrasena)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    if ($nueva_contrasena !== $confirmar_contrasena) {
        throw new Exception("Las contraseñas nuevas no coinciden.");
    }

    if (strlen($nueva_contrasena) < 6) {
        throw new Exception("La nueva contraseña debe tener al menos 6 caracteres.");
    }

    // Verificar contraseña actual
    $sql = "SELECT contrasena FROM socios WHERE ci = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $ci);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows === 0) {
        throw new Exception("Socio no encontrado.");
    }
    
    $socio = $resultado->fetch_assoc();
    
    if (!password_verify($contrasena_actual, $socio['contrasena'])) {
        throw new Exception("La contraseña actual es incorrecta.");
    }

    // Actualizar contraseña
    $nueva_contrasena_hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
    
    $sql_update = "UPDATE socios SET contrasena = ? WHERE ci = ?";
    $stmt_update = $conexion->prepare($sql_update);
    $stmt_update->bind_param("si", $nueva_contrasena_hash, $ci);
    
    if (!$stmt_update->execute()) {
        throw new Exception("Error al actualizar la contraseña.");
    }

    echo json_encode([
        'success' => true,
        'message' => 'Contraseña actualizada correctamente.'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>