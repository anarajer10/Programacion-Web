<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/altausuario.css">
    <script src="js/validacion_altausuarios.js" defer></script>
</head>

<body>
    
    <?php include("includes/cabecera.php"); ?>

    <main>
        <section>
            <h2>Registrarse como usuario público</h2>
            <form action="altausuario.php" method="POST" id="formRegistro">
                <fieldset>
                    <legend>Información Personal</legend>
                    <div>
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre">
                    </div>
                    <div>
                        <label for="email">Correo Electrónico:</label>
                        <input type="text" id="email" name="email">
                    </div>
                    <div>
                        <label for="usuario">Nombre de Usuario:</label>
                        <input type="text" id="usuario" name="usuario">
                    </div>
                    <div>
                        <label for="contrasena">Contraseña:</label>
                        <input type="text" id="contrasena" name="contrasena">
                    </div>
                    <div>
                        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
                        <input type="text" id="confirmar_contrasena" name="confirmar_contrasena">
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Preferencias</legend>
                    <div>
                        <label for="genero">Género:</label>
                        <select id="genero" name="genero">
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div>
                        <label for="intereses">Áreas de Interés:</label>
                        <textarea id="intereses" name="intereses" rows="4"
                            placeholder="Escribe tus intereses..."></textarea>
                    </div>
                    <div>
                        <datalist id="actividades">
                            <option value="Esgrima medieval">
                            <option value="Tiro con arco (principiante)">
                            <option value="Jousting">
                            <option value="Bōjutsu">
                            <option value="Soft Combat">
                            <option value="Hurling">
                            <option value="Lucha grecorromana">
                            <option value="Esgrima en grupo">
                            <option value="Batalla campal">
                            <option value="Duelo simbólico">
                            <option value="Lanzamiento de hacha">
                            <option value="Marcha de escudos">
                            <option value="Simulación de asedio">
                            <option value="Arquería avanzada">
                            <option value="Torneo de caballería">
                        </datalist>
                        <label for="campoDeTexto1">Actividad a inscribirse </label>
                        <input type="text" id="campoDeTexto1" name="campoDeTexto1" list="actividades">
                    </div>
                    <div>
                        <label for="newsletter">¿Deseas recibir el boletín informativo?</label>
                        <input type="checkbox" id="newsletter" name="newsletter">
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Preferencias Adicionales</legend>
                    <div>
                        <label>Elige tu Plan:</label>
                        <label for="1-mes">
                            <input type="radio" id="1-mes" name="plan" value="1-mes"> 1-mes
                        </label>
                        <label for="2-meses">
                            <input type="radio" id="2-meses" name="plan" value="2-meses"> 2-meses
                        </label>
                        <label for="6-meses">
                            <input type="radio" id="6-meses" name="plan" value="6-meses"> 6-meses
                        </label>
                        <label for="12-meses">
                            <input type="radio" id="12-meses" name="plan" value="12-meses"> 12-meses
                        </label>
                    </div>
                </fieldset>

                <div>
                    <button type="reset">Restablecer</button>
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Ludus Tempus</p>
        <a href="contacto.php">Contacto</a> |
        <a href="como_se_hizo2.pdf">Como se hizo</a>
    </footer>
</body>

</html>