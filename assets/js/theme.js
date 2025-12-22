/**
 * ZMG Theme JavaScript
 * 
 * @package ZMG_Theme
 */

const mobileToggle = document.getElementById('mobile-menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');
const toggleButtons = document.querySelectorAll('.mobile-submenu-toggle');

window.addEventListener('DOMContentLoaded', function() {  
    // Toggle menú hamburguesa
    

    if (mobileToggle && mobileMenu) {
      mobileToggle.addEventListener('click', () => {
        const isHidden = mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden');
        mobileToggle.setAttribute('aria-expanded', !isHidden);
      });
    }

    // Toggle submenús móviles (solo con el botón)
    toggleButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.stopPropagation();
        const listItem = this.closest('li');
        const submenu = listItem.querySelector('.mobile-submenu');
        const icon = this.querySelector('svg');

        const isHidden = submenu.classList.contains('hidden');
        submenu.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
        this.setAttribute('aria-expanded', !isHidden);
      });
    });

    // Cerrar submenús al hacer clic fuera
    document.addEventListener('click', function(e) {
      if (!e.target.closest('#mobile-menu')) return;
      const openSubmenus = document.querySelectorAll('.mobile-submenu:not(.hidden)');
      openSubmenus.forEach(submenu => {
        const button = submenu.closest('li').querySelector('.mobile-submenu-toggle');
        submenu.classList.add('hidden');
        button?.querySelector('svg')?.classList.remove('rotate-180');
        button?.setAttribute('aria-expanded', 'false');
      });
    }); 


  document.querySelectorAll("ins").forEach(element => {(adsbygoogle = window.adsbygoogle || []).push({});})

  document.querySelector('#share-button').addEventListener('click', function(e) { 
    socialmediaToggle()
  }); 
}); 

function socialmediaToggle() {
  const menu = document.querySelector('#socialmedia-menu'); 
     
  if(menu.classList.contains('h-auto')) {
    menu.classList.remove('h-auto');
    menu.classList.add('h-[70px]');
  } else {
    menu.classList.add('h-auto');
    menu.classList.remove('h-[70px]');
  }
}

function hideSearchForm() {
  document.querySelector('#search-form').classList.add('hidden');
}

function showSearchForm() {
  document.querySelector('#search-form').classList.remove('hidden');
}