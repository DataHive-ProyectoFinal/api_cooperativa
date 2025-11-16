<?php
// api_cooperativa/registrar_horas_no_cumplidas.php
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

    require_once __DIR__ . '/../shared/modelo/JornadaModel.php';
    require_once __DIR__ . '/config/conexion.php';

    $ci_socio = $_SESSION['ci'];
    $fecha = $_POST['fecha'] ?? null;
    $horas = $_POST['horas'] ?? null;
    $motivo = trim($_POST['motivo'] ?? '');

    // Validaciones
    if (empty($fecha) || empty($horas) || empty($motivo)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    if ($horas < 0.5) {
        throw new Exception("Las horas deben ser al menos 0.5.");
    }

    // Validar que la fecha no sea futura
    if (strtotime($fecha) > time()) {
        throw new Exception("No se pueden registrar horas no cumplidas futuras.");
    }

    $jornadaModel = new JornadaModel($conexion);
    $resultado = $jornadaModel->crearNoCumplida($ci_socio, $fecha, $horas, $motivo);

    echo json_encode([
        'success' => true,
        'message' => 'Horas no cumplidas registradas. Se ha generado un pago compensatorio.',
        'id_jornada' => $resultado['id_jornada'],
        'id_pago' => $resultado['id_pago'],
        'pago_compensatorio' => number_format($resultado['monto'], 2)
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>