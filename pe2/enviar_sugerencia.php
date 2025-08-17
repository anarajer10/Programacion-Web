<?php
require_once("includes/datosObject.class.inc.php");
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nombre = trim($_POST["nombre"] ?? '');
    $mensaje = trim($_POST["sugerencia"] ?? '');
    $estrellas = intval($_POST["estrellas"] ?? 0);
    $nombre_usuario = $_SESSION["usuario"] ?? null; //vacío si no hay sesión

    if($nombre === "" || $mensaje === "" || $estrellas < 1 || $estrellas > 5){
        die("Datos introducidos erróneamente. Vuelva a intentarlo.");
    }

    try{
        $conexion = DataObject::conectar();

        $sql = "INSERT INTO sugerencias (nombre, mensaje, estrellas, nombre_usuario)
            VALUES (:nombre, :mensaje, :estrellas, :nombre_usuario)";

        $stmt = $conexion->prepare($sql);

        $stmt->bindValue(":nombre", $nombre);
        $stmt->bindValue(":mensaje", $mensaje);
        $stmt->bindValue(":estrellas", $estrellas, PDO::PARAM_INT);
        $stmt->bindValue(":nombre_usuario", $nombre_usuario);

        $stmt->execute();

        echo "<h2> ¡Gracias por tu sugerencia, " . htmlspecialchars($nombre) . "!</h2>";
        if($nombre_usuario){
            echo "<p>Su sugerencia ha sido registrada con su cuenta: <strong>" . htmlspecialchars($nombre_usuario) . "</strong></p>";
        }
        echo "<p>Valoración: <strong>$estrellas estrella(s)</strong>.</p>";
        echo '<a href="sugerencias.php">Volver a sugerencias</a>';

        DataObject::desconectar($conexion);
    }catch(PDOException $e){
        die("Error al guardar la sugerencia: " .$e->getMessage());
    }
}
?>