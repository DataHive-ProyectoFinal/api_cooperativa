<?php
// api_cooperativa/mis_pagos.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

try {
    if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'socio') {
        throw new Exception("Debe iniciar sesión como socio.");
    }

    require_once __DIR__ . '/../shared/modelo/PagoModel.php';
    require_once __DIR__ . '/config/conexion.php';

    $pagoModel = new PagoModel($conexion);
    $ci = $_SESSION['ci'];

    // Obtener todos los pagos del socio
    $pagosRaw = $pagoModel->obtenerPorSocio($ci);
    
    // Normalizar datos para el frontend
    $pagos = array_map(function($pago) {
        // Normalizar estado
        $estado_normalizado = $pago['estado'];
        if ($estado_normalizado === 'sin_comprobante') {
            $estado_normalizado = 'Sin_comprobante';
        } else {
            $estado_normalizado = ucfirst($estado_normalizado);
        }
        
        return [
            'id_pago' => $pago['id_pago'],
            'ci_socio' => $pago['ci_socio'],
            'tipo' => ucfirst($pago['tipo_pago']), // inicial -> Inicial
            'tipo_pago' => $pago['tipo_pago'], 
            'monto' => $pago['monto'],
            'fecha_pago' => $pago['fecha_pago'],
            'fecha_subida' => $pago['fecha_registro'],
            'comprobante' => $pago['comprobante'],
            'descripcion' => $pago['descripcion'],
            'estado' => $estado_normalizado,
            'estado_raw' => $pago['estado'],
            'motivo_rechazo' => $pago['motivo_rechazo'] ?? null,
            'observaciones_admin' => $pago['observaciones_admin'] ?? null,
            'notificacion_leida' => $pago['notificacion_leida']
        ];
    }, $pagosRaw);
    
    // Obtener notificaciones no leídas
    $notificaciones = $pagoModel->obtenerNotificaciones($ci);

    echo json_encode([
        'success' => true,
        'pagos' => $pagos,
        'notificaciones' => $notificaciones,
        'total_notificaciones' => count($notificaciones)
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>