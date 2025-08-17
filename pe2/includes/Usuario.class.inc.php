<?php
require_once("datosObject.class.inc.php");

class Usuario extends DataObject {
    protected $datos = array(
        "id" => "",
        "nombre_completo" => "",
        "email" => "",
        "nombre_usuario" => "",
        "password" => "",
        "genero" => "",
        "intereses" => "",
        "actividad_inscrita" => "",
        "desea_newsletter" => "",
        "plan" => "",
        "tipo" => ""
    );

    public static function insertar($datos) {
        $conexion = parent::conectar();

        $sql = "INSERT INTO " . TABLA_USUARIOS . "
            (nombre_completo, email, nombre_usuario, password, genero, intereses,
            actividad_inscrita, desea_newsletter, plan, tipo)
            VALUES (:nombre, :email, :usuario, :password, :genero, :intereses, :actividad, :newsletter, :plan, :tipo)";

        try {
            $stmt = $conexion->prepare($sql);
            $stmt->bindValue(":nombre", $datos["nombre_completo"]);
            $stmt->bindValue(":email", $datos["email"]);
            $stmt->bindValue(":usuario", $datos["nombre_usuario"]);
            $stmt->bindValue(":password", $datos["password"]);
            $stmt->bindValue(":genero", $datos["genero"]);
            $stmt->bindValue(":intereses", $datos["intereses"]);
            $stmt->bindValue(":actividad", $datos["actividad_inscrita"]);
            $stmt->bindValue(":newsletter", $datos["desea_newsletter"], PDO::PARAM_BOOL);
            $stmt->bindValue(":plan", $datos["plan"]);
            $stmt->bindValue(":tipo", $datos["tipo"]);

            $stmt->execute();

        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), 'Duplicate')) {
                throw new Exception("El nombre de usuario o el correo ya están registrados.");
            } else {
                throw new Exception("Error al registrar el usuario: " . $e->getMessage());
            }
        } finally {
            parent::desconectar($conexion);
        }
    }
    

    public static function obtenerPorNombreUsuario($nombre_usuario) {
        $conexion = parent::conectar();
        $sql = "SELECT * FROM " . TABLA_USUARIOS . " WHERE nombre_usuario = :usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":usuario", $nombre_usuario);
        $stmt->execute();
        $fila = $stmt->fetch();
       
        parent::desconectar($conexion);
        return $fila ? new Usuario($fila) : null;
    }

    public static function obtenerTodos() {
        $conexion = parent::conectar();
        $stmt = $conexion->query("SELECT * FROM " . TABLA_USUARIOS);
        $usuarios = array();
        foreach ($stmt->fetchAll() as $fila) {
            $usuarios[] = new Usuario($fila);
        }
        
        parent::desconectar($conexion);
        return $usuarios;
    }
    
    public static function actualizar($id, $datos) {
        $conexion = parent::conectar();
        $sql = "UPDATE " . TABLA_USUARIOS . " SET 
                nombre_completo = :nombre,
                email = :email,
                nombre_usuario = :usuario,
                genero = :genero,
                intereses = :intereses,
                actividad_inscrita = :actividad,
                desea_newsletter = :newsletter,
                plan = :plan,
                tipo = :tipo
                WHERE id = :id";

        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":nombre", $datos["nombre_completo"]);
        $stmt->bindValue(":email", $datos["email"]);
        $stmt->bindValue(":usuario", $datos["nombre_usuario"]);
        $stmt->bindValue(":genero", $datos["genero"]);
        $stmt->bindValue(":intereses", $datos["intereses"]);
        $stmt->bindValue(":actividad", $datos["actividad_inscrita"]);
        $stmt->bindValue(":newsletter", $datos["desea_newsletter"], PDO::PARAM_BOOL);
        $stmt->bindValue(":plan", $datos["plan"]);
        $stmt->bindValue(":tipo", $datos["tipo"]);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        parent::desconectar($conexion);
    }

    public static function eliminar($id) {
        $conexion = parent::conectar();
        $stmt = $conexion->prepare("DELETE FROM " . TABLA_USUARIOS . " WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        parent::desconectar($conexion);
    }
}
?>