<?php
require_once("includes/Actividad.class.inc.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de actividad no válido.");
}

$id = (int) $_GET['id'];
$actividad = Actividad::obtenerPorId($id);

if (!$actividad) {
    die("Actividad no encontrada.");
}

$categoria = $actividad->devolverValor('categoria');
$actividadesRelacionadas = Actividad::obtenerPorCategoria($categoria, $id);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($actividad->devolverValor('titulo')) ?> - Ludus Tempus</title>
    <link rel="stylesheet" href="css/actividad_especifica.css" />
</head>

<body>
    <?php include("includes/cabecera.php"); ?>

    <main class="detalle-actividad">
        <div class="contenido-detalle">
            <h1><?= htmlspecialchars($actividad->devolverValor('titulo')) ?></h1>

            <img 
                class="imagen-principal" 
                src="imagenes/<?= htmlspecialchars($actividad->devolverValor('imagen_detalle')) ?>" 
                alt="<?= htmlspecialchars($actividad->devolverValor('titulo')) ?>" 
            />

            <p><strong>Categoría:</strong> <?= htmlspecialchars($categoria) ?></p>
            <p><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($actividad->devolverValor('descripcion'))) ?></p>

            <a href="actividades.php">&larr; Volver a actividades</a>
        </div>

        <?php if (!empty($actividadesRelacionadas)) : ?>
        <aside class="relacionadas">
            <h3>Actividades relacionadas</h3>
            <ul>
                <?php foreach ($actividadesRelacionadas as $actRel) : ?>
                    <li>
                        <a href="actividad.php?id=<?= htmlspecialchars($actRel->devolverValor('id')) ?>">
                            <?= htmlspecialchars($actRel->devolverValor('titulo')) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Ludus Tempus</p>
        <a href="contacto.php">Contacto</a> |
        <a href="como_se_hizo2.pdf">Como se hizo</a>
    </footer>
</body>

</html>
