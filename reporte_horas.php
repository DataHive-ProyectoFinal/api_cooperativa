<?php
header("Content-Type: application/json; charset=utf-8");
//CAMBIAR CONEXION CON BD
require_once '../../../union/api_usuarios/configuracion.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$base_de_datos;charset=utf8mb4", $usuario, $contrasena, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $yearActual = date("Y");
    $yearAnterior = $yearActual - 1;

    $stmt = $pdo->prepare("
        SELECT 
            YEAR(fecha) as year,
            WEEK(fecha, 1) as semana,   -- semana ISO (empieza lunes)
            MONTH(MIN(fecha)) as mes,   -- mes correspondiente a la primera fecha de esa semana
            SUM(horas_semanales) as total_horas
        FROM id_jornada
        WHERE YEAR(fecha) IN (:year1, :year2)
        GROUP BY YEAR(fecha), WEEK(fecha, 1)
        ORDER BY year DESC, semana ASC
    ");

    $stmt->execute([
        ':year1' => $yearActual,
        ':year2' => $yearAnterior
    ]);

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);

} catch (PDOException $e) {
    echo json_encode(['error' => 'DB error: '.$e->getMessage()]);
}
