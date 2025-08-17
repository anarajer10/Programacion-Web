<?php
require_once("includes/Actividad.class.inc.php");

//Paginación-->9 por pág.
define("PAGINA_ACTUAL", isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1);
define("ELEMENTOS_POR_PAGINA", TAMANIO_PAGINA);
$inicio = (PAGINA_ACTUAL - 1) * ELEMENTOS_POR_PAGINA;

//Se obtienen las distintas categorías para el menú lateral
$categorias = Actividad::obtenerCategorias();

//Se filtra por categoría
$categoriaFiltrada = $_GET['categoria'] ?? null;

if ($categoriaFiltrada) {
    [$actividades, $total] = Actividad::obtenerPorCategoriaPaginadas($categoriaFiltrada, $inicio, ELEMENTOS_POR_PAGINA);
} else {
    [$actividades, $total] = Actividad::obtenerPaginadas($inicio, ELEMENTOS_POR_PAGINA);
}

$totalPaginas = ceil($total / ELEMENTOS_POR_PAGINA);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Actividades - Ludus Tempus</title>
  <link rel="stylesheet" href="css/actividadesStyles.css" />
</head>

<body>
  
  <?php include("includes/cabecera.php"); ?>

  <div class="container">
    <aside>
      <h2>Categorías</h2>
      <ul>
        <?php foreach ($categorias as $categ): ?>
          <li>
            <a href="actividades.php?categoria=<?= urlencode($categ) ?>">
              <?= htmlspecialchars($categ) ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </aside>

    <main>
      <h1>Actividades de Ludus Tempus</h1>
      <div class="actividades-grid">
        <?php foreach ($actividades as $actividad): ?>
          <a href="actividad.php?id=<?= $actividad->devolverValor('id') ?>" class="actividad">
            <img src="imagenes/<?= htmlspecialchars($actividad->devolverValor('imagen')) ?>" 
              alt="<?= htmlspecialchars($actividad->devolverValor('titulo')) ?>" />
            <div class="actividad-content">
              <h3><?= htmlspecialchars($actividad->devolverValor('titulo')) ?></h3>
              <p><?= htmlspecialchars($actividad->devolverValor('categoria')) ?></p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>

      <?php if($totalPaginas > 1): ?>
        <div class="pagination">
          <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <a href="actividades.php?pagina=<?= $i ?><?= $categoriaFiltrada ? '&categoria=' . urlencode($categoriaFiltrada) : '' ?>"
              class="<?= $i === PAGINA_ACTUAL ? 'active' : '' ?>"><?= $i ?>
            </a>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    </main>
  </div>

  <footer>
    <p>&copy; 2025 Ludus Tempus</p>
    <a href="contacto.php">Contacto</a> |
    <a href="como_se_hizo2.pdf">Como se hizo</a>
  </footer>
</body>

</html>