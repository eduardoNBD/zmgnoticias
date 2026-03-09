showLoader();

const slider = document.querySelector('#hero-slider');
const items = slider.querySelectorAll('.slider-item');
const dots = slider.querySelectorAll('.slider-dot');
const prevBtn = document.querySelector('#prev-btn');
const nextBtn = document.querySelector('#next-btn');
let currentIndex = 0;

document.addEventListener('DOMContentLoaded', function() {
    hideLoader();
    const totalItems = items.length;

    // Siguiente
    nextBtn.addEventListener('click', () => {
      const nextIndex = (currentIndex + 1) % totalItems;console.log('next',nextIndex);
      showSlide(nextIndex);
    });

    // Anterior
    prevBtn.addEventListener('click', () => {
      const prevIndex = (currentIndex - 1 + totalItems) % totalItems;console.log('prev',prevIndex);
      showSlide(prevIndex);
    });

    // Puntos
    dots.forEach(dot => {
      dot.addEventListener('click', () => {
        const index = parseInt(dot.getAttribute('data-index'));
        showSlide(index);
      });
    });
 
    setInterval(() => {
      const nextIndex = (currentIndex + 1) % totalItems;
      showSlide(nextIndex);
    }, 10000);
});

function showSlide(index) {
    items.forEach((item, i) => {
    item.classList.toggle('opacity-100', i === index);
    item.classList.toggle('z-10', i === index);
    item.classList.toggle('opacity-0', i !== index);
    item.classList.toggle('z-0', i !== index);
    });

    // Actualizar puntos
    dots.forEach((dot, i) => {
      dot.classList.toggle('bg-white', i === index);
      dot.classList.toggle('bg-white/50', i !== index);
    }); 

    currentIndex = index;
}