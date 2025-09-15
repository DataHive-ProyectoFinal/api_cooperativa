<?php
require_once("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_pago = $_POST["id_pago"] ?? null;
    $estado = $_POST["estado"] ?? null;

    if ($id_pago && $estado) {
        $stmt = $conexion->prepare("UPDATE pagos SET estado = ? WHERE id_pago = ?");
        $stmt->bind_param("si", $estado, $id_pago);

        if ($stmt->execute()) {
            echo " Estado actualizado a $estado";
        } else {
            echo " Error al actualizar estado";
        }
    } else {
        echo " Datos incompletos";
    }
} else {
    echo " Método no permitido";
}
