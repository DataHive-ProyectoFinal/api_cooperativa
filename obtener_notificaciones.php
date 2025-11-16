<?php
// api_cooperativa/obtener_notificaciones.php
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

    require_once __DIR__ . '/../shared/modelo/PagoModel.php';
    require_once __DIR__ . '/config/conexion.php';

    $pagoModel = new PagoModel($conexion);
    $ci = $_SESSION['ci'];

    $notificaciones = $pagoModel->obtenerNotificaciones($ci);

    echo json_encode([
        'success' => true,
        'notificaciones' => $notificaciones
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>