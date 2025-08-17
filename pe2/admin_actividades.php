<?php
require_once("includes/Actividad.class.inc.php");
session_start();

if (!isset($_SESSION["tipo"]) || $_SESSION["tipo"] !== "admin") {
    die("Acceso restringido. Solo administradores.");
}

$mensaje = "";
$modoEdicion = false;
$actividadEditar = null;

//array para seleccionar la imagen dada de la carpeta de imágenes
$imagenes = array_filter(scandir("imagenes/"), function ($archivo) {
    return preg_match("/\.(jpg|JPG|jpeg|png|gif)$/i", $archivo);
});

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"])) {

    $accion = $_POST["accion"] ?? "";

    if ($accion === "crear") {
        $datos = [
            "titulo" => $_POST["titulo"] ?? "",
            "descripcion" => $_POST["descripcion"] ?? "",
            "imagen" => $_POST["imagen"] ?? "generica.jpg",
            "categoria" => $_POST["categoria"] ?? "General",
            "imagen_detalle" => $_POST["imagen_detalle"] ?? "generica_detalle.jpg"
        ];

        Actividad::insertar($datos);
        $mensaje = "Actividad creada correctamente.";
    }

    if ($accion === "eliminar" && isset($_POST["id"])) {
        Actividad::eliminar((int)$_POST["id"]);
        $mensaje = "Actividad eliminada correctamente.";
    }

    if ($accion === "actualizar" && isset($_POST["id"])) {
        $id = (int)$_POST["id"];
        $datos = [
            "titulo" => $_POST["titulo"] ?? "",
            "descripcion" => $_POST["descripcion"] ?? "",
            "imagen" => $_POST["imagen"] ?? "generica.jpg",
            "categoria" => $_POST["categoria"] ?? "General",
            "imagen_detalle" => $_POST["imagen_detalle"] ?? "generica_detalle.jpg"
        ];
        Actividad::actualizar($id, $datos);
        $mensaje = "Actividad actualizada correctamente.";
    }

    if ($accion === "editar" && isset($_POST["id"])) {
        $actividadEditar = Actividad::obtenerPorId((int)$_POST["id"]);
        $modoEdicion = true;
    }
}

$actividades = Actividad::obtenerTodas();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Actividades - Ludus Tempus</title>
  <link rel="stylesheet" href="css/actividadesStyles.css">
  <link rel="stylesheet" href="css/admin_actividades.css">
  <script src="js/validacion_actividades.js" defer></script>
</head>

<body>
    <?php include("includes/cabecera.php"); ?>

    <main>
    <h1 class="admin-actividades-titulo">Gestión de Actividades</h1>
    <?php if ($mensaje): ?><p><?= htmlspecialchars($mensaje) ?></p><?php endif; ?>

    <!-- Formulario de creación / edición de actividades -->
    <form method="POST" id="formActividad" class="admin-formulario">
        <h2 class="admin-actividades-subtitulo"><?= $modoEdicion ? "Editar actividad" : "Crear nueva actividad" ?></h2>
        <input type="hidden" name="accion" value="<?= $modoEdicion ? 'actualizar' : 'crear' ?>">
        <?php if ($modoEdicion): ?>
        <input type="hidden" name="id" value="<?= $actividadEditar->devolverValor('id') ?>">
        <?php endif; ?>
        <input type="text" name="titulo" placeholder="Título"
            value="<?= $modoEdicion ? htmlspecialchars($actividadEditar->devolverValor('titulo')) : '' ?>"><br>
        <textarea name="descripcion" placeholder="Descripción"><?= $modoEdicion ? htmlspecialchars($actividadEditar->devolverValor('descripcion')) : '' ?></textarea><br>
        <label for="imagen">Imagen:</label>
        <select name="imagen">
            <?php foreach ($imagenes as $img): ?>
                <option value="<?= $img ?>"
                    <?= $modoEdicion && $actividadEditar->devolverValor('imagen') === $img ? 'selected' : '' ?>>
                    <?= $img ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <input type="text" name="categoria" placeholder="Categoría"
            value="<?= $modoEdicion ? htmlspecialchars($actividadEditar->devolverValor('categoria')) : '' ?>"><br>
        <label for="imagen_detalle">Imagen detalle:</label>
        <select name="imagen_detalle">
            <?php foreach ($imagenes as $img): ?>
                <option value="<?= $img ?>"
                    <?= $modoEdicion && $actividadEditar->devolverValor('imagen_detalle') === $img ? 'selected' : '' ?>>
                    <?= $img ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit"><?= $modoEdicion ? "Actualizar" : "Crear" ?></button>
    </form>

    <h2 class="admin-actividades-subtitulo">Actividades registradas</h2>
    <table class="admin-tabla" border="1">
        <tr>
        <th>ID</th><th>Título</th><th>Categoría</th><th>Acciones</th>
        </tr>
        <?php foreach ($actividades as $act): ?>
        <tr>
            <td><?= $act->devolverValor("id") ?></td>
            <td><?= $act->devolverValor("titulo") ?></td>
            <td><?= $act->devolverValor("categoria") ?></td>
            <td>
            <form method="POST" class="admin-accion" style="display:inline;">
                <input type="hidden" name="accion" value="editar">
                <input type="hidden" name="id" value="<?= $act->devolverValor("id") ?>">
                <button type="submit">Editar</button>
            </form>
            <form method="POST" class="admin-accion" style="display:inline;">
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="id" value="<?= $act->devolverValor("id") ?>">
                <button type="submit" onclick="return confirm('¿Eliminar esta actividad?')">Eliminar</button>
            </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </main>
    <footer>
        <p>&copy; 2025 Ludus Tempus</p>
        <a href="contacto.php">Contacto</a> |
        <a href="como_se_hizo2.pdf">Como se hizo</a>
    </footer>
</body>
</html>