<?php
require_once("includes/Actividad.class.inc.php");
$actividades = Actividad::obtenerTodas();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ludus Tempus</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <?php include("includes/cabecera.php"); ?>

    <main>
        <section class="imagen-caballeros">
            <img src="imagenes/fighting-knights.jpg" alt="Imagen del club" class="caballeros-img">
        </section>
        <section class="bienvenida">
            <h2>Bienvenido a Ludus Tempus</h2>
            <p>
                Ludus Tempus es un club dedicado a las disciplinas deportivas históricas y medievales.
                Aquí podrás revivir el espíritu de los antiguos guerreros a través del entrenamiento en esgrima
                medieval,
                tiro con arco tradicional, soft combat, y muchos otros deportes. ¡Únete y haz historia!
            </p>
        </section>
        <section class="carrusel">
            <h2>Actividades destacadas</h2>
            <div id="carrusel-actividad">
                <?php foreach ($actividades as $index => $actividad): ?>
                    <div class="actividad" style="display: <?= $index === 0 ? 'block' : 'none' ?>;">
                        <a href="actividad.php?id=<?= $actividad->devolverValor('id') ?>">
                            <img src="imagenes/<?= htmlspecialchars($actividad->devolverValor('imagen')) ?>" alt="<?= htmlspecialchars($actividad->devolverValor('titulo')) ?>">
                        </a>
                        <h3><?= htmlspecialchars($actividad->devolverValor('titulo')) ?></h3>
                        <p><?= nl2br(htmlspecialchars($actividad->devolverValor('descripcion'))) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="flechas">
                <button id="anterior" class="boton-flecha">◀</button>
                <button id="siguiente" class="boton-flecha">▶</button>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Ludus Tempus</p>
        <a href="contacto.php">Contacto</a> |
        <a href="como_se_hizo2.pdf">Como se hizo</a>
    </footer>

    <script src="js/carrusel.js"></script>

</body>

</html>