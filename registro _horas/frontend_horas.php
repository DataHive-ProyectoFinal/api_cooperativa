<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json; charset=utf-8");
require_once 'configuracion.php';

$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mes = isset($_POST['mes']) ? intval($_POST['mes']) : null;
    $dia = isset($_POST['dia']) ? intval($_POST['dia']) : null;
    $year = isset($_POST['year']) ? intval($_POST['year']) : intval(date('Y'));
    $horas = isset($_POST['horas']) ? trim($_POST['horas']) : '';
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : null;
    $weekday_user = $_POST['weekday'] ?? null;

    // Validaciones...
    if (!$mes || $mes < 1 || $mes > 12) {
        $messages[] = ['type'=>'error','text'=>'Mes inválido.'];
    }
    if (!$dia || $dia < 1 || $dia > 31) {
        $messages[] = ['type'=>'error','text'=>'Día inválido.'];
    }
    if (!is_numeric($horas) || floatval($horas) < 0 || floatval($horas) > 24) {
        $messages[] = ['type'=>'error','text'=>'Horas inválidas (0-24).'];
    }

    if (empty($messages) && !checkdate($mes, $dia, $year)) {
        $messages[] = ['type'=>'error','text'=>'La fecha no existe.'];
    }

    if (empty($messages)) {
        $fecha_str = sprintf('%04d-%02d-%02d', $year, $mes, $dia);

        // validar weekday
        if ($weekday_user) {
            $weekdays_es = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
            $ts = strtotime($fecha_str);
            $weekday_calc = $weekdays_es[intval(date('w', $ts))];
            if ($weekday_calc !== $weekday_user) {
                $messages[] = ['type'=>'error','text'=>"El día de la semana no coincide ($weekday_calc)."];
            }
        }
    }

    if (empty($messages)) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$base_de_datos;charset=utf8mb4", $usuario, $contrasena, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            $stmtCheck = $pdo->prepare('SELECT id FROM id_jornada WHERE fecha = :fecha LIMIT 1');
            $stmtCheck->execute([':fecha' => $fecha_str]);
            if ($stmtCheck->fetch()) {
                $messages[] = ['type'=>'error','text'=>'Ya existe un registro para esa fecha.'];
            } else {
                $stmt = $pdo->prepare('INSERT INTO id_jornada (horas_semanales, mes, dia, descripcion, fecha) VALUES (:horas, :mes, :dia, :descripcion, :fecha)');
                $stmt->execute([
                    ':horas' => floatval($horas),
                    ':mes' => $mes,
                    ':dia' => $dia,
                    ':descripcion' => $descripcion,
                    ':fecha' => $fecha_str,
                ]);
                $messages[] = ['type'=>'success','text'=>'Registro guardado correctamente.'];
            }
        } catch (PDOException $e) {
            $messages[] = ['type'=>'error','text'=>'Error de base de datos: '.$e->getMessage()];
        }
    }
}

echo json_encode($messages);
?>