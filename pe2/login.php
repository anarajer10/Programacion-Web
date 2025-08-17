<?php
session_start();
require_once("includes/datosObject.class.inc.php");
require_once("includes/Usuario.class.inc.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuarioInput = $_POST["usuario"] ?? '';
    $passwordInput = $_POST["password"] ?? '';

    $usuarioObj = Usuario::obtenerPorNombreUsuario($usuarioInput);

    if ($usuarioObj && password_verify($passwordInput, $usuarioObj->devolverValor("password"))) {
        $_SESSION["usuario"] = $usuarioObj->devolverValor("nombre_usuario");
        $_SESSION["tipo"] = $usuarioObj->devolverValor("tipo");
        
        header("Location: index.php");
        exit();
    } else {
        echo "<p>Error: Usuario o contraseña incorrectos.</p>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>