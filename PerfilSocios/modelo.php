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
                SET nombre_completo=?, gmail=?, genero=?, telefono_celular=?, telefono_fijo=?, direccion=?, cantidad_familia=?, discapacidad_cargo=?, ocupacion=?, ingreso_mensual=? 
                WHERE ci=?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssssssissss",
            $datos['nombre_completo'],
            $datos['gmail'],
            $datos['genero'],
            $datos['telefono_celular'],
            $datos['telefono_fijo'],
            $datos['direccion'],
            $datos['cantidad_familia'],
            $datos['discapacidad_cargo'],
            $datos['ocupacion'],
            $datos['ingreso_mensual'],
            $ci
        );
        return $stmt->execute();
    }
}
