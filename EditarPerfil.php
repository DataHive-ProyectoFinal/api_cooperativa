<?php
require_once __DIR__ . '/controllers/UsuarioController.php';
$controller = new UsuarioController($conexion);
$controller->verPerfil();
