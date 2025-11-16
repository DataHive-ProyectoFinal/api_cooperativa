<?php
// api_cooperativa/dashboard_stats.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

try {
    if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'socio') {
        throw new Exception("Debe iniciar sesión como socio.");
    }

    require_once __DIR__ . '/../shared/modelo/JornadaModel.php';
    require_once __DIR__ . '/../shared/modelo/PagoModel.php';
    require_once __DIR__ . '/config/conexion.php';
     $ci = $_SESSION['ci'];
    $jornadaModel = new JornadaModel($conexion);
    $pagoModel = new PagoModel($conexion);

    // Obtener TODAS las jornadas históricas
    $todasJornadas = $jornadaModel->obtenerPorSocio($ci);
    
    // Calcular total de horas trabajadas aprobadas (HISTÓRICAS)
    $horasAprobadas = 0;
    foreach ($todasJornadas as $jornada) {
        if ($jornada['estado'] === 'aprobada' && $jornada['tipo'] === 'trabajadas') {
            $horasAprobadas += floatval($jornada['horas_trabajadas']);
        }
    }
    
    // Contar pagos pendientes
    $todosPagos = $pagoModel->obtenerPorSocio($ci);
    $pagosPendientes = 0;
    foreach ($todosPagos as $pago) {
        if ($pago['estado'] === 'pendiente' || $pago['estado'] === 'sin_comprobante') {
            $pagosPendientes++;
        }
    }

    echo json_encode([
        'success' => true,
        'horas_historicas_aprobadas' => round($horasAprobadas, 1),
        'pagos_pendientes' => $pagosPendientes
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>