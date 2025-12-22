/**
 * Archivo JavaScript para manejar el menú de usuario
 * Este archivo se carga automáticamente cuando el usuario está logueado
 */

/**
 * Función para mostrar/ocultar el menú de usuario
 */
function toggleUserMenu() {
    const menu = document.getElementById('user-menu');
    if (menu) {
        const arrow = document.getElementById('menu-arrow');
        if (arrow) {
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                arrow.style.transform = 'rotate(180deg)';
            } else {
                menu.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
            }
        }
    }
}

/**
 * Cerrar menú cuando se hace clic fuera de él
 */
document.addEventListener('click', function(event) {
    const menu = document.getElementById('user-menu');
    const button = document.querySelector('.user-menu-button');

    if (menu && button && !menu.contains(event.target) && !button.contains(event.target)) {
        menu.classList.add('hidden');
        const arrow = document.getElementById('menu-arrow');
        if (arrow) {
            arrow.style.transform = 'rotate(0deg)';
        }
    }
});

/**
 * Función para resaltar la opción activa del menú
 */
function highlightMenuItem(activeItem) {
    const menuItems = document.querySelectorAll('#user-menu a');
    menuItems.forEach(item => {
        item.classList.remove('bg-blue-50', 'text-blue-900');
        if (item.textContent.trim().includes(activeItem)) {
            item.classList.add('bg-blue-50', 'text-blue-900');
        }
    });
}

/**
 * Inicializar menú de usuario cuando el DOM esté listo
 */
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si hay un menú de usuario en la página
    const userMenu = document.getElementById('user-menu');
    if (userMenu) {  
        // Agregar indicador visual de menú activo
        const menuButton = document.querySelector('.user-menu-button');
        if (menuButton) {
            menuButton.title = 'Haz clic para ver opciones de usuario';
        }
    }
});
