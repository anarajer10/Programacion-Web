<?php
require_once("datosObject.class.inc.php");

class Actividad extends DataObject {
    protected $datos = array(
        "id" => "",
        "titulo" => "",
        "descripcion" => "",
        "imagen" => "",
        "categoria" => "",
        "imagen_detalle" => ""
    );

    public static function insertar($datos) {
        $conexion = parent::conectar();

        $sql = "INSERT INTO " . TABLA_ACTIVIDADES . " 
                (titulo, descripcion, imagen, categoria, imagen_detalle) 
                VALUES (:titulo, :descripcion, :imagen, :categoria, :imagen_detalle)";

        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":titulo", $datos["titulo"]);
        $stmt->bindValue(":descripcion", $datos["descripcion"]);
        $stmt->bindValue(":imagen", $datos["imagen"]);
        $stmt->bindValue(":categoria", $datos["categoria"]);
        $stmt->bindValue(":imagen_detalle", $datos["imagen_detalle"]);
        $stmt->execute();

        parent::desconectar($conexion);
    }

    public static function existeActividad($titulo){
        $conexion = parent::conectar();

        $sql = "SELECT COUNT(*) FROM " . TABLA_ACTIVIDADES . "WHERE titulo = :titulo";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":titulo", $titulo);
        $stmt->execute();
        $existe = $stmt->fetchColumn() > 0;

        parent::desconectar($conexion);
        return $existe;
    }

    public static function obtenerCategorias() {
        $conexion = parent::conectar();

        $sql = "SELECT DISTINCT categoria FROM " . TABLA_ACTIVIDADES . " ORDER BY categoria";
        $stmt = $conexion->query($sql);
        $categorias = $stmt->fetchAll(PDO::FETCH_COLUMN);

        parent::desconectar($conexion);
        return $categorias;
    }

    public static function obtenerPorCategoria($categoria) {
        $conexion = parent::conectar();

        $sql = "SELECT * FROM " . TABLA_ACTIVIDADES . " WHERE categoria = :categoria ORDER BY titulo";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":categoria", $categoria);
        $stmt->execute();
        $actividades = [];
        foreach ($stmt->fetchAll() as $fila) {
            $actividades[] = new Actividad($fila);
        }

        parent::desconectar($conexion);
        return $actividades;
    }

    public static function obtenerPorId($id) {
        $conexion = parent::conectar();

        $sql = "SELECT * FROM " . TABLA_ACTIVIDADES . " WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fila = $stmt->fetch();

        parent::desconectar($conexion);
        return $fila ? new Actividad($fila) : null;
    }

    public static function obtenerTodas() {
        $conexion = parent::conectar();

        $stmt = $conexion->query("SELECT * FROM " . TABLA_ACTIVIDADES);
        $actividades = array();
        foreach ($stmt->fetchAll() as $fila) {
            $actividades[] = new Actividad($fila);
        }

        parent::desconectar($conexion);
        return $actividades;
    }

    public static function obtenerPaginadas($inicio, $cantidad){
        $conexion = parent::conectar();

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_ACTIVIDADES . 
                " ORDER BY titulo LIMIT :inicio, :cantidad";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":inicio", $inicio, PDO::PARAM_INT);
        $stmt->bindValue(":cantidad", $cantidad, PDO::PARAM_INT);
        $stmt->execute();

        $actividades = [];
        foreach($stmt->fetchAll() as $fila){
            $actividades[] = new Actividad($fila);
        }

        $totalStmt = $conexion->query("SELECT FOUND_ROWS() as total");
        $total = $totalStmt->fetch()["total"];

        parent::desconectar($conexion);
        return [$actividades, $total];
    }

    public static function obtenerPorCategoriaPaginadas($categoria, $inicio, $cantidad) {
        $conexion = parent::conectar();

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_ACTIVIDADES . 
            " WHERE categoria = :categoria ORDER BY titulo LIMIT :inicio, :cantidad";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":categoria", $categoria, PDO::PARAM_STR);
        $stmt->bindValue(":inicio", $inicio, PDO::PARAM_INT);
        $stmt->bindValue(":cantidad", $cantidad, PDO::PARAM_INT);
        $stmt->execute();

        $actividades = [];
        foreach($stmt->fetchAll() as $fila){
            $actividades[] = new Actividad($fila);
        }

        $totalStmt = $conexion->query("SELECT FOUND_ROWS() as total");
        $total = $totalStmt->fetch()["total"];

        parent::desconectar($conexion);
        return [$actividades, $total];
    }


    public static function actualizar($id, $datos) {
        $conexion = parent::conectar();

        $sql = "UPDATE " . TABLA_ACTIVIDADES . " SET 
                titulo = :titulo,
                descripcion = :descripcion,
                imagen = :imagen,
                categoria = :categoria,
                imagen_detalle = :imagen_detalle
                WHERE id = :id";

        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":titulo", $datos["titulo"]);
        $stmt->bindValue(":descripcion", $datos["descripcion"]);
        $stmt->bindValue(":imagen", $datos["imagen"]);
        $stmt->bindValue(":categoria", $datos["categoria"]);
        $stmt->bindValue(":imagen_detalle", $datos["imagen_detalle"]);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        parent::desconectar($conexion);
    }

    public static function eliminar($id) {
        $conexion = parent::conectar();

        $stmt = $conexion->prepare("DELETE FROM " . TABLA_ACTIVIDADES . " WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        parent::desconectar($conexion);
    }
}
?>