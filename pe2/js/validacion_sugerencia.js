function validarSugerencia(){
    const nombre = document.getElementById("nombre").value.trim();
    const texto = document.getElementById("sugerencia").value.trim();
    const estrellas = parseInt(document.getElementById("estrellas").value);

    if(nombre === ""){
        alert("El nombre es obligatorio.");
        return false;
    }

    if(texto.length < 10){
        alert("La sugerencia tiene que tener una extensión de al menos 10 caracteres.");
        return false;
    }

    if(isNaN(estrellas) || estrellas < 1 || estrellas > 5){
        alert("Selecciona una cantidad de estrellas válida (de 1 a 5).");
        return false;
    }

    return true;
}

document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("formSugerencia").onsubmit = validarSugerencia;
});