<?php
session_start();
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct($conexion) {
        $this->usuarioModel = new Usuario($conexion);
    }

    public function verPerfil() {
        if (!isset($_SESSION['ci'])) {
            header("Location: /PruebaProyecto2/api_usuarios/login.php");
            exit();
        }
        $ci = $_SESSION['ci'];
        $usuario = $this->usuarioModel->obtenerPorCI($ci);
        include __DIR__ . '/../views/usuario/verPerfil.php';
    }

    public function editarPerfil() {
        if (!isset($_SESSION['ci'])) {
            header("Location: /PruebaProyecto2/api_usuarios/login.php");
            exit();
        }
        $ci = $_SESSION['ci'];
        $usuario = $this->usuarioModel->obtenerPorCI($ci);
        include __DIR__ . '/../views/usuario/editarPerfil.php';
    }

    public function guardarPerfil() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['ci'])) {
            $ci = $_SESSION['ci'];
            $this->usuarioModel->actualizar($ci, $_POST);
            header("Location: /PruebaProyecto2/api_usuarios/VerPerfil.php");
            exit();
        }
    }
}
