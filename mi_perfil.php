<?php
// api_cooperativa/mi_perfil.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

try {
    if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'socio') {
        throw new Exception("Debe iniciar sesión como socio.");
    }

    require_once __DIR__ . '/../api_usuarios/modelo/SocioModel.php';
    require_once __DIR__ . '/config/conexion.php';

    $socioModel = new SocioModel($conexion);
    $ci = $_SESSION['ci'];

    $perfil = $socioModel->obtenerPorCI($ci);

    if (!$perfil) {
        throw new Exception("No se encontró el perfil del socio.");
    }

    // No enviar la contraseña
    unset($perfil['contrasena']);

    // Renombrar campos para el frontend
    $perfil['email'] = $perfil['gmail'];
    $perfil['telefono'] = $perfil['telefono_celular'];
    $perfil['fecha_registro'] = $perfil['fecha_ingreso'];

    echo json_encode([
        'success' => true,
        'perfil' => $perfil
    ]);

} catch (Exception $e) {
    error_log(" Error en mi_perfil: " . $e->getMessage());
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>