<?php
class Usuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPorCI($ci) {
        $stmt = $this->conexion->prepare("SELECT * FROM solicitudes_ingreso WHERE ci = ?");
        $stmt->bind_param("s", $ci);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizar($ci, $datos) {
    $sql = "UPDATE solicitudes_ingreso 
            SET nombre_completo=?, gmail=?, genero=?, telefono_celular=?, telefono_fijo=?, direccion=?, cantidad_familia=?, discapacidad_cargo=?, ocupacion=?, ingreso=? 
            WHERE ci=?";
    $stmt = $this->conexion->prepare($sql);

    if (!$stmt) {
        die("Error en prepare: " . $this->conexion->error);
    }

    $stmt->bind_param("ssssssssssi",   // <- probar todos como strings para descartar
        $datos['nombre_completo'],
        $datos['gmail'],
        $datos['genero'],
        $datos['telefono_celular'],
        $datos['telefono_fijo'],
        $datos['direccion'],
        $datos['cantidad_familia'],
        $datos['discapacidad_cargo'],
        $datos['ocupacion'],
        $datos['ingreso'],
        $ci
    );

    if (!$stmt->execute()) {
        die("Error en execute: " . $stmt->error);
    }

    return true;
}
}
