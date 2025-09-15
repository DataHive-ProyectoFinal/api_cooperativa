<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json; charset=utf-8");
//CAMBIAR CONEXION CON BD
require_once 'configuracion.php';

$messages = [];
$jornadas = [];

$pdo = new PDO("mysql:host=$host;dbname=$base_de_datos;charset=utf8mb4", $usuario, $contrasena, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// Verificar jornada individual
if (isset($_GET['verificar_id'])) {
    $id = intval($_GET['verificar_id']);
    $stmt = $pdo->prepare("UPDATE id_jornada SET verificado = 1 WHERE id = :id");
    $stmt->execute([':id'=>$id]);
    $messages[] = ['type'=>'success','text'=>"Jornada $id verificada correctamente."];
    echo json_encode(['messages'=>$messages]);
    exit;
}

// Buscar jornadas por ci_usuario
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['ci_usuario'])) {
    $ci = trim($_POST['ci_usuario']);
    $stmt = $pdo->prepare("SELECT * FROM id_jornada WHERE ci_usuario=:ci_usuario ORDER BY fecha ASC");
    $stmt->execute([':ci_usuario'=>$ci]);
    $jornadas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$jornadas) {
        $messages[] = ['type'=>'error','text'=>'No se encontraron jornadas para este usuario.'];
    }

    echo json_encode(['messages'=>$messages, 'jornadas'=>$jornadas]);
    exit;
}
?>
