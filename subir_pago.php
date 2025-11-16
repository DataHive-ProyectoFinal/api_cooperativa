<?php
// api_cooperativa/subir_pago.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');

try {
    if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'socio') {
        throw new Exception("Debe iniciar sesión como socio.");
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método no permitido.");
    }

    require_once __DIR__ . '/../shared/modelo/PagoModel.php';
    require_once __DIR__ . '/config/conexion.php';

    $ci_socio = $_SESSION['ci'];
    $id_pago_actualizar = $_POST['id_pago_actualizar'] ?? null;

    $pagoModel = new PagoModel($conexion);

    // Manejo del archivo
    $comprobante = null;
    if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] === UPLOAD_ERR_OK) {
        $archivo = $_FILES['comprobante'];
        $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'pdf'];

        if (!in_array($extension, $extensiones_permitidas)) {
            throw new Exception("Formato de archivo no permitido. Use JPG, PNG o PDF.");
        }

        if ($archivo['size'] > 5 * 1024 * 1024) {
            throw new Exception("El archivo es demasiado grande. Máximo 5MB.");
        }

        $nombre_archivo = 'comprobante_' . $ci_socio . '_' . time() . '.' . $extension;
        $ruta_uploads = __DIR__ . '/../uploads/comprobantes/';
        
        if (!is_dir($ruta_uploads)) {
            mkdir($ruta_uploads, 0777, true);
        }
        
        $ruta_destino = $ruta_uploads . $nombre_archivo;

        if (!move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
            throw new Exception("Error al subir el archivo.");
        }

        $comprobante = $nombre_archivo;
    }

    // Si es una actualización de un pago sin comprobante
    if ($id_pago_actualizar) {
        if (!$comprobante) {
            throw new Exception("Debe subir un comprobante.");
        }

        if (!$pagoModel->actualizarComprobante($id_pago_actualizar, $ci_socio, $comprobante)) {
            throw new Exception("Error al actualizar el comprobante.");
        }
        
        echo json_encode([
            'success' => true,
            'message' => 'Comprobante actualizado correctamente. Será revisado por un administrador.'
        ]);
        
    } else {
        // Crear nuevo pago - AHORA SÍ validar campos
        $tipo_pago = $_POST['tipo_pago'] ?? null;
        $monto = $_POST['monto'] ?? null;
        $fecha_pago = $_POST['fecha_pago'] ?? null;
        $descripcion = $_POST['descripcion'] ?? '';

        // Validaciones
        if (empty($tipo_pago) || empty($monto) || empty($fecha_pago)) {
            throw new Exception("Debe completar todos los campos obligatorios.");
        }

        if (!in_array($tipo_pago, ['mensual', 'compensatorio'])) {
            throw new Exception("Tipo de pago no válido.");
        }

        if (!$comprobante) {
            throw new Exception("Debe subir un comprobante.");
        }

        $id_pago = $pagoModel->crear($ci_socio, $tipo_pago, $monto, $fecha_pago, $comprobante, $descripcion);

        echo json_encode([
            'success' => true,
            'message' => 'Pago subido correctamente. Será revisado por un administrador.',
            'id_pago' => $id_pago
        ]);
    }

} catch (Exception $e) {
    http_response_count(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>