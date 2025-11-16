<?php
// api_cooperativa/controlador/modelo/marcar_notificacion_leida.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

try {
    if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'socio') {
        throw new Exception("Debe iniciar sesión como socio.");
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método no permitido.");
    }

    require_once __DIR__ . '/../../../shared/modelo/PagoModel.php';
    require_once __DIR__ . '/../../config/conexion.php';

    $id_pago = $_POST['id_pago'] ?? null;
    $ci = $_SESSION['ci'];

    if (!$id_pago) {
        throw new Exception("ID de pago no proporcionado.");
    }

    $pagoModel = new PagoModel($conexion);
    $pagoModel->marcarNotificacionLeida($id_pago, $ci);

    echo json_encode([
        'success' => true,
        'message' => 'Notificación marcada como leída'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>