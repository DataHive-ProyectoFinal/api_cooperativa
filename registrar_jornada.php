<?php
// api_cooperativa/registrar_jornada.php
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
    $descripcion = trim($_POST['descripcion'] ?? '');

    // Validaciones
    if (empty($fecha) || empty($horas) || empty($descripcion)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    if ($horas < 0.5 || $horas > 12) {
        throw new Exception("Las horas deben estar entre 0.5 y 12.");
    }

    // Validar que la fecha no sea futura
    if (strtotime($fecha) > time()) {
        throw new Exception("No se pueden registrar jornadas futuras.");
    }

    $jornadaModel = new JornadaModel($conexion);
    $id_jornada = $jornadaModel->crearTrabajada($ci_socio, $fecha, $horas, $descripcion);

    echo json_encode([
        'success' => true,
        'message' => 'Jornada registrada correctamente. Espera la aprobación del administrador.',
        'id_jornada' => $id_jornada
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>