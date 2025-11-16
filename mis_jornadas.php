<?php
// api_cooperativa/mis_jornadas.php
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
    require_once __DIR__ . '/config/conexion.php';

    $jornadaModel = new JornadaModel($conexion);
    $ci = $_SESSION['ci'];

    // Obtener todas las jornadas del socio
    $jornadasRaw = $jornadaModel->obtenerPorSocio($ci);
    
    // Normalizar datos para el frontend
    $jornadas = array_map(function($jornada) {
        return [
            'id_jornada' => $jornada['id_jornada'],
            'ci_socio' => $jornada['ci_socio'],
            'fecha' => $jornada['fecha'],
            'horas' => $jornada['horas_trabajadas'],
            'descripcion' => $jornada['descripcion'],
            'tipo' => $jornada['tipo'] === 'trabajadas' ? 'Trabajadas' : 'No Cumplidas',
            'tipo_raw' => $jornada['tipo'],
            'estado' => ucfirst($jornada['estado']), // pendiente -> Pendiente
            'estado_raw' => $jornada['estado'],
            'verificado_por' => $jornada['verificado_por'] ?? null,
            'fecha_registro' => $jornada['fecha_registro']
        ];
    }, $jornadasRaw);
    
    // Calcular semana actual (lunes a sábado)
    $dia_semana = date('N'); // 1=lunes, 7=domingo
    $dias_hasta_lunes = ($dia_semana == 7) ? 6 : $dia_semana - 1;
    
    $fecha_lunes = date('Y-m-d', strtotime("-$dias_hasta_lunes days"));
    $fecha_sabado = date('Y-m-d', strtotime("+". (5 - $dias_hasta_lunes) ." days"));
    
    // Obtener resumen semanal
    $resumen_semanal = $jornadaModel->obtenerResumenSemanal($ci, $fecha_lunes, $fecha_sabado);

    echo json_encode([
        'success' => true,
        'jornadas' => $jornadas,
        'resumen_semanal' => $resumen_semanal,
        'semana_actual' => [
            'inicio' => $fecha_lunes,
            'fin' => $fecha_sabado
        ]
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>