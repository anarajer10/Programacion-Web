<?php
require_once("includes/Usuario.class.inc.php");
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nombre = $_POST["nombre"] ?? '';
    $email = $_POST["email"] ?? '';
    $usuario = $_POST["usuario"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';
    $confirmar = $_POST["confirmar_contrasena"] ?? '';
    $genero = $_POST["genero"] ?? 'otro';
    $intereses = $_POST["intereses"] ?? '';
    $actividad = $_POST["campoDeTexto1"] ?? '';
    $newsletter = isset($_POST["newsletter"]) ? 1:0;
    $plan = $_POST["plan"] ?? '';

    if(trim($nombre) === "" || trim($email) === "" || trim($usuario) === "" || trim($contrasena) === "" || trim($confirmar) === ""){
        die("Error, todos los campos obligatorios deben rellenarse.");
    }

    if($contrasena !== $confirmar){
        die("Error, las contraseñas no coinciden.");
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die("Error, el email introducido no es valido.");
    }

    //Encriptación de la contraseña en la BD
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $usuarioDatos = array(
        "nombre_completo" => $nombre,
        "email" => $email,
        "nombre_usuario" => $usuario,
        "password" => $hash,
        "genero" => $genero,
        "intereses" => $intereses,
        "actividad_inscrita" => $actividad,
        "desea_newsletter" => $newsletter,
        "plan" => $plan,
        "tipo" => "usuario"
    );

    try {
        Usuario::insertar($usuarioDatos);

        $_SESSION["usuario"] = $usuario;
        $_SESSION["tipo"] = "usuario";

        header("Location: index.php");
        exit();

    } catch (Exception $e) {
        echo "<p style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

?>