document.addEventListener('DOMContentLoaded', () => {
    const actividades = document.querySelectorAll('.actividad');
    let index = 0;

    document.getElementById('siguiente').addEventListener('click', () => {
        actividades[index].style.display = 'none';
        index = (index + 1) % actividades.length;
        actividades[index].style.display = 'block';
    });

    document.getElementById('anterior').addEventListener('click', () => {
        actividades[index].style.display = 'none';
        index = (index - 1 + actividades.length) % actividades.length;
        actividades[index].style.display = 'block';
    });
});
