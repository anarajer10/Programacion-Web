<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
?>

<header>
    <div class="cabecera">
        <img src="imagenes/logo.png" alt="Logo del club" class="logo">
        <h1>LUDUS TEMPUS</h1>

        <?php if (isset($_SESSION["usuario"])): ?>
            <div class="login-form">
                <p> <?php echo htmlspecialchars($_SESSION["usuario"]); ?> 
                    (<?php echo $_SESSION["tipo"]; ?>)</p>

                <form id="form-logout" method="POST" action="logout.php"></form>
                <button type="submit" form="form-logout" formnovalidate>Cerrar sesión</button>
            </div>
        <?php else: ?>
            <form class="login-form" method="POST" action="login.php">
                <input type="text" name="usuario" placeholder="Usuario">
                <input type="text" name="password" placeholder="Contraseña">
                <button type="submit">Entrar</button>
            </form>
            <a href="altausuarios.php" class="alta-link">Alta de usuarios</a>
        <?php endif; ?>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="actividades.php">Actividades</a></li>
        <li><a href="conoce_club.php">Conoce Nuestro Club</a></li>
        <li><a href="eventos.php">Eventos Deportivos</a></li>
        <li><a href="informacion.php">Información</a></li>
        <li><a href="sugerencias.php">Sugerencias</a></li>
        <?php if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] === "admin"): ?>
            <li><a href="admin_actividades.php">Gestión de actividades</a></li>
        <?php endif; ?>
      </ul>
    </nav>
</header>
