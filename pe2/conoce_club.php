<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Conoce Nuestro Club - Ludus Tempus</title>
  <link rel="stylesheet" href="css/conoce_club.css" />
</head>

<body>
  
  <?php include("includes/cabecera.php"); ?>

  <main>
    <h2>Plano del Club</h2>

    <div class="plano-y-leyenda">
      <div class="plano-con-marco">
        <img src="imagenes/plano_club.jpg" alt="Plano del Club" class="plano-club">
      </div>

      <div class="contenedor-leyenda">
        <h4 class="titulo-leyenda">Leyenda</h4>
        <ul class="leyenda">
          <li><strong>1.</strong> Pista 1 </li>
          <li><strong>2.</strong> Pabellón 1</li>
          <li><strong>3.</strong> Pabellón 2</li>
          <li><strong>4.</strong> Pista 2</li>
          <li><strong>5.</strong> Pista 3</li>
          <li><strong>6.</strong> Arena</li>
          <li><strong>7.</strong> Pabellón 3</li>
          <li><strong>8.</strong> Campo abierto</li>
        </ul>
      </div>
    </div>

    <h2>Conoce las Pistas del Club</h2>

    <div class="pistas">
      <section class="pista">
        <h3>Pista 1 - Pedana</h3>
        <p>En esta pista se practican las modalidades de esgrima, tanto individual, contra otro oponente; como en grupo,
          bajo las directrices de un instructor para mejorar los movimientos.</p>
      </section>

      <section class="pista">
        <h3>Pabellón 1 - Cubierto</h3>
        <p>En este primer pabellón se podrá practicar el bojutsu, así como realizarse los entrenamientos y partidos de
          hurling.
          Además, dispone de unas gradas para que se pueda ir a ambas actividades como visitante.</p>
      </section>

      <section class="pista">
        <h3>Pabellón 2 - De arena al descubierto</h3>
        <p>En este otro pabellón tan particular uno se podrá batir en duelo frente a un público en las gradas, e
          incluso hacer una marcha con escudos en grupo.</p>
      </section>

      <section class="pista">
        <h3>Pista 2 - Área de lanzamiento de hachas</h3>
        <p>Esta pista cubierta está dedicada exclusivamente al lanzamiento de hachas, de una manera segura y amena.
          Siempre se realizará bajo la supervisión del personal capacitado.</p>
      </section>

      <section class="pista">
        <h3>Pista 3 - Tiro con arco</h3>
        <p>Para los entrenamientos de tiro con arco, esta pista ofrece un espacio amplio y adecuado para ello. Cuenta
          con 2 lineas
          delimitadoras de distancia, siendo la más cercana para los primerizos y la segunda para los más avanzados.</p>
      </section>

      <section class="pista">
        <h3>Arena - Torneos</h3>
        <p>Aquí se podrán realizar las justas, y celebrarse torneos, contando además con unas gradas dispuestas a modo
          de
          anfiteatro, transportando a uno a otra época. A la derecha se ubican los establos con los caballos.</p>
      </section>

      <section class="pista">
        <h3>Pabellón 3 - Rings</h3>
        <p>En este pabellón, también cubierto, se realizan combates de soft combat y de lucha grecorromana. Para ello,
          este pabellón cuenta con 2 rings y además hay gradas a ambos lados de estos para poder ver en primer plano los
          combates.</p>
      </section>

      <section class="pista">
        <h3>Campo abierto - Torre</h3>
        <p>Y por último, el lugar emblemático del club: el campo abierto. Esta zona está formada por 2 montículos de
          tierra,
          estando situada en uno de ellos una torre para una inmersión completa. Se realizarán batallas campales y
          simulaciones de asedios.</p>
      </section>
  </main>

  <footer>
    <p>&copy; 2025 Ludus Tempus</p>
    <a href="contacto.php">Contacto</a> |
    <a href="como_se_hizo2.pdf">Como se hizo</a>
  </footer>
</body>

</html>