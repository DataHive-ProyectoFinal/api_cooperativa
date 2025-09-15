<?php
require_once("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ci_usuario = $_POST["ci_usuario"] ?? '';
    $monto = $_POST["monto"] ?? '';
    $tipo = $_POST["tipo"] ?? '';

    // Manejo del archivo comprobante
    if (isset($_FILES["comprobante"]) && $_FILES["comprobante"]["error"] === UPLOAD_ERR_OK) {
        $directorio = "../comprobantes/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $nombreArchivo = time() . "_" . basename($_FILES["comprobante"]["name"]);
        $rutaArchivo = $directorio . $nombreArchivo;

        if (move_uploaded_file($_FILES["comprobante"]["tmp_name"], $rutaArchivo)) {
            // Guardar en BD (ruta relativa para frontend)
            $rutaDB = "comprobantes/" . $nombreArchivo;

            $sql = "INSERT INTO pagos (ci_usuario, monto, tipo, comprobante) VALUES (?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("sdss", $ci_usuario, $monto, $tipo, $rutaDB);
                if ($stmt->execute()) {
                    echo "Pago registrador Correctamente";
                   // echo "Pago registrado correctamente.";
                } else {
                    echo "Error al registrar pago: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error en la consulta: " . $conexion->error;
            }
        } else {
            echo "Error al subir el comprobante.";
        }
    } else {
        echo "No se subió ningún comprobante.";
    }
} else {
    echo "Método no permitido.";
}
