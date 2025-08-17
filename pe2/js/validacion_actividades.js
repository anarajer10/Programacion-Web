function validarFormularioActividad() {
    const titulo = document.querySelector('input[name="titulo"]').value.trim();
    const descripcion = document.querySelector('textarea[name="descripcion"]').value.trim();
    const categoria = document.querySelector('input[name="categoria"]').value.trim();
    
    if (titulo.length < 3) {
        alert("El título debe tener al menos 3 caracteres.");
        return false;
    }

    if (descripcion.length < 10) {
        alert("La descripción debe tener al menos 10 caracteres.");
        return false;
    }

    if (categoria.length < 3) {
        alert("La categoría debe tener al menos 3 caracteres.");
        return false;
    }

    return true;
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("formActividad").onsubmit = validarFormularioActividad;
});
