<?php
require_once("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    //Lista los pendientes de pago desde la fecha mas reciente a la mas antigua
    $sql = "SELECT * FROM pagos WHERE estado = 'pendiente' ORDER BY fecha DESC";
    $result = $conexion->query($sql);

    $pagos = [];
    while ($row = $result->fetch_assoc()) {
        $pagos[] = $row;
    }

    header("Content-Type: application/json");
    echo json_encode($pagos);

} else {
    echo " Método no permitido.";
}
