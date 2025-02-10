document.addEventListener('DOMContentLoaded', function() {
    // Código para el menú de filtros de la tabla
    const menuItems = document.querySelectorAll('#menu > ul > li');

    menuItems.forEach(item => {
        const subMenu = item.querySelector('ul');
        const cantidadItems = parseInt(item.dataset.cantidad, 10);

        item.addEventListener('mouseenter', function() {
            subMenu.style.height = `${cantidadItems * 30}px`; // Ajusta la altura según la cantidad de items
        });

        item.addEventListener('mouseleave', function() {
            subMenu.style.height = '0'; // Oculta el submenú al salir
        });
    });

    // Código para el tooltip
    const imagenes = document.querySelectorAll('.obra img');
    const tooltip = document.getElementById('tooltip');
    const tooltipTitulo = document.getElementById('tooltip-titulo');
    const tooltipCategoria = document.getElementById('tooltip-categoria');
    const tooltipAutor = document.getElementById('tooltip-autor');
    const tooltipTema = document.getElementById('tooltip-tema');

    imagenes.forEach(imagen => {
        imagen.addEventListener('mouseover', function(event) {
            tooltipTitulo.textContent = this.dataset.titulo;
            tooltipCategoria.textContent = 'Época: ' + this.dataset.categoria;
            tooltipAutor.textContent = 'Autor: ' + this.dataset.autor;
            tooltipTema.textContent = 'Tema: ' + this.dataset.tema;

            tooltip.style.display = 'block';
        });

        imagen.addEventListener('mouseout', function() {
            tooltip.style.display = 'none';
        });

        imagen.addEventListener('mousemove', function(event) {
            tooltip.style.left = (event.pageX + 20) + 'px';
            tooltip.style.top = (event.pageY + 20) + 'px';
        });
    });
});