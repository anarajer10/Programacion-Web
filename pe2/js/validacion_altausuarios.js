function validarRegistro(){
    const nombre = document.getElementById("nombre").value.trim();
    const email = document.getElementById("email").value.trim();
    const usuario = document.getElementById("usuario").value.trim();
    const pass = document.getElementById("contrasena").value.trim();
    const confirm = document.getElementById("confirmar_contrasena").value.trim();
    const planSeleccionado = document.querySelector('input[name="plan"]:checked');

    if(nombre === "" || email === "" || usuario === "" || pass === "" || confirm === ""){
        alert("Todos los campos de informacion personal son obligatorios.");
        return false;
    }

    if(email.indexOf("@") === -1 || email.indexOf(".") === -1){
        alert("Introduzca un correo electronico valido.");
        return false;
    }

    if(usuario.length < 4){
        alert("El nombre de usuario debe ser de al menos 4 caracteres.");
        return false;
    }

    if(pass.length < 8){
        alert("La contraseña debe ser de al menos 8 caracteres.");
        return false;
    }

    if(pass !== confirm){
        alert("Las contraseñas no coinciden.");
        return false;
    }

    if(!planSeleccionado){
        alert("Se debe seleccionar un plan de inscripcion.");
        return false;
    }

    return true;
}

document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("formRegistro").onsubmit = validarRegistro;
});